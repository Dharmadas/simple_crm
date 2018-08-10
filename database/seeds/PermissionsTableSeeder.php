<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'view_user', 'description' => 'View user list.'),
            array('name' => 'view_role', 'View user list.' => 'View role list.'),
            array('name' => 'view_permission', 'View role list.' => 'View permission list.'),
            array('name' => 'view_disposition', 'View permission list.' => 'View disposition list.'),
            array('name' => 'view_department', 'View disposition list.' => 'View department list.'),
            array('name' => 'view_customer', 'View department list.' => 'View customer list.'),
            array('name' => 'view_campaign', 'View customer list.' => 'View campaign list.'),
            array('name' => 'view_business_unit', 'View campaign list.' => 'View business unit list.'),
            array('name' => 'view_dashboard', 'View business unit list.' => 'This permission to view dashboard.'),
            array('name' => 'update_user', 'This permission to view dashboard.' => 'Modify user.'),
            array('name' => 'update_role', 'Modify user.' => 'Modify role.'),
            array('name' => 'update_disposition', 'Modify role.' => 'Modify disposition.'),
            array('name' => 'update_department', 'Modify disposition.' => 'Modify department.'),
            array('name' => 'update_customer', 'Modify department.' => 'Modify customer.'),
            array('name' => 'update_campaign', 'Modify customer.' => 'Modify campaign.'),
            array('name' => 'update_business_unit', 'Modify campaign.' => 'Modify business unit.'),
            array('name' => 'create_user', 'Modify business unit.' => 'Create user.'),
            array('name' => 'create_role', 'Create user.' => 'Create role.'),
            array('name' => 'create_permission', 'Create role.' => 'Create permission.'),
            array('name' => 'create_disposition', 'Create permission.' => 'Create disposition.'),
            array('name' => 'create_department', 'Create disposition.' => 'Create department.'),
            array('name' => 'create_customer', 'Create department.' => 'Create customer.'),
            array('name' => 'create_campaign', 'Create customer.' => 'Create campaign.'),
            array('name' => 'create_business_unit', 'Create campaign.' => 'Create business unit.'),
        );

        DB::table('permissions')->insert($data);
    }
}
