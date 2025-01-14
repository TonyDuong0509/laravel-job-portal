<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
            'name' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'review' => ['required'],
            'rating' => ['required', 'numeric']
        ];
    }
}
