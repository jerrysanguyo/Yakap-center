<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'receivedService'    => 'required|in:Oo,Hindi',
            'yesService'      => 'required_if:receivedService,Oo|array',
            'yesService.*'    => 'numeric|exists:services,id',
            'noService'    => 'required_if:receivedService,Hindi|array',
            'noService.*'  => 'numeric|exists:services,id',
            'otherYes'        => 'nullable|string|max:255',
            'otherNo'         => 'nullable|string|max:255',
        ];
    }
}
