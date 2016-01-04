<?php

use Illuminate\Database\Seeder;
use nee_portal\Models\ReservationStatus;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	ReservationStatus::create(['reservation_code' => '1109', 'exam_id' => '1', 'examdetail_id' => '1']);        
    }
}
