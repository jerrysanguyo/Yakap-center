<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmergencyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'emergency_name' => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:15',
            'relation' => 'required|numeric|exists:relations,id',
        ];
    }
}
