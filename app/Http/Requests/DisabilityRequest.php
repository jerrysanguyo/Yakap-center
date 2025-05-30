<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'pwd_no' => 'required|string|max:20',
            'disability' => 'required|numeric|exists:disabilities,id',
        ];
    }
}
