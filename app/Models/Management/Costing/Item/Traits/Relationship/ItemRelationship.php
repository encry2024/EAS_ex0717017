<?php

namespace App\Models\Management\Costing\Item\Traits\Relationship;

/**
* Class ItemRelationship.
*/
trait ItemRelationship
{
   /**
   * One-to-One relations with Role.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
   public function project()
   {
      return $this->belongsTo(config('management.management.costing.project'));
   }

}
