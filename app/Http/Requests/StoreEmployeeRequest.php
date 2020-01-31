<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:users,id',
            'position' => 'nullable|integer|exists:positions,id',
            'first_name' => 'required|string|max:128',
            'last_name' => 'required|string|max:128',
        ];
    }
}
