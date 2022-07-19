<?php

namespace Database\Seeders\Admin\Membership;

use App\Models\Admin\Membership\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'=>'users',
                'title'=>'مجوز های کاربری',
            ],
            [
                'name'=>'organization',
                'title'=>'مجوزهای سازمانی',
            ],
            [
                'name'=>'users.permission1',
                'title'=>'مجوز کاربر - 1',
                'parent_id'=>1
            ],
            [
                'name'=>'users.permission2',
                'title'=>'مجوز کاربر - 2',
                'parent_id'=>1
            ],
            [
                'name'=>'organization.permission1',
                'title'=>'مجوز سازمان - 1',
                'parent_id'=>2
            ],
            [
                'name'=>'organization.permission2',
                'title'=>'مجوز سازمان - 2',
                'parent_id'=>2
            ],

        ];
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
