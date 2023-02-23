<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        //get User
        $User =  UserAccount::latest()->paginate(5);
        //return collection of User as a resource
        return new UserAccountResource(true, 'List Data User Account', $User);
    }
}
