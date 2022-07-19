<?php

namespace Database\Seeders\Membership;

use App\Models\Membership\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run()
    {
        $orgs = [
            [
                'name' => 'سازمان 1',
                'national_code' => rand(111111, 999999),
                'status' => 1,
                'inderpent' => 0,
                //    'manager_id' => 1,
                'national_code' => rand(111111, 999999),
                //    'logo' => 'image/avatar/main-organization.webp' 
            ],
            [
                'name' => 'سازمان 2',
                'parent_id' =>  1,
                'status' => 0,
                'inderpent' => 1,
                //    'manager_id' => 1,
                'national_code' => rand(111111, 999999),
                //    'logo' => 'image/avatar/main-organization.webp' 
            ],
            [
                'name' => 'سازمان 3',
                'parent_id' =>  1,
                'status' => 1,
                'inderpent' => 1,
                //    'manager_id' =>  1,
                'national_code' => rand(111111, 999999),
                //    'logo' => 'image/avatar/main-organization.webp' 
            ],
        ];

        foreach ($orgs as $org) {
            Organization::create($org);
        }
    }
}
