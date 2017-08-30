@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.supplier.management'))

@section('after-styles')
{{ Html::style("https://cdn.datatables.net/v/bs/dt-1.10.15/datatables.min.css") }}
@endsection

@section('page-header')
<h1>
   {{ trans('labels.backend.management.supplier.management') }}
   <small>{{ trans('labels.backend.management.supplier.management') }}</small>
</h1>
@endsection

@section('content')
<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.supplier.list') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.supplier.includes.partials.supplier-header-button')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="table-responsive">
         <table id="suppliers-table" class="table table-condensed table-hover">
            <thead>
               <tr>
                  <th>{{ trans('labels.backend.management.supplier.table.name') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.product_name') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.brand') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.unit_price') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.type_of_product') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.created_at') }}</th>
                  <th>{{ trans('labels.backend.management.supplier.table.updated_at') }}</th>
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
   $('#suppliers-table').DataTable({
      dom: 'lfrtip',
      processing: false,
      serverSide: true,
      autoWidth: false,
      ajax: {
         url: '{{ route("admin.management.supplier.get") }}',
         type: 'post',
         data: {status: 1, trashed: false},
         error: function (xhr, err) {
            if (err === 'parsererror')
            location.reload();
         }
      },
      columns: [
         {data: 'name', name: '{{config('management.management.supplier.suppliers_table')}}.name'},
         {data: 'product_name', name: '{{config('management.management.supplier.suppliers_table')}}.product_name'},
         {data: 'brand', name: '{{config('management.management.supplier.suppliers_table')}}.brand'},
         {data: 'unit_price', name: '{{config('management.management.supplier.suppliers_table')}}.unit_price'},
         {data: 'type_of_product', name: '{{config('management.management.supplier.suppliers_table')}}.type_of_product'},
         {data: 'created_at', name: '{{config('management.management.supplier.suppliers_table')}}.created_at'},
         {data: 'updated_at', name: '{{config('management.management.supplier.suppliers_table')}}.updated_at'},
      ],
      order: [[0, "asc"]],
      searchDelay: 500
   });
});
</script>
@endsection
