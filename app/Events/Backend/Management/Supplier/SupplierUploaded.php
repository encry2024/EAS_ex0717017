<?php

namespace App\Events\Backend\Management\Supplier;

use Illuminate\Queue\SerializesModels;

/**
* Class SupplierUploaded.
*/
class SupplierUploaded
{
   use SerializesModels;

   /**
   * @var
   */
   public $supplier;

   /**
   * @param $supplier
   */
   public function __construct($supplier)
   {
      $this->supplier = $supplier;
   }
}
