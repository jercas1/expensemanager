<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Expense;

class DashboardApiController extends Controller
{
    public function getCategoryChart() {
        $data = Expense::selectRaw('
            expense_categories.display_name,
            SUM(expenses.amount) AS amount_total
        ')
            ->join('expense_categories', 'expenses.expense_category_id', 'expense_categories.id')
            ->groupBy('expense_categories.display_name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function getPeriodicalChart(Request $request)
    {
        $data = null;
        if ($request->input('periodicity') == 'Year') {
            $data = Expense::selectRaw('
                expense_categories.display_name,
                SUM(expenses.amount) AS amount_total,
                YEAR(expenses.entry_date) AS year
            ')
                ->join('expense_categories', 'expenses.expense_category_id', 'expense_categories.id')
                ->groupBy('expense_categories.display_name', 'year')
                ->orderBy('year')
                ->get();
        } else if ($request->input('periodicity') == 'Month') {
            $data = Expense::selectRaw('
                expense_categories.display_name,
                SUM(expenses.amount) AS amount_total,
                MONTH(expenses.entry_date) AS month
            ')
                ->join('expense_categories', 'expenses.expense_category_id', 'expense_categories.id')
                ->whereBetween('expenses.entry_date', [$request->input('start'), $request->input('end')])
                ->orWhereDate('expenses.entry_date', $request->input('start'))
                ->orWhereDate('expenses.entry_date', $request->input('end'))
                ->groupBy('expense_categories.display_name', 'month')
                ->get();
        } else if ($request->input('periodicity') == 'Day') {
            $data = Expense::selectRaw('
                expense_categories.display_name,
                SUM(expenses.amount) AS amount_total,
                DATE(expenses.entry_date) AS date
            ')
                ->join('expense_categories', 'expenses.expense_category_id', 'expense_categories.id')
                ->whereBetween('expenses.entry_date', [$request->input('start'), $request->input('end')])
                ->orWhereDate('expenses.entry_date', $request->input('start'))
                ->orWhereDate('expenses.entry_date', $request->input('end'))
                ->groupBy('expense_categories.display_name', 'date')
                ->get();
        }

        return response()->json([
            'data' => $data,
        ]);
    }
}
