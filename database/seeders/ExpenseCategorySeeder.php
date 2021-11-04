<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseCategory::insert([
            'display_name' => 'Travel',
            'description' => 'daily commute',
        ]);

        ExpenseCategory::insert([
            'display_name' => 'Entertainment',
            'description' => 'movies etc',
        ]);
    }
}
