<?php

namespace App\Http\Requests\Backend\Management\Costing\Project;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UploadProjectRequest extends Request
{
   /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
   public function authorize()
   {
      return access()->hasRoles([1,2]);
   }

   /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
   public function rules()
   {
      return [
         'name' => 'required',
         'user_id' => 'required',
         'subject' => ['required'],
         'project_date' => 'required',
         'location' => 'required',
         'project_file' => 'required'
      ];
   }
}
