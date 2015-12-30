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
     	Branch::create(array('branch_name' => 'Agricultural Engineering', 'paper_code' => '30'));
     	Branch::create(array('branch_name' => 'Civil Engineering', 'paper_code' => '31'));
     	Branch::create(array('branch_name' => 'Computer Science and Engineering', 'paper_code' => '32'));
     	Branch::create(array('branch_name' => 'Electronics and Communication Engineering', 'paper_code' => '33'));
     	Branch::create(array('branch_name' => 'Electrical Engineering', 'paper_code' => '34'));
     	Branch::create(array('branch_name' => 'Mechanical Engineering', 'paper_code' => '35'));
    }
}
