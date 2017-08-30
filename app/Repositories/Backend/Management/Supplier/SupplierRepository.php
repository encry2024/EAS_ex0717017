<?php

namespace App\Repositories\Backend\Management\Supplier;

use Excel;
use App\Models\Management\Supplier\Supplier;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Management\Supplier\SupplierCreated;
use App\Events\Backend\Management\Supplier\SupplierDeleted;
use App\Events\Backend\Management\Supplier\SupplierUpdated;
use App\Events\Backend\Management\Supplier\SupplierUploaded;
use App\Events\Backend\Management\Supplier\SupplierRestored;
use App\Events\Backend\Management\Supplier\SupplierPermanentlyDeleted;
use App\Http\Requests\Backend\Management\Supplier\ManageSupplierRequest;

/**
* Class SupplierRepository.
*/
class SupplierRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Supplier::class;

   /**
   * @param $permissions
   * @param string $by
   *
   * @return mixed
   */
   public function getForDataTable($status = 1, $trashed = false)
   {
      /**
      * Note: You must return deleted_at or the User getActionButtonsAttribute won't
      * be able to differentiate what buttons to show for each row.
      */
      $dataTableQuery = $this->query()
      ->select([
         config('management.supplier.suppliers_table').'.id',
         config('management.supplier.suppliers_table').'.name',
         config('management.supplier.suppliers_table').'.product_name',
         config('management.supplier.suppliers_table').'.type_of_product',
         config('management.supplier.suppliers_table').'.brand',
         config('management.supplier.suppliers_table').'.unit_price',
         config('management.supplier.suppliers_table').'.created_at',
         config('management.supplier.suppliers_table').'.updated_at',
         config('management.supplier.suppliers_table').'.deleted_at',
      ]);

      if ($trashed == 'true') {
         return $dataTableQuery->onlyTrashed();
      }

      // active() is a scope on the UserScope trait
      return $dataTableQuery;
   }

   public function create($input)
   {
      $data = $input['data'];

      DB::transaction(function () use ($data)
      {
         $path = $data['supplier_file']->getRealPath();

         $supplierFile = Excel::load($path, function($reader) {})->get();

            if(!empty($supplierFile) && $supplierFile->count()) {

               foreach ($supplierFile->toArray() as $key => $value) {
                  $insert[] = [
                     'name' => $value['name'],
                     'product_name' => $value['product_name'],
                     'brand' => $value['brand'],
                     'unit_price' => $value['unit_price'],
                     'type_of_product' => $value['type_of_product'],
                     'created_at' => date('Y-m-d h:i:s'),
                     'updated_at' => date('Y-m-d h:i:s')
                  ];
               }

               if(!empty($insert)) {
                  Supplier::insert($insert);

                  //event(new SupplierUploaded($supplier));

                  return true;
               }
            }

            throw new GeneralException(trans('exceptions.backend.management.supplier.create_error'));
         });
      }

      // public function update(Model $aircon, array $input)
      // {
      //    $data = $input['data'];
      //
      //    $aircon->name = $data['name'];
      //    $aircon->serial_number = $data['serial_number'];
      //    $aircon->manufacturer = $data['manufacturer'];
      //    $aircon->price = $data['price'];
      //    $aircon->horsepower = $data['horsepower'];
      //    $aircon->voltage = $data['voltage'];
      //    $aircon->size = $data['size'];
      //    $aircon->brand_name = $data['brand_name'];
      //    $aircon->feature = $data['feature'];
      //    $aircon->manufacturer = $data['manufacturer'];
      //
      //    DB::transaction(function () use ($aircon, $data) {
      //       if ($aircon->save()) {
      //          event(new AirconUpdated($aircon));
      //
      //          return true;
      //       }
      //
      //       throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.update_error'));
      //    });
      // }

      // public function delete(Model $aircon)
      // {
      //    if ($aircon->delete()) {
      //       event(new AirconDeleted($aircon));
      //
      //       return true;
      //    }
      //
      //    throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.delete_error'));
      // }
      //
      // public function forceDelete(Model $aircon)
      // {
      //    if (is_null($aircon->deleted_at)) {
      //       throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.delete_first'));
      //    }
      //
      //    DB::transaction(function () use ($aircon) {
      //       if ($aircon->forceDelete()) {
      //          event(new AirconPermanentlyDeleted($aircon));
      //
      //          return true;
      //       }
      //
      //       throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.delete_error'));
      //    });
      // }
      //
      // public function restore(Model $aircon)
      // {
      //    if (is_null($aircon->deleted_at)) {
      //       throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.cant_restore'));
      //    }
      //
      //    if ($aircon->restore()) {
      //       event(new AirconRestored($aircon));
      //
      //       return true;
      //    }
      //
      //    throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.restore_error'));
      // }
   }
