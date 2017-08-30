<?php

namespace App\Models\Management\MaterialRequisition\Request\RequestProject\Traits\Relationship;

use App\Models\Management\Costing\Item\Item;
use App\Models\Management\Supplier\Supplier;

/**
* Class RequestProjectRelationship.
*/
trait RequestProjectRelationship
{
   /**
   * One-to-One relations with Role.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
   public function item()
   {
      return $this->belongsTo(Item::class);
   }

   public function supplier()
   {
      return $this->belongsTo(Supplier::class);
   }
}
