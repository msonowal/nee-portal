<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     	Branch::create(array('branch_name' => 'Agricultural Engineering'));
     	Branch::create(array('branch_name' => 'Civil Engineering'));
     	Branch::create(array('branch_name' => 'Computer Science and Engineering'));
     	Branch::create(array('branch_name' => 'Electronics and Communication Engineering'));
     	Branch::create(array('branch_name' => 'Electrical Engineering'));
     	Branch::create(array('branch_name' => 'Mechanical Engineering'));
    }
}
