<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Expense;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\DeleteExpenseRequest;

class ExpenseApiController extends Controller
{
    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated) {
            $expense = new Expense;
            foreach ($validated as $key => $value) {
                $expense[$key] = $value;
            }
            $expense['user_id'] = $request->user()->id;
            $expense->save();

            return response()->json([
                'success' => true,
                'title' => 'Create Success',
                'message' => 'The creation of expense is successful!',
                'expense' => $expense,
            ]);
        });

        return $response;
    }

    public function get(Request $request)
    {
        $expenses = Expense::select('expenses.*', 'expense_categories.display_name AS expense_category_display_name')
            ->join('expense_categories', 'expenses.expense_category_id', 'expense_categories.id')
            ->where('expenses.user_id', $request->user()->id)
            ->get();

        return response()->json([
            'success' => true,
            'expenses' => $expenses,
        ]);
    }

    public function find(Expense $expense)
    {
        return response()->json([
            'success' => true,
            'expense' => $expense,
        ]);
    }

    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $validated = $request->validated();

        $response = DB::transaction(function () use ($request, $validated, $expense) {
            foreach ($validated as $key => $value) {
                $expense[$key] = $value;
            }
            $expense->save();

            return response()->json([
                'success' => true,
                'title' => 'Update Success',
                'message' => 'The update of expense is successful!',
                'expense' => $expense,
            ]);
        });

        return $response;
    }

    public function delete(DeleteExpenseRequest $request, Expense $expense)
    {
        $response = DB::transaction(function () use ($expense, $request) {
            $expense->delete();

            return response()->json([
                'success' => true,
                'title' => 'Delete Success',
                'message' => 'The delete of expense is successful!'
            ]);
        });

        return $response;
    }
}
