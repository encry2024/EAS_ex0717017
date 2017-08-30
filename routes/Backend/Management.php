<?php

/**
* All route names are prefixed with 'admin.access'.
*/
Route::group([
   'prefix'     => 'management',
   'as'         => 'management.',
], function () {

   Route::group([
      'prefix' => 'costing',
      'as'     => 'costing.',
   ], function() {

      Route::get('export_pdf/{purchase_order}', function(\App\Models\Management\Costing\PurchaseOrder\PurchaseOrder $purchase_order) {
         $request_projects = \App\Models\Management\MaterialRequisition\Request\RequestProject\RequestProject::whereRequestId($purchase_order->request_id)->whereSupplierId($purchase_order->supplier_id)->get();

         return view('backend.management.costing.purchase_order', compact('request_projects', 'purchase_order'));
      })->name('export.pdf');

      Route::group([
         'prefix' => 'request',
         'as'     => 'request.',
         'namespace' => 'Management\MaterialRequisition\Request\Request'
      ], function() {
         Route::post('request/store', 'RequestController@exportToPDF')->name('store');
      });

      Route::group([
         'as'     => 'project.',
         'namespace' => 'Management\Costing\Project'
      ], function() {
         Route::get('project/{project}', 'ProjectController@show')->name('project_item.show');
         Route::get('project/list/upload', 'ProjectController@uploadProjectList')->name('upload');
         Route::post('project/list/import', 'ProjectController@importProjectList')->name('import');

         Route::post('projects/get', 'ProjectTableController')->name('get');

         Route::resource('project/', 'ProjectController');

      });

      Route::group([
         'as' => 'item.',
         'namespace' => 'Management\Costing\Item'
      ], function() {
         Route::post('items/get', 'ItemTableController')->name('get');

         Route::get('fetch_items/{project_id}', 'ItemController@fetchProjecBasedItems')->name('by.project_based');

         Route::get('item/{item_id}/information', 'ItemController@fetchSelecteditemInformation')->name('get.information');

         Route::resource('item/', 'ItemController');
      });
   });

   Route::group([
      'prefix' => 'material_requisition',
      'as'     => 'material_requisition.'
   ], function() {
      Route::group([
         'as'        => 'request.',
         'namespace' => 'Management\MaterialRequisition\Request\Request'
      ], function() {
         Route::post('request/get', 'RequestTableController')->name('get');

         Route::resource('request/', 'RequestController');
         Route::get('request/{request}', 'RequestController@show')->name('project_item.show');

         Route::get('request/{request}/supplier/{supplier}/create/po', 'RequestController@createPurchaseOrder')->name('create.po');
         Route::get('request/{request_project}/create/single/po', 'RequestController@createSinglePurchaseOrder')->name('create.single.po');


         Route::get('purchase_order/', function() {
            return view('backend.management.costing.purchase_order');
         });
      });
   });

   Route::group([
      'as'     => 'supplier.',
      'namespace' => 'Management\Supplier'
   ], function() {
      Route::post('request/get', 'SupplierTableController')->name('get');

      Route::resource('supplier/', 'SupplierController');

      Route::post('supplier/upload', 'SupplierController@uploadSupplier')->name('upload');
   });

});
