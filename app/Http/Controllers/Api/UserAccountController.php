<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Models\UserAccount;
use Illuminate\Http\Request;
class UserAccountController extends Controller
{
    //controller
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    
    public function index()
    {
        $User =  UserAccount::latest()->paginate(10);
        return new UserAccountResource(true, 'List Data User Account', $User);
    }
    public function show(UserAccount $userAccount)
    {
        return new UserAccountResource(true, 'Data User Account Ditemukan!', $userAccount);
    }
}
