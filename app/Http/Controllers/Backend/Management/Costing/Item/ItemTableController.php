<?php

namespace App\Http\Controllers\Backend\Management\Costing\Item;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Repositories\Backend\Management\Costing\Item\ItemRepository;
use App\Http\Requests\Backend\Management\Costing\Item\ManageItemRequest;

class ItemTableController extends Controller
{
   /**
   * @var UserRepository
   */
   protected $items;

   /**
   * @param UserRepository $users
   */
   public function __construct(ItemRepository $items)
   {
      $this->items = $items;
   }

   /**
   * @param ManageUserRequest $request
   *
   * @return mixed
   */
   public function __invoke(ManageItemRequest $request)
   {
      return Datatables::of(
      $this->items->getForDataTable($request->get('status'), $request->get('trashed'), $request->get('project_id')))
      ->escapeColumns(['item'])
      ->addColumn('actions', function ($user) {
         return $user->action_buttons;
      })
      ->withTrashed()
      ->make(true);
   }
}
