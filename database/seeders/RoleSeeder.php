<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'id' => 1,
            'display_name' => 'Administrator',
            'description' => 'Superuser',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::insert([
            'id' => 2,
            'display_name' => 'User',
            'description' => 'User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
