<?php

namespace App\Events\Backend\Management\Costing\Item;

use Illuminate\Queue\SerializesModels;

/**
* Class RequestPermanentlyDeleted.
*/
class RequestPermanentlyDeleted
{
   use SerializesModels;

   /**
   * @var
   */
   public $request;

   /**
   * @param $request
   */
   public function __construct($request)
   {
      $this->request = $request;
   }
}
