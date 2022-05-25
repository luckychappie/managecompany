<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Auth;
use DB;

class CompanyController extends Controller
{
   
    public function index()
    {
        $companies = Company::select('companies.id', 'companies.name','email','address')->paginate(10);
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        //
    }

  
    public function store(CompanyRequest $request)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $comapny = Company::create($request->all());
        return back()->with('success', 'Adding new company success.');
    }

  
    public function show(Company $company)
    {
        //
    }

   
    public function edit(Company $company)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
         return view('company.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        $company->update($request->all());
        return redirect()->route('companies.index')->with('success', 'Updating company success.');
    }

   
    public function destroy(Company $company)
    {
        if (Auth::user()->role != 1) {
            return back()->with('error', 'You have no permission to access.');
        }
        if ($company->employees->isNotEmpty()) {
            return redirect('admin/companies')->with('warning', 'Cannot Delete Category "'.$company->name.'". Please first delete employees for this company.');
        }
        
        if ($company->delete()) {
            
            return back()->with('success', 'Company Delete Success');
        }
        return back()->with('error', 'Company Delete Fail');
    }
}
