<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->route('user')),
                'email',
                'max:255',
            ],
            'role_id' => [
                'required',
                'int',
                Rule::exists('roles', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'password' => 'nullable|confirmed|min:8',
        ];
    }
}
