<?php

namespace App\Models\Management\MaterialRequisition\Request\Request\Traits\Attribute;

/**
* Class RequestAttribute.
*/
trait RequestAttribute
{
   /**
   * @return string
   */
   public function getStatusLabelAttribute()
   {
      if ($this->isActive()) {
         return "<label class='label label-success'>".trans('labels.general.active').'</label>';
      }

      return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
   }

   /**
   * @return string
   */
   public function getShowButtonAttribute()
   {
      return '<a href="'.route('admin.management.material_requisition.request.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.material_requisition.request.request.view').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getEditButtonAttribute()
   {
      return '<a href="'.route('admin.management.material_requisition.request.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.material_requisition.request.request.edit').'"></i></a> ';
   }

   /**
   * @return string
   */
   // public function getStatusButtonAttribute()
   // {
   //    if ($this->id != access()->id()) {
   //       switch ($this->status) {
   //          case 0:
   //          return '<a href="'.route('admin.access.user.mark', [
   //             $this,
   //             1,
   //             ]).'" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.activate').'"></i></a> ';
   //             // No break
   //
   //             case 1:
   //             return '<a href="'.route('admin.access.user.mark', [
   //                $this,
   //                0,
   //                ]).'" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.deactivate').'"></i></a> ';
   //                // No break
   //
   //                default:
   //                return '';
   //                // No break
   //             }
   //          }
   //
   //          return '';
   //       }
   //
   //       /**
   //       * @return string
   //       */
   //       public function getConfirmedButtonAttribute()
   //       {
   //          if (! $this->isConfirmed() && ! config('access.users.requires_approval')) {
   //             return '<a href="'.route('admin.access.user.account.confirm.resend', $this).'" class="btn btn-xs btn-success"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title='.trans('buttons.backend.access.users.resend_email').'"></i></a> ';
   //          }
   //
   //          return '';
   //       }

   /**
   * @return string
   */
   public function getDeleteButtonAttribute()
   {
      if (access()->id() == 1) {
         return '<a href="'.route('admin.management.material_requisition.request.destroy', $this).'"
         data-method="delete"
         data-trans-button-cancel="'.trans('buttons.general.cancel').'"
         data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
         data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
         class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.material_requisition.request.request.crud.delete').'"></i></a> ';
      }

      return '';
   }

   /**
   * @return string
   */
   public function getRestoreButtonAttribute()
   {
      return '<a href="'.route('admin.management.material_requisition.request.restore', $this).'" name="restore_request" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.material_requisition.request.request.restore_request').'"></i></a> ';
   }

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


      return $this->show_button;
   }
}
