<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // DEBUG: Force authorize
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:5000',
            'city' => 'required|string|max:100',
            'price' => 'required|numeric|min:100|max:999999999',
            'weight' => 'required|numeric|min:0.01|max:9999',
            'stock' => 'required|integer|min:0|max:99999',
            'condition' => 'required|in:like_new,good,fair,new',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'image.mimes' => 'Format gambar harus jpeg, jpg, png, gif, atau webp.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'price.min' => 'Harga minimal Rp 100.',
            'weight.min' => 'Berat minimal 0.01 kg.',
        ];
    }
}
