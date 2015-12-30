<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerFormNoGeneration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared("
      CREATE TRIGGER tr_candidate_frm_no_gen BEFORE INSERT ON `nee_candidate_info` FOR EACH ROW
      BEGIN
	       declare form_no varchar(50);
        select auto_increment into form_no from information_schema.TABLES where TABLE_NAME ='nee_candidate_info' and TABLE_SCHEMA='nee_portal';
        set form_no = LPAD(form_no, 6, '0');
   	    SET NEW.form_no = form_no;
       END
      ");
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_candidate_frm_no_gen`');
    }
}
