<?php

namespace App\Model\Management\MaterialRequisition\Request\RequestProject;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\Costing\Item\Item;

class RequestProject extends Model
{
   //
   public function item()
   {
      return $this->belongsTo(Item::class);
   }
}
