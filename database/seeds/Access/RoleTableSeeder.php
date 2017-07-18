<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
* Class RoleTableSeeder.
*/
class RoleTableSeeder extends Seeder
{
   use DisableForeignKeys, TruncateTable;

   /**
   * Run the database seed.
   *
   * @return void
   */
   public function run()
   {
      $this->disableForeignKeys();
      $this->truncate(config('access.roles_table'));

      $roles = [
         [
            'name'       => 'Administrator',
            'all'        => true,
            'sort'       => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
         [
            'name'       => 'Costing Management',
            'all'        => false,
            'sort'       => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
         [
            'name'       => 'Material Requisition Management',
            'all'        => false,
            'sort'       => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
         [
            'name'       => 'User',
            'all'        => false,
            'sort'       => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
         [
            'name'       => 'Inventory Management',
            'all'        => true,
            'sort'       => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
         [
            'name'       => 'Finance Management',
            'all'        => true,
            'sort'       => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ],
      ];

      DB::table(config('access.roles_table'))->insert($roles);

      $this->enableForeignKeys();
   }
}
