<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableInRequestProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('request_projects', function (Blueprint $table) {
         $table->string('quantity')->nullable()->change();
         $table->string('unit')->nullable()->change();
         $table->string('ordered_quantity')->nullable()->change();
         $table->string('material')->nullable()->change();
      });
   }

   /**
   * Reverse the migrations.
   *
   * @return void
   */
   public function down()
   {
      Schema::table('request_projects', function (Blueprint $table) {
         //
      });
   }
}
