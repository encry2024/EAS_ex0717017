<?php

namespace App\Http\Controllers\Backend\Management\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Management\Supplier\Supplier;
use App\Repositories\Backend\Management\Supplier\SupplierRepository;
use App\Http\Requests\Backend\Management\Supplier\ManageSupplierRequest;
use App\Http\Requests\Backend\Management\Supplier\UploadSupplierRequest;

class SupplierController extends Controller
{
   protected $suppliers;

   public function __construct(SupplierRepository $suppliers)
   {
      $this->suppliers = $suppliers;
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index(ManageSupplierRequest $request)
   {
      return view('backend.management.supplier.index');
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('backend.management.supplier.create');
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
   public function show($id)
   {
      //
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

   public function uploadSupplier(UploadSupplierRequest $request)
   {
      $this->suppliers->create([
      'data' => $request->only(
         'supplier_file'
         )
      ]);

      return redirect()->route('admin.management.supplier.index')->withFlashSuccess(trans('alerts.backend.management.supplier.created'));
   }
}
