@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.material_requisition.management') . ' | ' . trans('labels.backend.management.material_requisition.request.request.request.create'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.material_requisition.management') }}
   <small>{{ trans('labels.backend.management.material_requisition.request.request.request.create') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.management.material_requisition.request.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.material_requisition.request.request.request.create') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.material-requisition.request.request.includes.partials.material-requisition-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="form-group">
         {{ Form::label('project_id', trans('validation.attributes.backend.management.material_requisition.request.request.project_id'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            <select data-placeholder="Choose a Project..." id="projectDropdown" name="project" class="form-control chosen-select project-select">
               <option value=""></option>
               @foreach($projects as $project)
               <option value="{{ $project->id }}">{{ $project->name }}</option>
               @endforeach
            </select>
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('mr_control_number', trans('validation.attributes.backend.management.material_requisition.request.request.mr_control_number'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('mr_control_number', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.mr_control_number')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('date', trans('validation.attributes.backend.management.material_requisition.request.request.date'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('date', date('Y-m-d'), ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.date')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('date_needed', trans('validation.attributes.backend.management.material_requisition.request.request.date_needed'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('date_needed', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.date_needed_placeholder')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->


      <table id="requests-table" class="table table-condensed table-hover">
         <thead>
            <tr>
               <th>{{ trans('labels.backend.management.costing.item.table.item_and_description') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.quantity') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.unit') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.material') }}</th>
               <th>{{ trans('labels.general.actions') }}</th>
            </tr>
         </thead>

         <tfoot>
            <tr>
               <td>
                  <a class="btn btn-success" id="add_more_item">Add More Item</a>
               </td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
         </tfoot>

         <tbody id="items-container">
            <tr>

               <td>
                  <select data-placeholder="Item and Description" id="itemDropdown" name="item[]" class="form-control chosen-select iDown">
                  </select>
               </td>
               <td>
                  <input type="text" name="quantity[]" class="form-control" id="quantity" value="">
               </td>
               <td>
                  <input type="text" name="unit[]" class="form-control" id="unit" value="">
               </td>
               <td>
                  <input type="text" name="material[]" class="form-control" id="material" value="">
               </td>
               <td>
                  <div id="actions"></div>
               </td>
            </tr>
         </tbody>
      </table>
   </div><!--box-->

   <div class="box box-info">
      <div class="box-body">
         <div class="pull-left">
            {{ link_to_route('admin.management.material_requisition.request.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
         </div><!--pull-left-->

         <div class="pull-right">
            {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}

   <script type="text/javascript">
   $(document).ready(function() {
      $('#projectDropdown').chosen().change(function() {
         var project_id = $('#projectDropdown').val();
         var fetchProjectBasedItemUrl = "{{ route('admin.management.costing.item.by.project_based', ':project_id') }}";
         fetchProjectBasedItemUrl = fetchProjectBasedItemUrl.replace(':project_id', project_id);

         $('.iDown').empty();

         $(".iDown").append('<option value=""></option>');
         $.getJSON(fetchProjectBasedItemUrl, function (data) {
            var items = [];
            $.each(data, function(key, val) {
               items.push('<option value="' + val.id + '">' + val.item + '</option>')
            })

            $(".iDown").append(items);
            $(".iDown").trigger("chosen:updated");
            $(".iDown").chosen({ width: "100%" }).change(function() {
               var item_id = $(this).val();
               var closestTr = $(this).closest('tr');

               var fetchSelecteditemInformation = "{{ route('admin.management.costing.item.get.information', ':item_id') }}";
               fetchSelecteditemInformation = fetchSelecteditemInformation.replace(':item_id', item_id);

               closestTr.find('#actions').empty();

               $.getJSON(fetchSelecteditemInformation, function (data) {
                  var itemInformation = [];
                  $.each(data, function(key, val) {
                     closestTr.find('#quantity').val(val.quantity);
                     closestTr.find('#quantity').attr('name', 'quantity['+val.item_id+']');

                     closestTr.find('#unit').val(val.unit);
                     closestTr.find('#unit').attr('name', 'unit['+val.item_id+']');

                     closestTr.find('#material').val(val.material);
                     closestTr.find('#material').attr('name', 'material['+val.item_id+']');

                     closestTr.find('#actions').append(val.action);

                  })
               });
            });
         });
      });

      $("#add_more_item").click(function(){
         $("#items-container").append(
            "<tr>"+
               "<td>"+
                  "<select data-placeholder='Item and Description' id='itemDropdown' name='item[]' class='form-control chosen-select iDown'></select>"+
               "</td>"+
               "<td>"+
                  "<input type='text' class='form-control' id='quantity'>"+
               "</td>"+
               "<td>"+
                  "<input type='text' class='form-control' id='unit'>"+
               "</td>"+
               "<td>"+
                  "<input type='text' class='form-control' id='material'>"+
               "</td>"+
               "<td>"+
                  "<div id='actions'></div>"+
               "</td>"+
            "</tr>"
         );
      });


      $('#requests-table').on('click', '#remove_item', function(){
         $(this).closest ('tr').remove ();
      });
   });
   </script>
   @endsection
