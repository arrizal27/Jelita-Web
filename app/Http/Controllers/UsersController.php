<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(){
		$this->middleware('Checklogin');
	}

	public function index(){
		return view('users');
	}
}
