<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\Qualification;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qualification::create(array('qualification' => '10 with Science and Mathematics', 'NEE_I' => 'YES', 'NEE_II' => 'NO', 'NEE_III' => 'NO'));
        Qualification::create(array('qualification' => '10+2 PCM', 'NEE_I' => 'YES', 'NEE_II' => 'YES', 'NEE_III' => 'NO'));
        Qualification::create(array('qualification' => '10+2 (Vocational)/ITI/NERIST Certificate', 'NEE_I' => 'YES', 'NEE_II' => 'YES', 'NEE_III' => 'NO'));
        Qualification::create(array('qualification' => '10+2 PCB', 'NEE_I' => 'YES', 'NEE_II' => 'YES', 'NEE_III' => 'NO'));
        Qualification::create(array('qualification' => 'Diploma in Engineering/Technology(AE/CE/ECE/EE/ME)', 'NEE_I' => 'YES', 'NEE_II' => 'YES', 'NEE_III' => 'YES'));
    }
}
