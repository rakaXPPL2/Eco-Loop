<style>
    /* Enhanced Toast Notifications */
    .toast-container {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        max-width: 400px;
    }

    .toast {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-radius: 1rem;
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.25);
        animation: toastSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .toast-success {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
    }

    .toast-error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    .toast-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .toast-info {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }

    .toast-icon {
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        flex-shrink: 0;
    }

    .toast-content {
        flex: 1;
        font-weight: 500;
    }

    .toast-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 1.75rem;
        height: 1.75rem;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .toast-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    @keyframes toastSlideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes toastSlideOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    .toast-exit {
        animation: toastSlideOut 0.3s ease forwards;
    }
</style>

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false; $el.remove(); }, 4000)"
    class="toast toast-success">
    <div class="toast-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <span class="toast-content">{{ session('success') }}</span>
    <button @click="show = false; $el.closest('.toast').remove()" class="toast-close">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false; $el.remove(); }, 5000)"
    class="toast toast-error">
    <div class="toast-icon">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <span class="toast-content">{{ session('error') }}</span>
    <button @click="show = false; $el.closest('.toast').remove()" class="toast-close">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>
@endif

@if(session('warning'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false; $el.remove(); }, 4000)"
    class="toast toast-warning">
    <div class="toast-icon">
        <i class="fas fa-exclamation-triangle"></i>
    </div>
    <span class="toast-content">{{ session('warning') }}</span>
    <button @click="show = false; $el.closest('.toast').remove()" class="toast-close">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>
@endif

@if(session('info'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false; $el.remove(); }, 4000)"
    class="toast toast-info">
    <div class="toast-icon">
        <i class="fas fa-info-circle"></i>
    </div>
    <span class="toast-content">{{ session('info') }}</span>
    <button @click="show = false; $el.closest('.toast').remove()" class="toast-close">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>
@endif

@if(isset($errors) && $errors->any())
<div x-data="{ show: true }" x-show="show"
    class="toast toast-error">
    <div class="toast-icon">
        <i class="fas fa-exclamation-circle"></i>
    </div>
    <div class="toast-content">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-1 text-sm opacity-90">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <button @click="show = false; $el.closest('.toast').remove()" class="toast-close">
        <i class="fas fa-times text-sm"></i>
    </button>
</div>
@endif
