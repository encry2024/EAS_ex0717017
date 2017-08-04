<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('request_projects', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('request_id')->unsigned();
         $table->integer('project_id')->unsigned();
         $table->integer('item_id')->unsigned();
         $table->string('quantity');
         $table->string('unit');
         $table->string('ordered_quantity');
         $table->string('material');
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
      Schema::dropIfExists('request_projects');
   }
}
