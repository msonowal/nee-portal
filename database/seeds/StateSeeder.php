<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       State::create(array('state_name' => 'Andaman and Nicobar Islands'));
       State::create(array('state_name' => 'Andhra Pradesh'));
       State::create(array('state_name' => 'Arunachal Pradesh'));
       State::create(array('state_name' => 'Assam'));
       State::create(array('state_name' => 'Bihar'));
       State::create(array('state_name' => 'Chandigarh'));
       State::create(array('state_name' => 'Chattisgarh'));
       State::create(array('state_name' => 'Dadra and Nagar Haveli'));
       State::create(array('state_name' => 'Daman and Diu'));
       State::create(array('state_name' => 'Delhi'));
       State::create(array('state_name' => 'Goa'));
       State::create(array('state_name' => 'Gujarat'));
       State::create(array('state_name' => 'Haryana'));
       State::create(array('state_name' => 'Himachal Pradesh'));
       State::create(array('state_name' => 'Jammu and Kashmir'));
       State::create(array('state_name' => 'Jharkhand'));
       State::create(array('state_name' => 'Karnataka'));
       State::create(array('state_name' => 'Kerala'));
       State::create(array('state_name' => 'Lakshadweep'));
       State::create(array('state_name' => 'Madhya Pradesh'));
       State::create(array('state_name' => 'Maharashtra'));
       State::create(array('state_name' => 'Manipur'));
       State::create(array('state_name' => 'Meghalaya'));
       State::create(array('state_name' => 'Mizoram'));
       State::create(array('state_name' => 'Nagaland'));
       State::create(array('state_name' => 'Orissa'));
       State::create(array('state_name' => 'Pondicherry'));
       State::create(array('state_name' => 'Punjab'));
       State::create(array('state_name' => 'Rajasthan'));
       State::create(array('state_name' => 'Sikkim'));
       State::create(array('state_name' => 'Tamil Nadu'));
       State::create(array('state_name' => 'Tripura'));
       State::create(array('state_name' => 'Uttar Pradesh'));
       State::create(array('state_name' => 'Uttarakhand'));
       State::create(array('state_name' => 'West Bengal'));
       State::create(array('state_name' => 'Uttaranchal'));
    }
}
