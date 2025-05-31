<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FamilyCompositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'family'               => 'required|array|min:1',
            'family.*.name'        => 'nullable|string|max:255',
            'family.*.birthday'    => 'nullable|date',
            'family.*.age'         => 'nullable|integer|min:0',
            'family.*.sex'         => 'nullable|numeric|exists:genders,id',
            'family.*.relation'    => 'nullable|numeric|exists:relations,id',
            'family.*.civil_status'=> 'nullable|numeric|exists:civil_statuses,id',
            'family.*.education'   => 'nullable|numeric|exists:educations,id',
            'family.*.work'        => 'nullable|string|max:255',
        ];
    }
}
