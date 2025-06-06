<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'relation' => 'required|numeric|exists:relations,id',
            'consent_answer' => 'required|string|in:Oo,Hindi',
        ];
    }
}
