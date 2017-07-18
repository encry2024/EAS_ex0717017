<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('items', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('project_id')->unsigned();
         $table->string('category');
         $table->string('sub_category');
         $table->string('item_type');
         $table->string('description');
         $table->string('item');
         $table->bigInteger('quantity');
         $table->string('unit');
         $table->string('material');
         $table->timestamps();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::dropIfExists('items');
   }
}
