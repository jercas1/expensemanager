<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return $request->user()->role_id === 1;
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
                'unique:users,email',
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
            'password' => 'required|confirmed|min:8',
        ];
    }
}
