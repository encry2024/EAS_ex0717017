<?php

namespace App\Events\Backend\Management\Costing\Item;

use Illuminate\Queue\SerializesModels;

/**
* Class RequestCreated.
*/
class RequestCreated
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
