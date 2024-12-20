<?php

namespace App\Requests\Department;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dept_name' => 'required|string',
            'dept_head_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
        ];

    }

}











