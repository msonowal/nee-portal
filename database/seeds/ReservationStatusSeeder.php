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
    	ReservationStatus::create(['reservation_code' => '1109', 'qualification_id' => '1', 'exam_id' => '1', 'examdetail_id' => '1', 'status' => 'active']);        
    	ReservationStatus::create(['reservation_code' => '2103', 'qualification_id' => '2', 'exam_id' => '1', 'examdetail_id' => '1', 'status' => 'inactive']);        
    	ReservationStatus::create(['reservation_code' => '1212', 'qualification_id' => '3', 'exam_id' => '2', 'examdetail_id' => '3', 'status' => 'inactive']);        
    	ReservationStatus::create(['reservation_code' => '2103', 'qualification_id' => '3', 'exam_id' => '1', 'examdetail_id' => '1', 'status' => 'active']);        
    	ReservationStatus::create(['reservation_code' => '3101', 'qualification_id' => '2', 'exam_id' => '2', 'examdetail_id' => '2', 'status' => 'inactive']);        
    }
}
