<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $request->user()->id === $this->route('expense')->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'expense_category_id' => [
                'required',
                'int',
                Rule::exists('expense_categories', 'id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
            'amount' => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/|between:0,99999999',
            'entry_date' => 'required|date',
        ];
    }
}
