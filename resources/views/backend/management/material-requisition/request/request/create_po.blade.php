@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.costing.management') . ' | ' . trans('labels.backend.management.costing.upload'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.costing.management') }}
   <small>{{ trans('labels.backend.management.costing.upload') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.management.costing.request.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
<input type="hidden" name="request" value="{{ $request->id }}">
<input type="hidden" name="supplier" value="{{ $supplier }}">

<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.costing.upload') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.costing.includes.partials.costing-management-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="form-group">
         {{ Form::label('vendor', 'Vendor', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('vendor', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Vendor']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('vendor_address', 'Vendor Address', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('vendor_address', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => 'Vendor Address']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('payment_terms', 'Payment Terms',
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('payment_terms', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Payment Terms']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('order_date', 'Order Date', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('order_date', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Order Date']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('phone', 'Phone', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('phone', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Phone']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('verbal', 'Verbal', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('verbal', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Verbal']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('quotation', 'Quotation', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('quotation', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Quotation']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('purchaser', 'Purchaser', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('purchaser', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Purchaser']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('manager', 'Manager', ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('manager', '', ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => 'Manager']) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <table class="table">
         <thead>
            <th>ITEM NO.</th>
            <th>DESCRIPTION</th>
            <th>QTY</th>
            <th>UNIT</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
         </thead>

         <tbody>
            @foreach($request_projects as $request_project)
            <tr>
               <td>{{ $request_project->item->id }}</td>
               <td>{{ $request_project->item->item }}</td>
               <td>{{ $request_project->ordered_quantity }}</td>
               <td>{{ $request_project->unit }}</td>
               <td>{{ $request_project->material }}</td>
               <td>
                  {{ number_format($request_project->ordered_quantity * $request_project->material, 2) }}
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>

   </div><!--box-->

   <div class="box box-info">
      <div class="box-body">
         <div class="pull-left">
            {{ link_to_route('admin.management.costing.project.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
         </div><!--pull-left-->

         <div class="pull-right">
            {{ Form::submit('Export data to PDF', ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}
   @endsection
