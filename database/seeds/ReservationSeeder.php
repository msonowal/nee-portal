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
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1109', 'category_name' => 'ST', 'description' =>'ST, PRC holders of Arunachal Pradesh'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1211', 'category_name' => 'GENERAL', 'description' =>'Wards of State Govt. Employee or State under taking employees of Arunachal Pradesh, Non-PRC holders.'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1212', 'category_name' => 'GENERAL', 'description' =>'Wards of Central Govt. or Central Govt. undertaking employees serving in Arunachal Pradesh, Non-PRC holders.'));
        Reservation::create(array('quota_id' => '1', 'reservation_code' =>'1213', 'category_name' => 'GENERAL', 'description' =>'Other candidates (Non-PRC holders) residing in Arunachal Pradesh for not less than 3 years and not covered in any of the above reservation categories.'));
        
        //State Quota Assam
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2102', 'category_name' => 'OBC', 'description' =>'OBC, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2103', 'category_name' => 'SC', 'description' =>'SC, PRC holders of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2104', 'category_name' => 'ST', 'description' =>'ST, PRC holders from plain area of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2105', 'category_name' => 'ST', 'description' =>'ST, PRC holders from hill area of Assam.'));
        Reservation::create(array('quota_id' => '2', 'reservation_code' =>'2210', 'category_name' => 'GENERAL', 'description' =>'Wards of Central Govt. / State Govt. or undertaking employees serving in Assam , Non-PRC holders.'));
        
        //State Quota Manipur
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3102', 'category_name' => 'OBC', 'description' =>'OBC, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3103', 'category_name' => 'SC', 'description' =>'SC, PRC holders of Manipur.'));
        Reservation::create(array('quota_id' => '3', 'reservation_code' =>'3109', 'category_name' => 'ST', 'description' =>'ST, PRC holders of Manipur.'));

        //State Quota Meghalaya
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4106', 'category_name' => 'ST', 'description' =>'Khasi / Jaintia, PRC holders from Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4107', 'category_name' => 'ST', 'description' =>'Garo, PRC holders from Meghalaya.'));
        Reservation::create(array('quota_id' => '4', 'reservation_code' =>'4108', 'category_name' => 'ST', 'description' =>'Other ST/SC, PRC holders from Meghalaya.'));
        
        //State Quota Mizoram
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Mizoram.'));
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5109', 'category_name' => 'ST', 'description' =>'ST, PRC holders Mizoram of Mizoram.'));
        Reservation::create(array('quota_id' => '5', 'reservation_code' =>'5201', 'category_name' => 'GENERAL', 'description' =>'GEC & Others (Non-PRC holders of Mizoram).'));
        
        //State Quota Nagaland
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Nagaland.'));
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6109', 'category_name' => 'ST', 'description' =>'ST, PRC holders of Nagaland.'));
        Reservation::create(array('quota_id' => '6', 'reservation_code' =>'6201', 'category_name' => 'GENERAL', 'description' =>'Others, Non-PRC holders of Nagaland.'));
        
        //State Quota Sikkim
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7101', 'category_name' => 'GENERAL', 'description' =>'Merit, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7102', 'category_name' => 'OBC', 'description' =>'OBC, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7103', 'category_name' => 'SC', 'description' =>'SC, (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7109', 'category_name' => 'ST', 'description' =>'ST, (Excluding Bhutia & Lepcha) (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7114', 'category_name' => 'OBC', 'description' =>'Most backward classes (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7115', 'category_name' => 'ST', 'description' =>'Bhutia & Lepcha , (Local with Sikkim Subject Certificate/Certificate of Identification).'));
        Reservation::create(array('quota_id' => '7', 'reservation_code' =>'7216', 'category_name' => 'GENERAL', 'description' =>'Others (children of business community and State Govt. employees of Sikkim who do not fall under the above categories of Sikkim).'));
        
        //State Quota Tripura
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8101', 'category_name' => 'GENERAL', 'description' =>'General, PRC holders of Tripura.'));
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8103', 'category_name' => 'SC', 'description' =>'SC, PRC holders of Tripura.'));
        Reservation::create(array('quota_id' => '8', 'reservation_code' =>'8109', 'category_name' => 'ST', 'description' =>'ST, PRC holders of Tripura.'));
        
        //All India Quota
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9201', 'category_name' => 'GENERAL', 'description' =>'General, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9202', 'category_name' => 'OBC', 'description' =>'OBC, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9203', 'category_name' => 'SC', 'description' =>'SC, Candidates from any of the States of India.'));
        Reservation::create(array('quota_id' => '9', 'reservation_code' =>'9209', 'category_name' => 'ST', 'description' =>'ST, Candidates from any of the States of India.'));
        
        //Physically Disabled(PD)
        Reservation::create(array('quota_id' => '10', 'reservation_code' =>'9229', 'category_name' => 'PD', 'description' =>'Physically Disabled/handicapped (PH) candidates, with 40% to 75% locomotor disability only, from any of the States of India.'));
    }
}
