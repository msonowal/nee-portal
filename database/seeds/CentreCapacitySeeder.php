<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\CentreCapacity;

class CentreCapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CentreCapacity::create(array('centre_code' =>'1', 'centre_location' => 'Tripura University, Suryamaninagar-799022', 'centre_capacity' => '1500'));
        CentreCapacity::create(array('centre_code' =>'2', 'centre_location' => 'Govt. Aizawl North College, Aizawl', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'3', 'centre_location' => 'Dibrugarh University, Dibrugarh', 'centre_capacity' => '1500'));
        CentreCapacity::create(array('centre_code' =>'4', 'centre_location' => 'College of Agricultural Engg & Post Harvest Tech,Ranipool,Gangtok-737135', 'centre_capacity' => '150'));
        CentreCapacity::create(array('centre_code' =>'5', 'centre_location' => 'NERIM, PNS Bhawan, Jayanagar, Khanapara, Guwahati', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'6', 'centre_location' => 'Oriental College, Imphal Manipur', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'NERIST Main Block, Nirjuli, AP', 'centre_capacity' => '2385'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Kendriya Vidyalaya, NERIST Campus, Nirjuli, AP', 'centre_capacity' => '120'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'NERIST Degree Block, Nirjuli, AP', 'centre_capacity' => '300'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Centre for Management Studies (CMS), NERIST Campus,opposite NERIST Gymkhana', 'centre_capacity' => '150'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Govt. H.S. School, Kankarnallah, Naharlagun, AP', 'centre_capacity' => '500'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Alphabet Public School, Nirjuli', 'centre_capacity' => '300'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Kendriya Vidyalaya, Naharlagun, AP', 'centre_capacity' => '600'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'Kendriya Vidyalaya, Itanagar, AP', 'centre_capacity' => '550'));
        CentreCapacity::create(array('centre_code' =>'7', 'centre_location' => 'D.N. Govt. College, Itanagar, AP', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'8', 'centre_location' => 'Ruzhukhrie Govt. HS School, Kohima, Nagaland', 'centre_capacity' => '500'));
        CentreCapacity::create(array('centre_code' =>'9', 'centre_location' => 'Lakhimpur Girls College, North Lakhimpur', 'centre_capacity' => '450'));
        CentreCapacity::create(array('centre_code' =>'10', 'centre_location' => 'Saint Marys College, Shillong, Meghalaya', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'11', 'centre_location' => 'NIT, Silchar, Assam', 'centre_capacity' => '1000'));
        CentreCapacity::create(array('centre_code' =>'12', 'centre_location' => 'Darrang College, Tezpur, Assam', 'centre_capacity' => '1000'));
    }
}
