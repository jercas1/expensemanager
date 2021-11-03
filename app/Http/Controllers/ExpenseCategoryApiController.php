<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\ExpenseCategory;
use App\Http\Requests\ExpenseCategory\StoreExpenseCategoryRequest;

class ExpenseCategoryApiController extends Controller
{
    public function store(StoreExpenseCategoryRequest $request)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated) {
            $expense_category = new ExpenseCategory;
            foreach ($validated as $key => $value) {
                $expense_category[$key] = $value;
            }
            $expense_category->save();

            return response()->json([
                'success' => true,
                'title' => 'Create Success',
                'message' => 'The creation of expense category is successful!',
                'expense_category' => $expense_category,
            ]);
        });

        return $response;
    }

    public function get(Request $request)
    {
        $expense_categories = ExpenseCategory::get();

        return response()->json([
            'success' => true,
            'expense_categories' => $expense_categories,
        ]);
    }

    public function find(ExpenseCategory $expense_category)
    {
        return response()->json([
            'success' => true,
            'expense_category' => $expense_category,
        ]);
    }

    public function update(StoreExpenseCategoryRequest $request, ExpenseCategory $expense_category)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated, $expense_category) {
            foreach ($validated as $key => $value) {
                $expense_category[$key] = $value;
            }
            $expense_category->save();

            return response()->json([
                'success' => true,
                'title' => 'Update Success',
                'message' => 'The update of expense category is successful!',
                'expense_category' => $expense_category,
            ]);
        });

        return $response;
    }

    public function delete(Request $request, ExpenseCategory $expense_category)
    {
        $response = DB::transaction(function () use ($expense_category, $request) {
            $expense_category->delete();

            return response()->json([
                'success' => true,
                'title' => 'Delete Success',
                'message' => 'The delete of expense category is successful!'
            ]);
        });

        return $response;
    }
}
