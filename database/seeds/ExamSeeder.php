<?php

use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create(array('exam_code' => '101', 'exam_name' => 'NEE I', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL I', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '14 YEARS', 'start_date' =>'MAY 25,2016(10 AM to 12 AM)',  'active' => 'YES'));
        Exam::create(array('exam_code' => '102', 'exam_name' => 'NEE II', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL II', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '16 YEARS', 'start_date' =>'MAY 26,2016(10 AM to 12 AM)',  'active' => 'YES'));
        Exam::create(array('exam_code' => '103', 'exam_name' => 'NEE III', 'description' => 'NERIST ENTRANCE EXAMINATION LEVEL III', 'n_price' => '750.00', 'scst_price' => '400.00', 'min_age' => '16 YEARS', 'start_date' =>'MAY 27,2016(10 AM to 12 AM)',  'active' => 'YES'));
    }
}
