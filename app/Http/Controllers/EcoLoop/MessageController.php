<?php

namespace App\Http\Controllers\EcoLoop;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Product;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class MessageController extends Controller
{
    /**
     * Rate limit key for message sending
     */
    protected function rateLimitKey(User $user): string
    {
        return 'messages:' . auth()->id() . ':' . $user->id;
    }

    public function index()
    {
        $conversations = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver', 'product'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($message) {
                return $message->sender_id === auth()->id()
                    ? $message->receiver_id
                    : $message->sender_id;
            });

        return view('eco-loop.pages.messages.index', compact('conversations'));
    }

    public function show(User $user)
    {
        $messages = Message::where(function ($query) use ($user) {
                $query->where('sender_id', auth()->id())
                      ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', auth()->id());
            })
            ->orderBy('created_at', 'asc')
            ->with(['sender', 'receiver'])
            ->get();

        // Mark received messages as read
        Message::where('receiver_id', auth()->id())
            ->where('sender_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('eco-loop.pages.messages.show', compact('user', 'messages'));
    }

    public function productChat(Product $product)
    {
        // Get all messages about this product between buyer and seller
        $messages = Message::where('product_id', $product->id)
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                      ->orWhere('receiver_id', auth()->id());
            })
            ->orderBy('created_at', 'asc')
            ->with(['sender', 'receiver'])
            ->get();

        // Mark as read
        Message::where('product_id', $product->id)
            ->where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('eco-loop.pages.messages.product-chat', compact('product', 'messages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'message' => ['required', 'string', 'max:1000'],
            'order_id' => ['nullable', 'exists:orders,id'],
        ]);

        $receiver = User::findOrFail($validated['receiver_id']);

        if ($receiver->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengirim pesan ke diri sendiri.');
        }

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'product_id' => null,
            'subject' => 'Pesan dari ' . auth()->user()->name,
            'content' => $validated['message'],
            'is_read' => false,
        ]);

        Notification::createForUser(
            $receiver->id,
            'message',
            'Pesan Baru',
            auth()->user()->name . ' mengirim pesan untuk Anda.',
            ['message_id' => $message->id]
        );

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    public function sendToSeller(Request $request, Product $product)
    {
        // Rate limit: max 10 messages per minute per user per product
        $rateLimitKey = 'product-message:' . auth()->id() . ':' . $product->id;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->back()
                ->with('error', "Terlalu banyak pesan. Coba lagi dalam {$seconds} detik.");
        }

        RateLimiter::hit($rateLimitKey, 60); // 1 minute decay

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ]);

        // Only buyers can send messages to sellers
        if (!auth()->user()->isBuyer()) {
            abort(403, 'Hanya pembeli yang dapat mengirim pesan.');
        }

        // Create message
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $product->user_id,
            'product_id' => $product->id,
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'is_read' => false,
        ]);

        // Notify seller
        Notification::createForUser(
            $product->user_id,
            'message',
            'Pesan Baru: ' . $validated['subject'],
            auth()->user()->name . ' bertanya tentang produk "' . $product->name . '"',
            ['message_id' => $message->id, 'product_id' => $product->id]
        );

        return redirect()->back()
            ->with('success', 'Pesan berhasil dikirim ke penjual!');
    }

    public function reply(Request $request, Message $message)
    {
        // Rate limit: max 20 replies per minute
        $rateLimitKey = 'message-reply:' . auth()->id();

        if (RateLimiter::tooManyAttempts($rateLimitKey, 20)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return redirect()->back()
                ->with('error', "Terlalu banyak pesan. Coba lagi dalam {$seconds} detik.");
        }

        RateLimiter::hit($rateLimitKey, 60);

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Only participants can reply
        if ($message->sender_id !== auth()->id() && $message->receiver_id !== auth()->id()) {
            abort(403);
        }

        // Determine receiver
        $receiverId = $message->sender_id === auth()->id()
            ? $message->receiver_id
            : $message->sender_id;

        // Create reply
        $reply = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'product_id' => $message->product_id,
            'subject' => 'Re: ' . $message->subject,
            'content' => $validated['content'],
            'is_read' => false,
            'parent_id' => $message->id,
        ]);

        // Notify receiver
        Notification::createForUser(
            $receiverId,
            'message',
            'Balasan Pesan: ' . $message->subject,
            auth()->user()->name . ' membalas pesan Anda',
            ['message_id' => $reply->id, 'product_id' => $message->product_id]
        );

        return redirect()->back()
            ->with('success', 'Balasan berhasil dikirim!');
    }
}
