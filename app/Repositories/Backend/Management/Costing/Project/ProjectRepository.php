<?php

namespace App\Repositories\Backend\Management\Costing\Project;

use App\Models\Management\Costing\Project\Project;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Events\Management\Costing\Project\ProjectCreated;
use App\Events\Management\Costing\Project\ProjectDeleted;
use App\Events\Management\Costing\Project\ProjectUpdated;
use App\Events\Management\Costing\Project\ProjectRestored;
use App\Events\Management\Costing\Project\ProjectUploaded;
use App\Events\Management\Costing\Project\ProjectPermanentlyDeleted;

/**
* Class ProjectRepository.
*/
class ProjectRepository extends BaseRepository
{
   /**
   * Associated Repository Model.
   */
   const MODEL = Project::class;

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
      ->select([
         config('management.costing.projects_table').'.id',
         config('management.costing.projects_table').'.name',
         config('management.costing.projects_table').'.subject',
         config('management.costing.projects_table').'.location',
         config('management.costing.projects_table').'.project_date',
         config('management.costing.projects_table').'.created_at',
         config('management.costing.projects_table').'.updated_at',
         config('management.costing.projects_table').'.deleted_at',
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

      $project = $this->uploadProjectStub($data);

      DB::transaction(function () use ($project, $data) {
         if ($project->save()) {

            $path = $data->file('project_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();

               if(!empty($data) && $data->count()){

                  foreach ($data->toArray() as $key => $value) {
                     $insert[] = [
                        'project_id' => $project->id,
                        'category' => $value['category'],
                        'sub_category' => $value['sub_category'],
                        'item_type' => $value['item_type'],
                        'description' => $value['description'],
                        'item' => $value['item'],
                        'quantity' => $value['quantity'],
                        'unit' => $value['unit'],
                        'price' => $value['material'],
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s')
                     ];
                  }


                  if(!empty($insert)){
                     Item::insert($insert);
                     return back()->with('success','Insert Record successfully.');
                  }

               }

            }

            event(new ProjectUploaded($project));

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

   protected function uploadProjectStub($input)
   {
      $project = self::MODEL;
      $project = new $project;
      $project->name = $input['name'];
      $project->location = $input['location'];
      $project->project_date = $input['project_date'];
      $project->user_id = $input['user_id'];
      $project->subject = $input['subject'];


      return $project;
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
