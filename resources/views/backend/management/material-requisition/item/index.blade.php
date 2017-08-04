@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.costing.management'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.costing.management') }}
   <small>{{ trans('labels.backend.management.costing.item.title') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.costing.item.title') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.costing.includes.partials.costing-management-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="projects-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>{{ trans('labels.backend.management.costing.item.table.item') }}</th>
                  <th>{{ trans('labels.backend.management.costing.item.table.quantity') }}</th>
                  <th>{{ trans('labels.backend.management.costing.item.table.unit') }}</th>
                  <th>{{ trans('labels.backend.management.costing.item.table.material') }}</th>
                  <th>{{ trans('labels.backend.management.costing.item.table.created_at') }}</th>
                  <th>{{ trans('labels.backend.management.costing.item.table.updated_at') }}</th>
                  @role(1,2)
                  <th>{{ trans('labels.general.actions') }}</th>
                  @endauth
               </tr>
            </thead>
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
$(function () {
   $('#projects-table').DataTable({
      dom: 'lfrtip',
      processing: false,
      serverSide: true,
      autoWidth: false,
      ajax: {
         url: '{{ route("admin.management.costing.item.get") }}',
         type: 'post',
         data: {status: 1, trashed: false, project_id: "{{ $project->id }}"},
         error: function (xhr, err) {
            if (err === 'parsererror')
            location.reload();
         }
      },
      columns: [
         {data: 'item', name: '{{config('management.management.costing.items_table')}}.item'},
         {data: 'quantity', name: '{{config('management.management.costing.items_table')}}.quantity'},
         {data: 'unit', name: '{{config('management.management.costing.items_table')}}.unit'},
         {data: 'material', name: '{{config('management.management.costing.items_table')}}.material'},
         {data: 'created_at', name: '{{config('management.management.costing.items_table')}}.created_at'},
         {data: 'updated_at', name: '{{config('management.management.costing.items_table')}}.updated_at'},
         {data: 'actions', name: 'actions', searchable: false, sortable: false}
      ],
      order: [[0, "asc"]],
      searchDelay: 500
   });
});
</script>
@endsection
