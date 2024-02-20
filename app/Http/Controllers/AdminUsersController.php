<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Redirect;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   
    

    /**
     * Display the specified resource.
     */
    public function show(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminUsers $adminUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminUsers $adminUsers)
    {
        //
    }

    public function store(Request $request)
    {
        
        $checkUser = AdminUsers::where('email', $request->email)->first();
        if ($checkUser) {
            return redirect()->back()->with('message', 'Your account already exists');
        }

        $adminUser = new AdminUsers;
        $adminUser->name = $request->name;
        $adminUser->email = $request->email;
        $adminUser->user_role = $request->userrole;
        $adminUser->password = Hash::make($request->password);

        $status = $adminUser->save();
        $request->session()->put('sessionAdmin', $request->password);
        if ($status) {
            return redirect('/admin-login')->with('message', 'Your account has been registered  successfully');
        }
        return redirect()->back()->with('message', 'Failed to create a account');

    }
    public function login(Request $request)
    {
      

        $email = $request->email;
        $password = $request->password;
        $admin = DB::table('admin_users')
            ->where('email', $email)
            ->get();

        if (!empty($admin[0])) {
            if (Hash::check($password, $admin[0]->password)) {
                $request->session()->put('sessionAdmin', $admin[0]->password);
                $request->session()->save();
                return redirect('/admin-dashboard');
            } else {
                return Redirect::back()->withErrors(['password' => 'Sorry ! Your input password is wrong.']);
            }
        } else {
            return Redirect::back()->withErrors(['email' => 'Sorry ! Your input email is wrong or your service status is not correct.']);
        }
    }
}