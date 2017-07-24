@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.costing.management'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.costing.management') }}
   <small>{{ trans('labels.backend.management.costing.list') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.costing.list') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.costing.includes.partials.costing-management-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="projects-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Sub-Category</th>
                  <th>Item Type</th>
                  <th>Item</th>
                  <th>Quantity</th>
                  <th>Price</th>
               </tr>
            </thead>

            <tbody>
               @foreach($items as $project_item)
               <tr>
                  <td>{{ $project_item->id }}</td>
                  <td>{{ $project_item->category }}</td>
                  <td>{{ $project_item->sub_category }}</td>
                  <td>{{ $project_item->item_type }}</td>
                  <td>{{ $project_item->item }}</td>
                  <td>{{ $project_item->quantity }}</td>
                  <td>{{ $project_item->material }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div><!--table-responsive-->
   </div><!-- /.box-body -->
</div><!--box-->

<div class="box box-info">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
      <div class="box-tools pull-right">
         <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box tools -->
   </div><!-- /.box-header -->
   <div class="box-body">
      {!! history()->renderType('Project') !!}
   </div><!-- /.box-body -->
</div><!--box box-success-->
@endsection

@section('after-scripts')
{{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

<script>

</script>
@endsection
