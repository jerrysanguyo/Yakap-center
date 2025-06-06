<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'nullable|string|max:255',
            'last_name'    => 'required|string|max:255',
            'gender_id'    => 'required|numeric|exists:genders,id',
            'birth_date'   => 'required|date|before:today',
            'house_number' => 'required|string|max:255',
            'district_id'  => 'required|numeric|exists:districts,id',
            'barangay_id'  => 'required|numeric|exists:barangays,id',
            'city'         => 'required|string|in:Taguig City',
            'mother_name'                         => 'required|string|max:255',
            'father_name'                         => 'required|string|max:255',
            'mother_birthdate'                   => 'required|date|before:today',
            'father_birthdate'                   => 'required|date|before:today',
            'mother_facebook'                     => 'nullable|url|max:255',
            'father_facebook'                     => 'nullable|url|max:255',
            'mother_birthplace'                   => 'required|string|max:255',
            'father_birthplace'                   => 'required|string|max:255',
            'mother_email'                        => 'nullable|email|max:255',
            'father_email'                        => 'nullable|email|max:255',
            'mother_educational_attainment'      => 'required|numeric|exists:educations,id',
            'father_educational_attainment'      => 'required|numeric|exists:educations,id',
            'mother_workplace'                    => 'nullable|string|max:255',
            'father_workplace'                    => 'nullable|string|max:255',
            'mother_contact_number'               => 'required|string|max:15',
            'father_contact_number'               => 'required|string|max:15',
            'pwd_no'       => 'required|string|max:20',
            'disability'   => 'required|numeric|exists:disabilities,id',
            'school'       => 'required|string|max:255',
            'education'    => 'required|numeric|exists:educations,id',
            'receivedService' => 'required|in:Oo,Hindi',
            'yesService'      => 'required_if:receivedService,Oo|array',
            'yesService.*'    => 'numeric|exists:services,id',
            'noService'       => 'required_if:receivedService,Hindi|array',
            'noService.*'     => 'numeric|exists:services,id',
            'otherYes'        => 'nullable|string|max:255',
            'otherNo'         => 'nullable|string|max:255',
            'checkUp'       => 'required|in:Oo,Hindi',
            'bloodType'     => 'required|string|exists:blood_types,id',
            'medication'    => 'array',
            'medication.*'  => 'nullable|string|max:255',
            'allergy'       => 'array',
            'allergy.*'     => 'nullable|string|max:255',
            'family'                   => 'required|array|min:1',
            'family.*.name'            => 'nullable|string|max:255',
            'family.*.birthday'        => 'nullable|date',
            'family.*.age'             => 'nullable|integer|min:0',
            'family.*.sex'             => 'nullable|numeric|exists:genders,id',
            'family.*.relation'        => 'nullable|numeric|exists:relations,id',
            'family.*.civil_status'    => 'nullable|numeric|exists:civil_statuses,id',
            'family.*.education'       => 'nullable|numeric|exists:educations,id',
            'family.*.work'            => 'nullable|string|max:255',
            'emergency_name'    => 'required|string|max:255',
            'emergency_contact' => 'required|string|max:15',
            'relation'          => 'required|numeric|exists:relations,id',
        ];
    }
}
