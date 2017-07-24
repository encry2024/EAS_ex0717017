<?php

namespace App\Http\Controllers\Backend\Management\Costing\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemTableController extends Controller
{
   /**
   * @var UserRepository
   */
   protected $items;

   /**
   * @param UserRepository $users
   */
   public function __construct(ProjectRepository $items)
   {
      $this->items = $items;
   }

   /**
   * @param ManageUserRequest $request
   *
   * @return mixed
   */
   public function __invoke(ManageProjectRequest $request)
   {
      return Datatables::of(
         $this->projects->getForDataTable($request->get('status'), $request->get('trashed')))
         ->escapeColumns(['name'])
         ->addColumn('user', function ($project) {
            return $project->user->count() ?
            $project->user->last_name :
            trans('labels.general.none');
         })
         ->addColumn('actions', function ($user) {
            return $user->action_buttons;
         })
         ->withTrashed()
         ->make(true);
      }
   }
}
