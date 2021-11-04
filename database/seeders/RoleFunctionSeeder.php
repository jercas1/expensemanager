<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\RoleFunction;

class RoleFunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        RoleFunction::truncate();

        // ================================================================================================
        // Role Function
        // ================================================================================================
        RoleFunction::insert([
            'module' => 'Role',
            'display_name' => 'Store',
            'function' => 'store',
            'uri' => 'api/role/store',
        ]);

        RoleFunction::insert([
            'module' => 'Role',
            'display_name' => 'Get',
            'function' => 'get',
            'uri' => 'api/role/get',
        ]);

        RoleFunction::insert([
            'module' => 'Role',
            'display_name' => 'Update',
            'function' => 'update',
            'uri' => 'api/role/update/{role}',
        ]);

        RoleFunction::insert([
            'module' => 'Role',
            'display_name' => 'Delete',
            'function' => 'delete',
            'uri' => 'api/role/delete/{role}',
        ]);

        RoleFunction::insert([
            'module' => 'Role',
            'display_name' => 'Get Role Function',
            'function' => 'getRoleFunction',
            'uri' => 'api/role/get-role-function',
        ]);

        // ================================================================================================
        // User Function
        // ================================================================================================
        RoleFunction::insert([
            'module' => 'User',
            'display_name' => 'Store',
            'function' => 'store',
            'uri' => 'api/user/store',
        ]);

        RoleFunction::insert([
            'module' => 'User',
            'display_name' => 'Get',
            'function' => 'get',
            'uri' => 'api/user/get',
        ]);

        RoleFunction::insert([
            'module' => 'User',
            'display_name' => 'Update',
            'function' => 'update',
            'uri' => 'api/user/update/{user}',
        ]);

        RoleFunction::insert([
            'module' => 'User',
            'display_name' => 'Delete',
            'function' => 'delete',
            'uri' => 'api/user/delete/{user}',
        ]);

        // ================================================================================================
        // Expense Category Function
        // ================================================================================================
        RoleFunction::insert([
            'module' => 'Expense Category',
            'display_name' => 'Store',
            'function' => 'store',
            'uri' => 'api/expense-category/store',
        ]);

        RoleFunction::insert([
            'module' => 'Expense Category',
            'display_name' => 'Get',
            'function' => 'get',
            'uri' => 'api/expense-category/get',
        ]);

        RoleFunction::insert([
            'module' => 'Expense Category',
            'display_name' => 'Update',
            'function' => 'update',
            'uri' => 'api/expense-category/update/{expense_category}',
        ]);

        RoleFunction::insert([
            'module' => 'Expense Category',
            'display_name' => 'Delete',
            'function' => 'delete',
            'uri' => 'api/expense-category/delete/{expense_category}',
        ]);

        // ================================================================================================
        // Expense Function
        // ================================================================================================
        RoleFunction::insert([
            'module' => 'Expense',
            'display_name' => 'Store',
            'function' => 'store',
            'uri' => 'api/expense/store',
        ]);

        RoleFunction::insert([
            'module' => 'Expense',
            'display_name' => 'Get',
            'function' => 'get',
            'uri' => 'api/expense/get',
        ]);

        RoleFunction::insert([
            'module' => 'Expense',
            'display_name' => 'Update',
            'function' => 'update',
            'uri' => 'api/expense/update/{expense}',
        ]);

        RoleFunction::insert([
            'module' => 'Expense',
            'display_name' => 'Delete',
            'function' => 'delete',
            'uri' => 'api/expense/delete/{expense}',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
