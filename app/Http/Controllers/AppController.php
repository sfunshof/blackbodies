<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    //
	public function index(){
        $data = ['isAdmin' => false];
        return view('appPage', $data);
    }
    public function index_admin(){
        $data = ['isAdmin' => true];
        return view('appPage', $data);
    }

}
