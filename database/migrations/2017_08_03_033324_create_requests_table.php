<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('requests', function (Blueprint $table) {
         $table->increments('id');

         $table->integer('project_id')->unsigned();
         $table->string('mr_control_number')->unique();
         $table->date('date_needed');
         $table->string('remarks');

         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('requests');
   }
}
