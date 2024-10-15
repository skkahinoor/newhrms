<?php
namespace App\Requests\User;


use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100|min:2',
            'email' => ['required','email', Rule::unique('users')->ignore($this->user)],
            'username' => ['required','string', Rule::unique('users')->ignore($this->user)],
            'address' => 'required',
            'dob' => 'required|date|date_format:Y-m-d|before:today',
            'phone' => 'required|numeric',
            'gender' => ['required', 'string', Rule::in(User::GENDER)],
            'marital_status' => ['required', 'string', Rule::in(User::MARITAL_STATUS)],
            'employment_type' => ['required', 'string', Rule::in(User::EMPLOYMENT_TYPE)],
            'joining_date' => 'nullable|date|before_or_equal:today',
            'role_id' => 'required|exists:roles,id',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'post_id' => 'required|exists:posts,id',
            'supervisor_id' => 'nullable|exists:users,id',
            'office_time_id' => 'required|exists:office_times,id',
            'leave_allocated' => 'nullable|numeric|gte:0',
            'remarks' => 'nullable|string|max:1000',
            'workspace_type' => ['nullable', 'boolean', Rule::in([1, 0])],
            'avatar' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg','max:5048'],

        ];

    }

}















