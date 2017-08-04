@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.material_requisition.management'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.material_requisition.management') }}
   <small>{{ trans('labels.backend.management.material_requisition.request.request.request.title') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.material_requisition.request.request.request.title') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.material-requisition.request.request.includes.partials.material-requisition-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="requests-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>{{ trans('labels.backend.management.material_requisition.request.request.request.table.mr_control_number') }}</th>
                  <th>{{ trans('labels.backend.management.material_requisition.request.request.request.table.user') }}</th>
                  <th>{{ trans('labels.backend.management.material_requisition.request.request.request.table.date_needed') }}</th>
                  <th>{{ trans('labels.backend.management.material_requisition.request.request.request.table.created_at') }}</th>
                  <th>{{ trans('labels.backend.management.material_requisition.request.request.request.table.updated_at') }}</th>
                  @role(3)
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
      {!! history()->renderType('Request') !!}
   </div><!-- /.box-body -->
</div><!--box box-success-->
@endsection

@section('after-scripts')
{{ Html::script("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.js") }}
{{ Html::script("js/backend/plugin/datatables/dataTables-extend.js") }}

<script>
$(function () {
   $('#requests-table').DataTable({
      dom: 'lfrtip',
      processing: false,
      serverSide: true,
      autoWidth: false,
      ajax: {
         url: '{{ route("admin.management.material_requisition.request.get") }}',
         type: 'post',
         data: {status: 1, trashed: false},
         error: function (xhr, err) {
            if (err === 'parsererror')
            location.reload();
         }
      },
      columns: [
         {data: 'mr_control_number', name: '{{config('management.management.material_requisition.requests_table')}}.mr_control_number'},
         {data: 'user', name: '{{config('management.management.material_requisition.user_table')}}.last_name'},
         {data: 'date_needed', name: '{{config('management.management.material_requisition.requests_table')}}.date_needed'},
         {data: 'created_at', name: '{{config('management.management.material_requisition.requests_table')}}.created_at'},
         {data: 'updated_at', name: '{{config('management.management.material_requisition.requests_table')}}.updated_at'},
         {data: 'actions', name: 'actions', searchable: false, sortable: false}
      ],
      order: [[0, "asc"]],
      searchDelay: 500
   });
});
</script>
@endsection
