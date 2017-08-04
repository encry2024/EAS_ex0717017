<?php

namespace App\Events\Backend\Management\Costing\Item;

use Illuminate\Queue\SerializesModels;

/**
* Class ItemUpdated.
*/
class ItemUpdated
{
   use SerializesModels;

   /**
   * @var
   */
   public $item;

   /**
   * @param $item
   */
   public function __construct($item)
   {
      $this->item = $item;
   }
}
