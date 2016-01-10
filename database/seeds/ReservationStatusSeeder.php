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
    	//AP-Block Reservation
    	ReservationStatus::create(['reservation_code' => '1211', 'exam_id' => '2', 'examdetail_id' => '3']);
    	ReservationStatus::create(['reservation_code' => '1212', 'exam_id' => '2', 'examdetail_id' => '3']);
    	ReservationStatus::create(['reservation_code' => '1213', 'exam_id' => '2', 'examdetail_id' => '3']);

    	//Assam
    	ReservationStatus::create(['reservation_code' => '2104', 'exam_id' => '2', 'examdetail_id' => '3']);
    	ReservationStatus::create(['reservation_code' => '2105', 'exam_id' => '2', 'examdetail_id' => '3']);
    	ReservationStatus::create(['reservation_code' => '2103', 'exam_id' => '2', 'examdetail_id' => '3']);

    	//Manipur
    	ReservationStatus::create(['reservation_code' => '3103', 'exam_id' => '2', 'examdetail_id' => '2']);
    	ReservationStatus::create(['reservation_code' => '3103', 'exam_id' => '3', 'examdetail_id' => '4']);
    	ReservationStatus::create(['reservation_code' => '3103', 'exam_id' => '2', 'examdetail_id' => '3']); 

    	//Meghalaya
    	ReservationStatus::create(['reservation_code' => '4108', 'exam_id' => '2', 'examdetail_id' => '2']);
    	ReservationStatus::create(['reservation_code' => '4108', 'exam_id' => '3', 'examdetail_id' => '4']);

    	//Mizoram
    	ReservationStatus::create(['reservation_code' => '5101', 'exam_id' => '2', 'examdetail_id' => '3']);
    	ReservationStatus::create(['reservation_code' => '5201', 'exam_id' => '3', 'examdetail_id' => '4']);
    	ReservationStatus::create(['reservation_code' => '5201', 'exam_id' => '2', 'examdetail_id' => '3']);

    	//Nagaland
    	ReservationStatus::create(['reservation_code' => '6101', 'exam_id' => '2', 'examdetail_id' => '3']);
        ReservationStatus::create(['reservation_code' => '6201', 'exam_id' => '2', 'examdetail_id' => '3']);

    	//Sikkim
    	ReservationStatus::create(['reservation_code' => '7103', 'exam_id' => '3', 'examdetail_id' => '4']);
    	ReservationStatus::create(['reservation_code' => '7101', 'exam_id' => '3', 'examdetail_id' => '4']);
    	ReservationStatus::create(['reservation_code' => '7216', 'exam_id' => '2', 'examdetail_id' => '2']);

    	//All India
    	ReservationStatus::create(['reservation_code' => '9209', 'exam_id' => '2', 'examdetail_id' => '2']);
    }	
}
