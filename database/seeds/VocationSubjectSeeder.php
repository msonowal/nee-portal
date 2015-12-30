<?php

use Illuminate\Database\Seeder;

use nee_portal\Models\VocationalSubject;

class VocationSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VocationalSubject::create(['name' => 'Farm Equipment', 'paper_code'=>'21']);
        VocationalSubject::create(['name' => 'Food Processing', 'paper_code'=>'22']);
        VocationalSubject::create(['name' => 'Construction Technology', 'paper_code'=>'23']);
        VocationalSubject::create(['name' => 'Electronics Technology/ Electronics Maintenance', 'paper_code'=>'24']);
        VocationalSubject::create(['name' => 'Electrical Technology/ Electrical Maintenance', 'paper_code'=>'25']);
        VocationalSubject::create(['name' => 'Mechanical Craftsmanship', 'paper_code'=>'26']);
        VocationalSubject::create(['name' => 'Automobile Technology', 'paper_code'=>'27']);
        VocationalSubject::create(['name' => 'Refrigeration and Air Conditioning', 'paper_code'=>'28']);

    }
}
