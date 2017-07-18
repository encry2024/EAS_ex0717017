<?php

namespace App\Models\Management\Costing\Project;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\Costing\Project\Traits\Scope\ProjectScope;
use App\Models\Management\Costing\Project\Traits\Attribute\ProjectAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

   use ProjectScope,
   SoftDeletes,
   ProjectAttribute;

   protected $table;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['first_name', 'last_name', 'email', 'password', 'status', 'confirmation_code', 'confirmed'];

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
      $this->table = config('management.costing.projects_table');
   }
}
