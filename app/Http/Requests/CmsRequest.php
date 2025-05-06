<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $table = $this->get('cms_table'); 
        $id = $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:' . $table . ',name' . ($id ? ',' . $id : '')
            ],
            'remarks' => 'nullable|string|max:255',
        ];
    }
}
