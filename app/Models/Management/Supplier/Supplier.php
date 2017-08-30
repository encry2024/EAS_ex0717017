<?php

namespace App\Models\Management\Supplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\Management\Supplier\Traits\Relationship\SupplierRelationship;
use App\Models\Management\Supplier\Traits\Attribute\SupplierAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
   //
   use SoftDeletes, SupplierAttribute;

   protected $table;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = ['name', 'product_name', 'brand', 'unit_price', 'type_of_product'];

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
      $this->table = config('management.supplier.supplier');
   }
}
