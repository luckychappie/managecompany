<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Employee;
use App\Company;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $total_employee = Employee::count();
            $total_company = Company::count();
            view()->share('total_employee',$total_employee);
            view()->share('total_company',$total_company);
           

            return $next($request);
       });
    }
}
