<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function index(){
        $data = ['isAdmin' => false, 'isPasswordReset' =>false];
        return view('appPage', $data);
    }
    public function index_admin(){
        $data = ['isAdmin' => true, 'isPasswordReset'=>false];
        return view('appPage', $data);
    }
    public function index_passwordReset(Request $request){
        $token = $request->query('token');
        $email = $request->query('email');
        dump($token);
        dump($email);
        $data = ['isAdmin' => true, 'isPasswordReset'=>true ];
        return view('appPage', $data);
    }
}
