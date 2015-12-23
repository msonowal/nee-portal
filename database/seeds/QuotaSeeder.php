<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\Quota;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quota::create(array('name' => 'Arunachal Pradesh'));
        Quota::create(array('name' => 'Assam'));
        Quota::create(array('name' => 'Manipur'));
        Quota::create(array('name' => 'Meghalaya'));
        Quota::create(array('name' => 'Mizoram'));
        Quota::create(array('name' => 'Nagaland'));
        Quota::create(array('name' => 'Sikkim'));
        Quota::create(array('name' => 'Tripura'));
        Quota::create(array('name' => 'All India'));
        Quota::create(array('name' => 'PD'));
    }
}
