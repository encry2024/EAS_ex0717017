<?php

namespace App\Models\Management\Costing\Project\Traits\Attribute;

/**
* Class ProjectAttribute.
*/
trait ProjectAttribute
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
      return '<a href="'.route('admin.management.costing.project.project_item.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.crudu.view').'"></i></a> ';
   }

   /**
   * @return string
   */
   public function getEditButtonAttribute()
   {
      return '<a href="'.route('admin.management.costing.project.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.crudu.edit').'"></i></a> ';
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
         return '<a href="'.route('admin.management.costing.project.destroy', $this).'"
         data-method="delete"
         data-trans-button-cancel="'.trans('buttons.general.cancel').'"
         data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
         data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
         class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.crudu.delete').'"></i></a> ';
      }

      return '';
   }

   /**
   * @return string
   */
   public function getRestoreButtonAttribute()
   {
      return '<a href="'.route('admin.management.costing.project.restore', $this).'" name="restore_project" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.management.costing.restore_project').'"></i></a> ';
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

      if (access()->user()->hasRoles([1,2])) {
         return
         $this->show_button.
         $this->edit_button.
         $this->delete_button;
      } else if(access()->user()->hasRoles([3,5,6])) {
         return $this->show_button;
      }
   }
}
