<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function myProfile(){
        return view('myprofile');
    }
    
    public function modMyProfile(){
        return view('modMyProfile');
    }

    public function twoFA(){
        return view('2fa-template');
    }
}
