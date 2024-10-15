<?php

namespace App\Requests\Procurement;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProcurementRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules =  [
            'procurement_number' => 'required',
            'user_id' => 'required',
            'brand_id' => 'required',
            'email' => 'required',
            'asset_type_id' => [
                'required',
                Rule::exists('asset_types', 'id')
                    ->where('is_active', 1)
            ],
            'quantity' => 'required',
            'request_date' => 'required',
            'delivery_date' => ['required', 'after_or_equal:request_date'],
            'purpose' => ['nullable', 'string'],
        ];

        return $rules;
    }
}
