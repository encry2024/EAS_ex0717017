<?php

namespace App\Models\Management\MaterialRequisition\Request\Request\Traits\Relationship;

/**
* Class RequestRelationship.
*/
trait RequestRelationship
{
   /**
   * One-to-One relations with Role.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
   // public function projects()
   // {
   //    return $this->hasMany(config('management.costing.project'));
   // }

   public function user()
   {
      return $this->belongsTo(config('auth.providers.users.model'));
   }

}
