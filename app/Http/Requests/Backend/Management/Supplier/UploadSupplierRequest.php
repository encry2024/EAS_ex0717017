<?php

namespace App\Http\Requests\Backend\Management\Supplier;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class UploadSupplierRequest extends Request
{
   /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
   public function authorize()
   {
      return access()->hasPermission('view-backend');
   }

   /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
   public function rules()
   {
      return [
         'supplier_file' => 'required'
      ];
   }
}
