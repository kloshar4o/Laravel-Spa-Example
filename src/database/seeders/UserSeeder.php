<?php

namespace Database\Seeders;

use App\Helpers\Sequence;
use App\Models\Company\Company;
use App\Models\User\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_rows = [
            ['id' => 'admin', 'name' => 'Administrator'],
            ['id' => 'user', 'name' => 'User'],
        ];

        $user_rows = [
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'role' => 'admin',
                'company_id' => null,
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ],
            [
                'first_name' => 'user',
                'last_name' => 'user',
                'role' => 'user',
                'company_id' => 1,
                'email' => 'user@user.com',
                'password' => bcrypt('123456'),
            ],
        ];

        $companies = Company::all()->toArray();

        UserRole::query()->insert($role_rows);
        User::query()->insert($user_rows);
        User::factory()
            ->count(250)
            ->state(new Sequence($companies, 'company_id'))
            ->create();


    }
}
