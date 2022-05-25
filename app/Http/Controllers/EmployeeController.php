<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
   
    public function index(Request $request)
    {
     
        $companies = Company::select('companies.id', 'companies.name')->get();
        $employees = Employee::with(['company:id,name'])
        ->join('companies', 'companies.id', '=', 'employees.companies_id')
        ->when($request->get('keyword') ?? '', function($q, $keyword){
                $q->where('first_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('last_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('department' ,'like' , '%'.$keyword.'%')
                ->orWhere('staff_id' ,'like' , '%'.$keyword.'%')
                ->orWhere('companies.name' ,'like' , '%'.$keyword.'%');
            })
        ->when($request->get('companies_id') ?? '', function($q, $companies_id){
                $q->where('companies_id' ,$companies_id);
            })
        ->select('employees.id', 'companies_id','first_name','last_name', 'companies_id', 'department', 'employees.email','phone_number', 'employees.address','staff_id')->paginate(10);
        return view('employee.index', compact('employees', 'companies'));
    }

    public function export(Request $request) 
    {   
        $companies = Company::select('companies.id', 'companies.name')->get();
        $employees = Employee::with(['company:id,name'])
        ->join('companies', 'companies.id', '=', 'employees.companies_id')
        ->when($request->get('keyword') ?? '', function($q, $keyword){
                $q->where('first_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('last_name' ,'like' , '%'.$keyword.'%')
                ->orWhere('department' ,'like' , '%'.$keyword.'%')
                ->orWhere('staff_id' ,'like' , '%'.$keyword.'%')
                ->orWhere('companies.name' ,'like' , '%'.$keyword.'%');
            })
        ->when($request->get('companies_id') ?? '', function($q, $companies_id){
                $q->where('companies_id' ,$companies_id);
            })
        ->select('employees.id', 'companies_id','first_name','last_name', 'companies_id', 'department', 'employees.email','phone_number', 'employees.address','staff_id')->get()->toArray();
        return Excel::download(new EmployeesExport, 'employees.csv');
    }


    public function create()
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $companies = Company::select('companies.id', 'companies.name')->get();
        return view('employee.create', compact('companies'));
    }

    

    public function store(EmployeeRequest $request)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $employee = Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Adding new employee success.');
    }

  

    public function show(Employee $employee)
    {
        //
    }

    

    public function edit(Employee $employee)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $companies = Company::select('companies.id', 'companies.name')->get();
        return view('employee.edit', compact('employee', 'companies'));
    }


    public function update(Request $request, Employee $employee)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $employee->update($request->all());
        return redirect()->route('employees.index')->with('success', 'Updating employee success.');
    }

  

    public function destroy(Employee $employee)
    {
        
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        if ($employee->delete()) {
            
            return back()->with('success', 'Deleting Employee Success');
        }
        return back()->with('error', 'Deleting Employee Fail');
    }
}
