@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.material_requisition.management') . ' | ' . trans('labels.backend.management.material_requisition.request.request.request.create'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.material_requisition.management') }}
   <small>{{ trans('labels.backend.management.material_requisition.request.request.request.create') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['class' => 'form-horizontal', 'role' => 'form']) }}
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
         {{ Form::label('mr_control_number', trans('validation.attributes.backend.management.material_requisition.request.request.mr_control_number'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('mr_control_number', $request->mr_control_number, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.mr_control_number')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('date', trans('validation.attributes.backend.management.material_requisition.request.request.date'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('date', date('F d, Y', strtotime($request->created_at)), ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.date')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('date_needed', trans('validation.attributes.backend.management.material_requisition.request.request.date_needed'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('date_needed', $request->date_needed, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.material_requisition.request.request.date_needed_placeholder')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->


      <table id="requests-table" class="table table-condensed table-hover">
         <thead>
            <tr>
               <th>{{ trans('labels.backend.management.costing.item.table.item_and_description') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.quantity') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.unit') }}</th>
               <th>{{ trans('labels.backend.management.costing.item.table.material') }}</th>
            </tr>
         </thead>

         <tbody id="items-container">
            @foreach($request->request_projects as $request_project)
            <tr>
               <td>{{ $request_project->item->item }}</td>
               <td>{{ $request_project->ordered_quantity }}</td>
               <td>{{ $request_project->unit }}</td>
               <td>{{ $request_project->material }}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div><!--box-->
   {{ Form::close() }}
   @endsection
