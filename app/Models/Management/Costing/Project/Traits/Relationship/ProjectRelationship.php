<?php

namespace App\Models\Management\Costing\Project\Traits\Relationship;

/**
* Class ProjectRelationship.
*/
trait ProjectRelationship
{
   /**
   * One-to-One relations with Role.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
   public function items()
   {
      return $this->hasMany(config('management.management.costing.item'));
   }

   public function user()
   {
      return $this->belongsTo(config('auth.providers.users.model'));
   }

}
