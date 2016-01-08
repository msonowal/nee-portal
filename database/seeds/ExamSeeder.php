<?php

use Illuminate\Database\Seeder;
use nee_portal\Models\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create(array('exam_name' => 'NEE I', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL I', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '14 YEARS', 'start_date' =>'24/04/2016 (Sunday) from 10.00 AM to 1.00 PM',  'active' => 'YES'));
        Exam::create(array('exam_name' => 'NEE II', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL II', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '16 YEARS', 'start_date' =>'23/04/2016 (Saturday) from 10.00 AM to 1.00 PM',  'active' => 'YES'));
        Exam::create(array('exam_name' => 'NEE III', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL III', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '16 YEARS', 'start_date' =>'23/04/2016 (Saturday) from 10.00 AM to 1.00 PM',  'active' => 'YES'));
    }
}
