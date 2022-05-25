<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeesExport implements FromView
{
    
    public function view(): View
    {
        $input = request()->all();
        $employees = Employee::with(['company:id,name'])
        ->join('companies', 'companies.id', '=', 'employees.companies_id')
        ->when($input['keyword'] ?? '', function($q, $keyword){
                $q->where('first_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('last_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('department' ,'like' , '%'.$keyword.'%')
                ->orWhere('staff_id' ,'like' , '%'.$keyword.'%')
                ->orWhere('companies.name' ,'like' , '%'.$keyword.'%');
            })
        ->when($input['companies_id'] ?? '', function($q, $companies_id){
                $q->where('companies_id' ,$companies_id);
            })
        ->select('employees.id', 'companies_id','first_name','last_name', 'companies_id', 'department', 'employees.email','phone_number', 'employees.address','staff_id','employees.created_at')->get();

        return view('employee.export', [
            'employees' => $employees
        ]);
    }

    // public function collection()
    // {

    //     $input = request()->all();
    //     $employees = Employee::with(['company:id,name'])
    //     ->join('companies', 'companies.id', '=', 'employees.companies_id')
    //     ->when($input['keyword'] ?? '', function($q, $keyword){
    //             $q->where('first_name' ,'like' , '%'.$keyword.'%')
    //             ->orWhere('last_name' ,'like' , '%'.$keyword.'%')
    //             ->orWhere('department' ,'like' , '%'.$keyword.'%')
    //             ->orWhere('staff_id' ,'like' , '%'.$keyword.'%')
    //             ->orWhere('companies.name' ,'like' , '%'.$keyword.'%');
    //         })
    //     ->when($input['companies_id'] ?? '', function($q, $companies_id){
    //             $q->where('companies_id' ,$companies_id);
    //         })
    //     ->select('employees.id', 'companies_id','first_name','last_name', 'companies_id', 'department', 'employees.email','phone_number', 'employees.address','staff_id','employees.created_at')->get();
            
    //     return $employees;
    // }

   
}
