<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'priority' => 'numeric|between:1,3',
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
            'description' => 'string|max:255',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')){
            $rules['name'] = 'sometimes|string|max:255';
            $rules['user_id'] = 'sometimes|exists:users,id';
            $rules['project_id'] = 'sometimes|exists:projects,id';
        }

        return $rules;

    }
}
