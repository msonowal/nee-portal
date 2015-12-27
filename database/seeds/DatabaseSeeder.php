<?php

use nee_portal\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
       Model::unguard();

       factory(Admin::class, 5)->create();     
       $this->call(QualificationSeeder::class);
       $this->call(ExamSeeder::class);
       $this->call(CentreSeeder::class);  
       $this->call(CentreCapacitySeeder::class);       
       $this->call(BranchSeeder::class); 
       $this->call(QuotaSeeder::class);
       $this->call(ReservationSeeder::class);
       $this->call(ExamDetailSeeder::class);
       $this->call(AlliedBranchSeeder::class);
       $this->call(ExamQualificationSeeder::class); 

       Model::reguard();
   }
}