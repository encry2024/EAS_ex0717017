<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
   /**
   * Run the migrations.
   *
   * @return void
   */
   public function up()
   {
      Schema::create('purchase_orders', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('request_id');
         $table->integer('supplier_id');
         $table->string('vendor');
         $table->string('vendor_address');
         $table->string('payment_terms');
         $table->string('order_date');
         $table->string('phone');
         $table->string('verbal');
         $table->string('quotation');
         $table->string('purchaser');
         $table->string('manager');
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
      Schema::dropIfExists('purchase_orders');
   }
}
