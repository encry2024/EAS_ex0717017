<?php

return [

   /*
   |--------------------------------------------------------------------------
   | Buttons Language Lines
   |--------------------------------------------------------------------------
   |
   | The following language lines are used in buttons throughout the system.
   | Regardless where it is placed, a button can be listed here so it is easily
   | found in a intuitive way.
   |
   */

   'backend' => [
      'management' => [
         'costing' => [
            'crudu' => [
               'create' => 'Create',
               'view'   => 'View',
               'delete' => 'Delete',
               'edit'   => 'Edit',
               'update' => 'Update',
               'upload' => 'Upload'
            ],

            'restore_project'   => 'Restore Project',

            'item' => [
               'adu' => [
                  'add'     => 'Add Stocks',
                  'edit'    => 'Edit',
                  'delete'  => 'Delete'
               ]
            ]
         ],

         'material_requisition' => [
            'request' => [
               'request' => [
                  'crud' => [
                     'create' => 'Create',
                     'edit' => 'Edit',
                     'view' => 'View',
                     'delete' => 'Delete',

                  ],

                  'restore' => 'Restore Request'
               ]
            ]
         ]
      ],

      'access' => [
         'users' => [
            'activate'           => 'Activate',
            'change_password'    => 'Change Password',
            'clear_session'         => 'Clear Session',
            'confirm'             => 'Confirm',
            'deactivate'         => 'Deactivate',
            'delete_permanently' => 'Delete Permanently',
            'login_as'           => 'Login As :user',
            'resend_email'       => 'Resend Confirmation E-mail',
            'restore_user'       => 'Restore User',
            'unconfirm'             => 'Un-confirm',
            'unlink' => 'Unlink',
         ],
      ],
   ],

   'emails' => [
      'auth' => [
         'confirm_account' => 'Confirm Account',
         'reset_password'  => 'Reset Password',
      ],
   ],

   'general' => [
      'cancel' => 'Cancel',
      'continue' => 'Continue',

      'crud' => [
         'create' => 'Create',
         'delete' => 'Delete',
         'edit'   => 'Edit',
         'update' => 'Update',
         'view'   => 'View',
      ],

      'save' => 'Save',
      'view' => 'View',
   ],
];
