<?php

use Illuminate\Database\Seeder;

use App\Models\Centre;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Centre::create(array('centre_code' => '01', 'centre_name' => 'Agartala', 'centre_state' =>'Tripura', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '02', 'centre_name' => 'Aizawl', 'centre_state' =>'Mizoram', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '03', 'centre_name' => 'Dibrugarh', 'centre_state' =>'Assam', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '04', 'centre_name' => 'Gangtok', 'centre_state' =>'Sikkim', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '05', 'centre_name' => 'Guwahati', 'centre_state' =>'Assam', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '06', 'centre_name' => 'Imphal', 'centre_state' =>'Manipur', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '07', 'centre_name' => 'Itanagar', 'centre_state' =>'Arunachal Pradesh', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '08', 'centre_name' => 'Kohima', 'centre_state' =>'Nagaland', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '09', 'centre_name' => 'North Lakhimpur', 'centre_state' =>'Assam', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '10', 'centre_name' => 'Shillong', 'centre_state' =>'Meghalaya', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '11', 'centre_name' => 'Silchar', 'centre_state' =>'Assam', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
        Centre::create(array('centre_code' => '12', 'centre_name' => 'Tezpur', 'centre_state' =>'Assam', 'NEE I' =>'0', 'NEE II' =>'0', 'NEE III' =>'0'));
    }
}
