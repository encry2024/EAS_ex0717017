<?php

namespace App\Models\Management\Costing\Item;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\Costing\Item\Traits\Scope\ItemScope;
use App\Models\Management\Costing\Item\Traits\Attribute\ItemAttribute;
use App\Models\Management\Costing\Item\Traits\Relationship\ItemRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
   //
   use ItemScope,
   SoftDeletes,
   ItemAttribute,
   ItemRelationship;

   protected $table;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['project_id', 'category', 'sub_category', 'item_type', 'item', 'quantity', 'unit', 'material'];

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
      $this->table = config('management.costing.item');
   }
}
