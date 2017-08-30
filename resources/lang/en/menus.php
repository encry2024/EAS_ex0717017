<?php

return [

   /*
   |--------------------------------------------------------------------------
   | Menus Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines are used in menu items throughout the system.
   | Regardless where it is placed, a menu item can be listed here so it is easily
   | found in a intuitive way.
   |
   */

   'backend' => [
      'supplier' => [
         'all' => 'Supplier\'s List',
         'upload' => 'Upload Supplier\'s List'
      ],

      'costing_management' => [
         'title' => 'Costing',

         'all' => 'All Projects',
         'upload' => 'Upload Project List'
      ],

      'material_requisition' => [
         'title' => 'Material Requisition',

         'all' => 'All Requests',
         'create' => 'Create Request'
      ],

      'supplier' => [
         'title' => 'Supply Management',

         'all' => 'All Suppliers',
         'upload' => 'Upload Suppliers List'
      ],

      'access' => [
         'title' => 'Access Management',

         'roles' => [
            'all'        => 'All Roles',
            'create'     => 'Create Role',
            'edit'       => 'Edit Role',
            'management' => 'Role Management',
            'main'       => 'Roles',
         ],

         'users' => [
            'all'             => 'All Users',
            'change-password' => 'Change Password',
            'create'          => 'Create User',
            'deactivated'     => 'Deactivated Users',
            'deleted'         => 'Deleted Users',
            'edit'            => 'Edit User',
            'main'            => 'Users',
            'view'            => 'View User',
         ],
      ],

      'log-viewer' => [
         'main'      => 'Log Viewer',
         'dashboard' => 'Dashboard',
         'logs'      => 'Logs',
      ],

      'sidebar' => [
         'dashboard' => 'Dashboard',
         'general'   => 'General',
         'system'    => 'System',
         'management' => 'Management'
      ],
   ],

   'language-picker' => [
      'language' => 'Language',
      /*
      * Add the new language to this array.
      * The key should have the same language code as the folder name.
      * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
      * Be sure to add the new language in alphabetical order.
      */
      'langs' => [
         'ar'    => 'Arabic',
         'zh'    => 'Chinese Simplified',
         'zh-TW' => 'Chinese Traditional',
         'da'    => 'Danish',
         'de'    => 'German',
         'el'    => 'Greek',
         'en'    => 'English',
         'es'    => 'Spanish',
         'fr'    => 'French',
         'id'    => 'Indonesian',
         'it'    => 'Italian',
         'ja'    => 'Japanese',
         'nl'    => 'Dutch',
         'pt_BR' => 'Brazilian Portuguese',
         'ru'    => 'Russian',
         'sv'    => 'Swedish',
         'th'    => 'Thai',
         'tr'    => 'Turkish',
      ],
   ],
];
