<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BranchRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'        =>  'required',
          'address'     =>  'required',
          'description' =>  'required',
          'phone'       =>  'required',
          'hotline'     =>  'required',
          'maps'        =>  'required',
        ];
    }

    public function messages()
    {
        return [
          'name.required'         =>  'Fill This Field',
          'address.required'      =>  'Fill This Field',
          'description.required'  =>  'Fill This Field',
          'phone.required'        =>  'Fill This Field',
          'hotline.required'      =>  'Fill This Field',
          'maps.required'         =>  'Fill This Field',
        ];
    }
}
