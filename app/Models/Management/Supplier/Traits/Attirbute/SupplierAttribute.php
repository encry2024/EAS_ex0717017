<?php

namespace App\Models\Management\Supplier\Traits\Attribute;

/**
* Class SupplierAttribute.
*/
trait SupplierAttribute
{
   /**
   * @return string
   */
   public function getAddStockButtonAttribute()
   {
      return '<a class="btn btn-xs btn-success"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.item.adu.add').'"></i></a> ';
   }

   /**
   * @return string
   */
   // public function getEditButtonAttribute()
   // {
   //    return '<a class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.item.adu.edit').'"></i></a> ';
   // }

   /**
   * @return string
   */
   // public function getDeleteButtonAttribute()
   // {
   //    if (access()->id() == 1) {
   //       return '<a href="'.route('admin.management.costing.project.destroy', $this).'"
   //       data-method="delete"
   //       data-trans-button-cancel="'.trans('buttons.general.cancel').'"
   //       data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
   //       data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
   //       class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.item.adu.delete').'"></i></a> ';
   //    }
   //
   //    return '';
   // }

   /**
   * @return string
   */
   // public function getRestoreButtonAttribute()
   // {
   //    return '<a href="'.route('admin.management.costing.project.restore', $this).'" name="restore_project" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.restore_project').'"></i></a> ';
   // }

   // /**
   // * @return string
   // */
   // public function getDeletePermanentlyButtonAttribute()
   // {
   //    return '<a href="'.route('admin.access.user.delete-permanently', $this).'" name="delete_user_perm" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.delete_permanently').'"></i></a> ';
   // }

   /**
   * @return string
   */
   public function getActionButtonsAttribute()
   {
      if ($this->trashed()) {
         return $this->restore_button.$this->delete_permanently_button;
      }

      if (access()->user()->hasRoles([1,2])) {
         return
         $this->add_stock_button;
      }
   }
}
