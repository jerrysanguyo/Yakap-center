<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'school' => 'required|string|max:255',
            'education' => 'required|numeric|exists:educations,id',
        ];
    }
}
