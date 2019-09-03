<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

class InfoAdmin extends Controller
{
    private $user;

    public function __construct(User $user)
    {
       $this->user = $user;
    }
    public function index()
    {
    	return view('admin');
    }
    public function edit(Request $request)
    {
    	return $this->user->editUser($request);
    }
}
