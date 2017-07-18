<?php

namespace App\Http\Controllers\Backend\Management\Costing\Project;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\Costing\Project\ProjectRepository;
use App\Http\Requests\Backend\Management\Costing\Project\ManageProjectRequest;

/**
* Class ProjectTableController.
*/
class ProjectTableController extends Controller
{
   /**
   * @var UserRepository
   */
   protected $projects;

   /**
   * @param UserRepository $users
   */
   public function __construct(ProjectRepository $projects)
   {
      $this->projects = $projects;
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
         ->addColumn('actions', function ($user) {
            return $user->action_buttons;
         })
         ->withTrashed()
         ->make(true);
      }
   }
