<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSupplierIdInRequestProjectsTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::table('request_projects', function (Blueprint $table) {
         $table->integer('supplier_id')->after('item_id');
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
         $table->dropColumn('supplier_id');
      });
   }
}
