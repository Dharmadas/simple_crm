<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'This is superuser.',
            'permissions' => 'view_dashboard,view_user,view_role,view_permission,view_business_unit,view_department,view_campaign,view_disposition,view_customer, create_dashboard,create_user,create_role,create_permission,create_business_unit,create_department,create_campaign,create_disposition,create_customer,update_dashboard,update_user,update_role,update_business_unit,update_department,update_campaign,update_disposition,update_customer',
        ]);
    }
}
