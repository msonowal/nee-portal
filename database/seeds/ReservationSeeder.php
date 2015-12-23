<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//State Quota Arunachal
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1109', 'description' =>'ST, PRC holders of Arunachal Pradesh'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1211', 'description' =>'Wards of State Govt. Employee or State under taking employees of Arunachal Pradesh, Non-PRC holders.'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1212', 'description' =>'Wards of Central Govt. or Central Govt. undertaking employees serving in Arunachal Pradesh, Non-PRC holders.'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1213', 'description' =>'Other candidates (Non-PRC holders) residing in Arunachal Pradesh for not less than 3 years and not covered in any of the above reservation categories.'));
        
        //State Quota Assam
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2101', 'description' =>'General, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2102', 'description' =>'OBC, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2103', 'description' =>'SC, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2104', 'description' =>'ST, PRC holders from plain area of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2105', 'description' =>'ST, PRC holders from hill area of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2210', 'description' =>'Wards of Central Govt. / State Govt. or undertaking employees serving in Assam , Non-PRC holders.'));
        
        //State Quota Manipur
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3101', 'description' =>'General, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3102', 'description' =>'OBC, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3103', 'description' =>'SC, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3109', 'description' =>'ST, PRC holders of Manipur.'));

        //State Quota Meghalaya
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4101', 'description' =>'General, PRC holders of Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4106', 'description' =>'Khasi / Jaintia, PRC holders from Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4107', 'description' =>'Garo, PRC holders from Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4108', 'description' =>'Other ST, PRC holders from Meghalaya.'));
        
        //State Quota Mizoram
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5101', 'description' =>'General, PRC holders of Mizoram.'));
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5109', 'description' =>'ST, PRC holders Mizoram of Mizoram.'));
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5201', 'description' =>'GEC & Others (Non-PRC holders of Mizoram).'));
        
        //State Quota Nagaland
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6101', 'description' =>'General, PRC holders of Nagaland.'));
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6109', 'description' =>'ST, PRC holders of Nagaland.'));
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6201', 'description' =>'Others, Non-PRC holders of Nagaland.'));
        
        //State Quota Sikkim
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7101', 'description' =>'Merit, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7102', 'description' =>'OBC, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7103', 'description' =>'SC, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7109', 'description' =>'ST, (Excluding Bhutia & Lepcha) (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7114', 'description' =>'Most backward classes (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7115', 'description' =>'Bhutia & Lepcha , (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7216', 'description' =>'Others (children of business community and State Govt. employees of Sikkim who do not fall under the above categories of Sikkim).'));
        
        //State Quota Tripura
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8101', 'description' =>'General, PRC holders of Tripura.'));
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8103', 'description' =>'SC, PRC holders of Tripura.'));
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8109', 'description' =>'ST, PRC holders of Tripura.'));
        
        //All India Quota
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9201', 'description' =>'General, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9202', 'description' =>'OBC, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9203', 'description' =>'SC, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9209', 'description' =>'ST, Candidates from any of the States of India.'));
        
        //Physically Disabled(PD)
        Reservation::create(array('quota_id' => '10', 'reservation_code' =>'9229', 'description' =>'Physically Disabled/handicapped (PH) candidates, with 40% to 75% locomotor disability only, from any of the States of India.'));
    }
}
