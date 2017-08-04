<?php

namespace App\Http\Controllers\Backend\Management\Costing\Item;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Management\Costing\Item\Item;

class ItemController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //
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

   public function fetchProjecBasedItems($project_id)
   {
      $itemJson = array();
      $items = Item::whereProjectId($project_id)->get();

      foreach($items as $item) {
         $itemJson[] = [
            'id' => $item->id,
            'item' => $item->item,

         ];
      }

      return json_encode($itemJson);
   }

   public function fetchSelecteditemInformation($item_id)
   {
      $itemInformation = array();
      $item = Item::find($item_id);

      $itemJson[] = [
         'item_id' => $item->id,
         'quantity' => $item->quantity,
         'unit' => $item->unit,
         'material' => $item->material,
         'action' => '<a class="btn btn-xs btn-danger" id="remove_item"><i class="fa fa-remove" data-toggle="tooltip" data-placement="top" title="Remove Item"></i></a> '
      ];

      return json_encode($itemJson);
   }
}
