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
        Qualification::create(array('qualification' => '10 with Science and Mathematics'));
        Qualification::create(array('qualification' => '10+2 PCM'));
        Qualification::create(array('qualification' => '10+2 (Vocational)/ITI/NERIST Certificate'));
        Qualification::create(array('qualification' => '10+2 PCB'));
        Qualification::create(array('qualification' => 'Diploma in Engineering/Technology(AE/CE/ECE/EE/ME)'));
    }
}
