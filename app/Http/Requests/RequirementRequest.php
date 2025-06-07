<?php

namespace App\Http\Requests;

use App\Models\Requirement;
use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'requirements'   => 'array',
            'requirements.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
    }

    public function attributes(): array
    {
        return Requirement::pluck('name','id')->mapWithKeys(function($name, $id) {
            return ["requirements.{$id}" => "Requirement: {$name}"];
        })->toArray();
    }
}