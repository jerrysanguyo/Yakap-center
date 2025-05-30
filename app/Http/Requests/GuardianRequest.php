<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'mother_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_birthdate' => 'required|date|before:today',
            'father_birthdate' => 'required|date|before:today',
            'mother_facebook' => 'nullable|url|max:255',
            'father_facebook' => 'nullable|url|max:255',
            'mother_birthplace' => 'required|string|max:255',
            'father_birthplace' => 'required|string|max:255',
            'mother_email' => 'nullable|email|max:255',
            'father_email' => 'nullable|email|max:255',
            'mother_educational_attainment' => 'required|numeric|exists:educations,id',
            'father_educational_attainment' => 'required|numeric|exists:educations,id',
            'mother_workplace' => 'nullable|string|max:255',
            'father_workplace' => 'nullable|string|max:255',
            'mother_contact_number' => 'required|string|max:15',
            'father_contact_number' => 'required|string|max:15',
        ];
    }
}
