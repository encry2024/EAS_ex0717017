<?php

namespace App\Repositories\Backend\Management\MaterialRequisition\Request\Request;


use App\Models\Management\MaterialRequisition\Request\Request\Request;
use App\Repositories\Backend\Access\User\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestCreated;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestDeleted;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestUpdated;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestRestored;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestUploaded;
use App\Events\Backend\Management\MaterialRequisition\Request\Request\RequestPermanentlyDeleted;

/**
* Class RequestRepository.
*/
class RequestRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Request::class;

   protected $user;

   /**
   * @param RoleRepository $user
   */
   public function __construct(UserRepository $user)
   {
      $this->user = $user;
   }

   /**
   * @param        $permissions
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
      ->with(['user'])
      ->select([
         config('management.material_requisition.requests_table').'.id',
         config('management.material_requisition.requests_table').'.user_id',
         config('management.material_requisition.requests_table').'.mr_control_number',
         config('management.material_requisition.requests_table').'.date_needed',
         config('management.material_requisition.requests_table').'.created_at',
         config('management.material_requisition.requests_table').'.updated_at',
         config('management.material_requisition.requests_table').'.deleted_at',
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

      $request = $this->createRequestStub($data);

      DB::transaction(function () use ($request, $data) {
         if ($request->save()) {


            event(new RequestCreated($request));

            return true;
         }

         throw new GeneralException(trans('exceptions.backend.management.costing.project.create_error'));
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

   protected function createRequestStub($input)
   {
      $request = self::MODEL;
      $request = new $request;
      $request->mr_control_number   =  $input['mr_control_number'];
      $request->date_needed         =  $input['date_needed'];
      $request->user_id             =  $input['user_id'];
      $request->remarks             =  $input['remarks'];
      $request->date                =  $input['date'];

      return $request;
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
