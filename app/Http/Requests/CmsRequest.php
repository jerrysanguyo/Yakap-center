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

        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:' . $table . ',name' . ($id ? ',' . $id : ''),
            ],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
        
        return array_merge($rules, $this->getAdditionalRulesForTable($table));
    }
    
    protected function getAdditionalRulesForTable(?string $table): array
    {
        return match ($table) {
            'barangays' => [
                'district_id' => ['required', 'numeric', 'exists:districts,id'],
            ],
            'goals' => [
                'domain_id' => ['required', 'numeric', 'exists:learning_domains,id'],
            ],
            'learning_competencies' => [
                'domain_id' => ['required', 'numeric', 'exists:learning_domains,id'],
            ],
            'objectives' => [
                'goal_id' => ['required', 'numeric', 'exists:goals,id'],
            ],
            default => [],
        };
    }
}
