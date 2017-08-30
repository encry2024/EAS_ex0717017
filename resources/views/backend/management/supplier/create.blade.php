@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.supplier.management') . ' | ' . trans('labels.backend.management.supplier.upload'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.supplier.management') }}
   <small>{{ trans('labels.backend.management.supplier.upload') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.management.supplier.upload', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.supplier.upload') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.supplier.includes.partials.supplier-header-button')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="form-group">
         {{ Form::label('supplier_file', trans('validation.attributes.backend.management.supplier.supplier_list'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::file('supplier_file', ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.supplier.supplier_list')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

   </div><!--box-->

   <div class="box box-info">
      <div class="box-body">
         <div class="pull-left">
            {{ link_to_route('admin.management.costing.project.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
         </div><!--pull-left-->

         <div class="pull-right">
            {{ Form::submit(trans('buttons.backend.management.costing.crudu.upload'), ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}
   @endsection
