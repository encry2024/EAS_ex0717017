<?php

namespace App\Http\Controllers\Backend\Management\MaterialRequisition\Request\Request;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\MaterialRequisition\Request\Request\RequestRepository;
use App\Http\Requests\Backend\Management\MaterialRequisition\Request\Request\ManageRequestRequest;

/**
* Class RequestTableController.
*/
class RequestTableController extends Controller
{
   /**
   * @var UserRepository
   */
   protected $requests;

   /**
   * @param UserRepository $users
   */
   public function __construct(RequestRepository $requests)
   {
      $this->requests = $requests;
   }

   /**
   * @param ManageUserRequest $request
   *
   * @return mixed
   */
   public function __invoke(ManageRequestRequest $data)
   {
      return Datatables::of(
         $this->requests->getForDataTable($data->get('status'), $data->get('trashed')))
         ->escapeColumns(['name'])
         ->addColumn('user', function ($request) {
            return $request->user->count() ?
            $request->user->last_name :
            trans('labels.general.none');
         })
         ->addColumn('actions', function ($user) {
            return $user->action_buttons;
         })
         ->withTrashed()
         ->make(true);
      }
   }
