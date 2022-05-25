<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

   

    public function rules()
    {
        return [
            'first_name'=>'required',
            'last_name' => 'required',
            'companies_id' =>'required',
            'staff_id' =>'unique:employees'
        ];
    }
}
