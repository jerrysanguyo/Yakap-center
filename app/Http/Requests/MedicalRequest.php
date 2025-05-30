<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'checkUp'       => 'required|in:Oo,Hindi',
            'bloodType'     => 'required|string|exists:blood_types,id',
            'medication'    => 'array',
            'medication.*'  => 'nullable|string|max:255',
            'allergy'       => 'array',
            'allergy.*'     => 'nullable|string|max:255',
        ];
    }
}
