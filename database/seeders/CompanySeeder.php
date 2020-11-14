<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\Company\CompanyAddress;
use App\Models\Company\CompanyStatus;
use Illuminate\Database\Seeder;
use App\Helpers\Sequence;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            ['value' => 'active', 'label' => 'Active'],
            ['value' => 'disabled', 'label' => 'Disabled'],
        ];


        CompanyStatus::query()->insert($statuses);

        $companies = Company::factory()
            ->count(10)
            ->state(new Sequence($statuses, 'company_status', 'value'))
            ->create()
            ->toArray();

        CompanyAddress::factory()
            ->count(50)
            ->state(new Sequence($companies, 'company_id'))
            ->create();
    }
}
