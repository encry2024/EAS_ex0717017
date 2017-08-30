<?php

namespace App\Http\Controllers\Backend\Management\MaterialRequisition\Request\Request;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Management\Costing\Project\Project;
use App\Models\Management\MaterialRequisition\Request\RequestProject\RequestProject;
use App\Models\Management\Costing\Item\Item;
use App\Models\Management\MaterialRequisition\Request\Request\Request as RequestModel;

use App\Repositories\Backend\Management\MaterialRequisition\Request\Request\RequestRepository;
use App\Http\Requests\Backend\Management\MaterialRequisition\Request\Request\ManageRequestRequest;

use Auth;

class RequestController extends Controller
{
   protected $requests;

   public function __construct(RequestRepository $requests)
   {
      $this->requests = $requests;
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index(ManageRequestRequest $request)
   {
      return view('backend.management.material-requisition.request.request.index');
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      $projects = Project::all();

      return view('backend.management.material-requisition.request.request.create', compact('projects'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      // dd($request->all());
      $request_model = new RequestModel();
      $request_model->user_id = Auth::user()->id;
      $request_model->mr_control_number = $request->get('mr_control_number');
      $request_model->date_needed = $request->get('date_needed');
      $request_model->remarks = '-';

      if($request_model->save()) {
         foreach((array) $request->get('item') as $item_id) {
            $request_project = new RequestProject();
            $request_project->item_id = $item_id;
            $request_project->request_id = $request_model->id;
            $request_project->project_id = $request->get('project');
            if($request_project->save()) {
               //var_dump($request_project->id); **** 36-39
               foreach($request->all() as $key => $value) {
                  if(strpos($key, 'quantity') !== FALSE)  {
                     foreach($value as $item_id => $quantity_value) {
                        if($item_id == $request_project->item_id) {
                           $request_project->ordered_quantity = $quantity_value;
                           $request_project->save();
                        }
                     }
                  }

                  if(strpos($key, 'unit') !== FALSE)  {
                     foreach($value as $item_id => $unit_value) {
                        if($item_id == $request_project->item_id) {
                           $request_project->unit = $unit_value;
                           $request_project->save();
                        }
                     }
                  }

                  if(strpos($key, 'material') !== FALSE)  {
                     foreach($value as $item_id => $material_value) {
                        if($item_id == $request_project->item_id) {
                           $request_project->material = $material_value;
                           $request_project->save();
                        }
                     }
                  }

                  if(strpos($key, 'supplier') !== FALSE)  {
                     foreach($value as $item_id => $supplier_id) {
                        if($item_id == $request_project->item_id) {
                           $request_project->supplier_id = $supplier_id;
                           $request_project->save();
                        }
                     }
                  }
               }

               return redirect()->route('admin.management.material_requisition.request.index')->withFlashSuccess('Request was successfully created.');
            }
         }
      }
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show(RequestModel $request)
   {
      $suppliers = RequestProject::whereRequestId($request->id)->groupBy('request_id')->get();

      // dd($supplier);

      return view('backend.management.material-requisition.request.request.show', compact('request', 'suppliers'));
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

   public function createPurchaseOrder(RequestModel $request, $supplier)
   {
      $request_projects = RequestProject::whereRequestId($request->id)->whereSupplierId($supplier)->get();
      //dd($request_projects);

      return view('backend.management.material-requisition.request.request.create_po', compact('request_projects'));
   }
}
