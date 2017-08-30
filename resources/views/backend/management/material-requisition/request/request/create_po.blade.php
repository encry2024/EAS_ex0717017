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
            {{ Form::submit('Export to PDF', ['class' => 'btn btn-success btn-xs']) }}
         </div><!--pull-right-->

         <div class="clearfix"></div>
      </div><!-- /.box-body -->
   </div><!--box-->

   {{ Form::close() }}
   @endsection
