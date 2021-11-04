<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleDetail;

class RoleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Detail for Administrator/Superuser
        for ($i = 1; $i <= 17; $i++) {
            RoleDetail::insert([
                'role_id' => 1,
                'role_function_id' => $i,
            ]);
        }

        // Role Detail for User
        RoleDetail::insert([
            'role_id' => 2,
            'role_function_id' => 11,
        ]);

        for ($i = 14; $i <= 17; $i++) {
            RoleDetail::insert([
                'role_id' => 2,
                'role_function_id' => $i,
            ]);
        }
    }
}
