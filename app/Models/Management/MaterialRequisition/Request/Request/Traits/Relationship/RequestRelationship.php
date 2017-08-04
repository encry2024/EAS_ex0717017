<?php

namespace App\Models\Management\MaterialRequisition\Request\Request\Traits\Relationship;

use App\Model\Management\MaterialRequisition\Request\RequestProject\RequestProject;

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
   public function request_projects()
   {
      return $this->hasMany(RequestProject::class);
   }

   public function user()
   {
      return $this->belongsTo(config('auth.providers.users.model'));
   }

}
