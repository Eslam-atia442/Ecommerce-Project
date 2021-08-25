<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adminloginrequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login (){

       return view('dashboard.authenticate.login');
}


    public function postlogin (Adminloginrequest $request ){

        $remember_me=$request->has('remember_me') ? true : false ;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"),'password'=>$request->input("password")] ,  $remember_me))
        {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error'=> 'هناك خطاء بالبيانات' ]);

    }
    public function logout (){
       $gaurd = $this->getGuard();
        $gaurd -> logout();
        return redirect(route('home'));
    }

    private function getGuard()
    {
        return auth('admin');
    }


}

