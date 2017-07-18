<?php

/**
* All route names are prefixed with 'admin.access'.
*/
Route::group([
   'prefix'     => 'management',
   'as'         => 'management.',
   'middleware' => 'access.routeNeedsPermission:view-backend',
], function () {

   Route::group([
      'prefix' => 'costing',
      'as'     => 'costing.',
   ], function() {
      Route::group([
         'as'     => 'project.',
         'namespace' => 'Management\Costing\Project'
      ], function() {
         Route::get('project/list/upload', 'ProjectController@uploadProjectList')->name('upload');
         Route::post('project/list/import', 'ProjectController@importProjectList')->name('import');

         Route::post('projects/get', 'ProjectTableController')->name('get');

         Route::resource('project/', 'ProjectController');

      });
   });



});
