<div class="pull-right mb-10 hidden-sm hidden-xs">
   {{ link_to_route('admin.management.material_requisition.request.index', trans('menus.backend.material_requisition.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
   @role(3)
   {{ link_to_route('admin.management.material_requisition.request.create', trans('menus.backend.material_requisition.create'), [], ['class' => 'btn btn-info btn-xs']) }}
   @endauth
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
   <div class="btn-group">
      <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
         {{ trans('menus.backend.access.users.main') }} <span class="caret"></span>
      </button>

      <ul class="dropdown-menu" role="menu">
         <li>{{ link_to_route('admin.access.user.index', trans('menus.backend.access.users.all')) }}</li>
         <li>{{ link_to_route('admin.access.user.create', trans('menus.backend.access.users.create')) }}</li>
         <li class="divider"></li>
         <li>{{ link_to_route('admin.access.user.deactivated', trans('menus.backend.access.users.deactivated')) }}</li>
         <li>{{ link_to_route('admin.access.user.deleted', trans('menus.backend.access.users.deleted')) }}</li>
      </ul>
   </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
