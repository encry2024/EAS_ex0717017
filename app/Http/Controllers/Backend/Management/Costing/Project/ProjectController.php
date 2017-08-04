<?php

namespace App\Http\Controllers\Backend\Management\Costing\Project;

use App\Models\Management\Costing\Project\Project;
use App\Models\Management\Costing\Item\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Management\Costing\Project\ProjectRepository;
use App\Http\Requests\Backend\Management\Costing\Project\ManageProjectRequest;
use App\Http\Requests\Backend\Management\Costing\Project\UploadProjectRequest;

class ProjectController extends Controller
{
   protected $projects;

   public function __construct(ProjectRepository $projects)
   {
      $this->projects = $projects;
   }
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index(ManageProjectRequest $request)
   {
      return view('backend.management.costing.index');
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      //
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      //
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show(Project $project, ManageProjectRequest $request)
   {

      return view('backend.management.material-requisition.item.index')->withProject($project);
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      //
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      //
   }

   public function uploadProjectList()
   {
      return view('backend.management.costing.upload');
   }

   public function importProjectList(UploadProjectRequest $request)
   {
      $this->projects->create([
      'data' => $request->only(
         'project_file',
         'name',
         'project_date',
         'subject',
         'location',
         'user_id'
         )
      ]);

      return redirect()->route('admin.management.costing.project.index')->withFlashSuccess(trans('alerts.backend.management.costing.project.created', ['project' => $request->get('name')]));
   }
}
