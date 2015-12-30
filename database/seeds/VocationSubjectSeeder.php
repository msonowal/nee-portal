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
        VocationalSubject::create(['name' => '', 'paper_code'=>'']);
    }
}
