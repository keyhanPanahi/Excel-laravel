<?php

namespace Database\Seeders\Admin\Membership;

use App\Models\Admin\Membership\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['title' => 'نقش های کاربران','name' => 'users',],
            ['title' => 'نقش های سازمان','name' => 'organizations',],  
      
            ['title' => 'مدیر سیستم','name' => 'users_manager','parent_id' => 1],
            ['title' => 'مدیر ستادی','parent_id' => 1,'name' => 'users_staff'],
            ['title' => 'کارشناس','name' => 'users_expert','parent_id' => 1],
            ['title' => 'پشتیان','name' => 'users_support','parent_id' => 1],
            ['title' => 'کاربر عادی','name' => 'users_basic','parent_id' => 1], 
            
            ['title' => 'دانشگاه',   'parent_id' => 2,'name' => 'organizations_university'],
            ['title' => 'اداره', 'parent_id' => 2,'name' => 'organizations_office'], 
          ];
      
        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
