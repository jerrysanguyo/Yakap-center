<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildEducPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'ratings' => 'array',
            'ratings.*' => 'integer|exists:ratings,id',
        ];
    }
}   
