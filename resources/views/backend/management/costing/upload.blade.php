@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.management.costing.management') . ' | ' . trans('labels.backend.management.costing.upload'))

@section('page-header')
<h1>
   {{ trans('labels.backend.management.costing.management') }}
   <small>{{ trans('labels.backend.management.costing.upload') }}</small>
</h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.management.costing.project.import', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="box box-success">
   <div class="box-header with-border">
      <h3 class="box-title">{{ trans('labels.backend.management.costing.upload') }}</h3>

      <div class="box-tools pull-right">
         @include('backend.management.costing.includes.partials.costing-management-header-buttons')
      </div><!--box-tools pull-right-->
   </div><!-- /.box-header -->

   <div class="box-body">
      <div class="form-group">
         {{ Form::label('name', trans('validation.attributes.backend.management.costing.project.name'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('name', old('name'), ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.management.costing.project.name')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('subject', trans('validation.attributes.backend.management.costing.project.subject'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('subject', old('subject'), ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.management.costing.project.subject')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('location', trans('validation.attributes.backend.management.costing.project.location'),
         ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('location', old('location'), ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.costing.project.location')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('project_date', trans('validation.attributes.backend.management.costing.project.project_date'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('project_date', null, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.costing.project.project_date')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('uploaded_by', trans('validation.attributes.backend.management.costing.project.uploaded_by'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::text('uploaded_by', access()->user()->full_name, ['class' => 'form-control', 'maxlength' => '191', 'required' => 'required', 'readOnly' => 'true', 'placeholder' => trans('validation.attributes.backend.management.costing.project.uploaded_by')]) }}
         </div><!--col-lg-10-->
      </div><!--form control-->

      <div class="form-group">
         {{ Form::label('project_file', trans('validation.attributes.backend.management.costing.project.project_file'), ['class' => 'col-lg-2 control-label']) }}

         <div class="col-lg-10">
            {{ Form::file('project_file', ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('validation.attributes.backend.management.costing.project.project_file')]) }}
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
