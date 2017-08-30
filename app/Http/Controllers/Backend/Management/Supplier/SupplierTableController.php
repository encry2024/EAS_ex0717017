<?php

namespace App\Http\Controllers\Backend\Management\Supplier;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\Supplier\SupplierRepository;
use App\Http\Requests\Backend\Management\Supplier\ManageSupplierRequest;

class SupplierTableController extends Controller
{
   /**
   * @var UserRepository
   */
   protected $suppliers;

   /**
   * @param UserRepository $users
   */
   public function __construct(SupplierRepository $suppliers)
   {
      $this->suppliers = $suppliers;
   }

   /**
   * @param ManageUserRequest $request
   *
   * @return mixed
   */
   public function __invoke(ManageSupplierRequest $request)
   {
      return Datatables::of(
      $this->suppliers->getForDataTable($request->get('trashed')))
      ->escapeColumns(['product_name'])
      ->withTrashed()
      ->make(true);
   }
}
