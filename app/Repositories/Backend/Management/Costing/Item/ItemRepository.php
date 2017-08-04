<?php

namespace App\Repositories\Backend\Management\Costing\Item;

use App\Models\Management\Costing\Item\Item;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Management\Costing\Item\ItemCreated;
use App\Events\Backend\Management\Costing\Item\ItemDeleted;
use App\Events\Backend\Management\Costing\Item\ItemUpdated;
use App\Events\Backend\Management\Costing\Item\ItemRestored;
use App\Events\Backend\Management\Costing\Item\ItemPermanentlyDeleted;
use App\Models\Management\Costing\Project\Project;
use App\Repositories\Backend\Management\Costing\Project\ProjectRepository;
use App\Http\Requests\Backend\Management\Costing\Item\ManageItemRequest;

/**
* Class ItemRepository.
*/
class ItemRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Item::class;

   protected $project;

   /**
   * @param RoleRepository $project
   */
   public function __construct(ProjectRepository $project)
   {
      $this->project = $project;
   }

   /**
   * @param        $permissions
   * @param string $by
   *
   * @return mixed
   */
   public function getForDataTable($status = 1, $trashed = false, $project_id = null)
   {
      /**
      * Note: You must return deleted_at or the User getActionButtonsAttribute won't
      * be able to differentiate what buttons to show for each row.
      */
      $dataTableQuery = $this->query()
      ->with('project')
      ->where('project_id', '=', $project_id)
      ->select([
         config('management.management.costing.items_table').'.id',
         config('management.management.costing.items_table').'.project_id',
         config('management.management.costing.items_table').'.category',
         config('management.management.costing.items_table').'.sub_category',
         config('management.management.costing.items_table').'.item_type',
         config('management.management.costing.items_table').'.description',
         config('management.management.costing.items_table').'.item',
         config('management.management.costing.items_table').'.quantity',
         config('management.management.costing.items_table').'.unit',
         config('management.management.costing.items_table').'.material',
         config('management.management.costing.items_table').'.created_at',
         config('management.management.costing.items_table').'.updated_at',
         config('management.management.costing.items_table').'.deleted_at',
      ]);

      if ($trashed == 'true') {
         return $dataTableQuery->onlyTrashed();
      }

      // active() is a scope on the UserScope trait
      return $dataTableQuery;
   }

   public function update(Model $aircon, array $input)
   {
      $data = $input['data'];

      $aircon->name = $data['name'];
      $aircon->serial_number = $data['serial_number'];
      $aircon->manufacturer = $data['manufacturer'];
      $aircon->price = $data['price'];
      $aircon->horsepower = $data['horsepower'];
      $aircon->voltage = $data['voltage'];
      $aircon->size = $data['size'];
      $aircon->brand_name = $data['brand_name'];
      $aircon->feature = $data['feature'];
      $aircon->manufacturer = $data['manufacturer'];

      DB::transaction(function () use ($aircon, $data) {
         if ($aircon->save()) {
            event(new AirconUpdated($aircon));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.inventory.items.aircons.update_error'));
      });
   }

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
