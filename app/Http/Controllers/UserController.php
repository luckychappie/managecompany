<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }



    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        //
    }

  


    public function show(User $user)
    {
        //
    }

   


    public function edit(User $user)
    {
        //
    }

   


    public function update(Request $request, User $user)
    {
        //
    }

   


    public function destroy(User $user)
    {
        //
    }
}
