<?php

use Illuminate\Database\Seeder;
use nee_portal\Models\ExamQualification;

class ExamQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExamQualification::create(array('q_id' => '1', 'exam_id' => '1'));
        ExamQualification::create(array('q_id' => '2', 'exam_id' => '1'));
        ExamQualification::create(array('q_id' => '2', 'exam_id' => '2'));
        ExamQualification::create(array('q_id' => '3', 'exam_id' => '1'));
        ExamQualification::create(array('q_id' => '3', 'exam_id' => '2'));
        ExamQualification::create(array('q_id' => '4', 'exam_id' => '1'));
        ExamQualification::create(array('q_id' => '4', 'exam_id' => '2'));
        ExamQualification::create(array('q_id' => '5', 'exam_id' => '1'));
        ExamQualification::create(array('q_id' => '5', 'exam_id' => '2'));
        ExamQualification::create(array('q_id' => '5', 'exam_id' => '3'));
    }
}
