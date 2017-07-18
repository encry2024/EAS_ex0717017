<?php

use Carbon\Carbon;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;

/**
 * Class PermissionTableSeeder.
 */
class PermissionTableSeeder extends Seeder
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
        $this->truncateMultiple([config('access.permissions_table'), config('access.permission_role_table')]);

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php.
         */

        /**
         * Misc Access Permissions.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-backend';
        $viewBackend->display_name = 'View Backend';
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewCostingManagement = new $permission_model();
        $viewCostingManagement->name = 'view-costing-management';
        $viewCostingManagement->display_name = 'View Costing Management';
        $viewCostingManagement->created_at = Carbon::now();
        $viewCostingManagement->updated_at = Carbon::now();
        $viewCostingManagement->save();

        $permission_model = config('access.permission');
        $editCostingManagement = new $permission_model();
        $editCostingManagement->name = 'edit-costing-management';
        $editCostingManagement->display_name = 'Edit Costing Management';
        $editCostingManagement->created_at = Carbon::now();
        $editCostingManagement->updated_at = Carbon::now();
        $editCostingManagement->save();

        $permission_model = config('access.permission');
        $deleteCostingManagement = new $permission_model();
        $deleteCostingManagement->name = 'delete-costing-management';
        $deleteCostingManagement->display_name = 'Delete Costing Management';
        $deleteCostingManagement->created_at = Carbon::now();
        $deleteCostingManagement->updated_at = Carbon::now();
        $deleteCostingManagement->save();

        $permission_model = config('access.permission');
        $viewMaterialManagement = new $permission_model();
        $viewMaterialManagement->name = 'view-material-management';
        $viewMaterialManagement->display_name = 'View Material Management';
        $viewMaterialManagement->created_at = Carbon::now();
        $viewMaterialManagement->updated_at = Carbon::now();
        $viewMaterialManagement->save();

        $this->enableForeignKeys();
    }
}
