<?php

use Illuminate\Database\Seeder;
use App\Models\ExamDetail;

class ExamDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//NEE I
        ExamDetail::create(array('exam_id' =>'1', 'qualification_id' =>'1', 'eligible_for' =>'Base(Certificate) Module of Technology Stream(AE/CE/ECE/EE/ME)', 'paper_code' =>'10'));
        
        //NEE II
        ExamDetail::create(array('exam_id' =>'2', 'qualification_id' =>'2', 'eligible_for' =>'Diploma Module of Technology Stream(AE/CE/CSE/ECE/EE/ME)', 'paper_code' =>'20'));
        ExamDetail::create(array('exam_id' =>'2', 'qualification_id' =>'3', 'eligible_for' =>'Diploma Module of Technology Stream(AE/CE/CSE/ECE/EE/ME)', 'paper_code' =>'21'));
        ExamDetail::create(array('exam_id' =>'2', 'qualification_id' =>'4', 'eligible_for' =>'Degree Module of Forestry', 'paper_code' =>'29'));
        
        //NEE III
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Agricultural Engineering', 'paper_code' =>'30'));
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Civil Engineering', 'paper_code' =>'31'));
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Computer Science & Engineering', 'paper_code' =>'32'));
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Electronics & Communications Engineering', 'paper_code' =>'33'));
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Electrical Engineering', 'paper_code' =>'34'));
        ExamDetail::create(array('exam_id' =>'3', 'qualification_id' =>'5', 'eligible_for' =>'Degree Module in Mechanical Engineering', 'paper_code' =>'35'));
        
    }
}
