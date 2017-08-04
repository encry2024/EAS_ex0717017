<?php

namespace App\Models\Management\MaterialRequisition\Request\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\MaterialRequisition\Request\Request\Traits\Scope\RequestScope;
use App\Models\Management\MaterialRequisition\Request\Request\Traits\Attribute\RequestAttribute;
use App\Models\Management\MaterialRequisition\Request\Request\Traits\Relationship\RequestRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
   use RequestScope,
   SoftDeletes,
   RequestAttribute,
   RequestRelationship;

   protected $table;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['mr_control_number', 'date_needed', 'user_id', 'remarks', 'date'];

   /**
   * @var array
   */
   protected $dates = ['deleted_at'];


   /**
   * @param array $attributes
   */
   public function __construct(array $attributes = [])
   {
      parent::__construct($attributes);
      $this->table = config('management.request.requests_table');
   }
}
