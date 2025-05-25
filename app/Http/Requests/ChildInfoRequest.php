<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildInfoRequest extends FormRequest
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
            'gender' => 'required|numeric|exists:genders,id',
            'birth_date' => 'required|date|before:today',
            'house_number' => 'required|string|max:255',
            'district' => 'required|numeric|exists:districts,id',
            'barangay' => 'required|numeric|exists:barangays,id',
            'city' => 'required|string|in:Taguig City',
        ];
    }
}
