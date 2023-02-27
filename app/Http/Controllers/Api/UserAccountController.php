<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class UserAccountController extends Controller
{
    //controller
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
    
    public function index()
    {
        // $User =  UserAccount::latest()->paginate(10);
        $users = new UserAccount;
        $result =  UserAccount::select($users->showField())->latest()->paginate(10);
        return new UserAccountResource(true, 'List Data User Account', $result);
    }
    public function show(UserAccount $userAccount)
    {
        return new UserAccountResource(true, 'Data User Account Ditemukan!', $userAccount);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'visitor'   => 'required',
            'created_by'   => 'required',
            'updated_by'   => 'required',
            'deleted_by'   => 'required',
            'deleted'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = UserAccount::create([
            'uuid'     => Str::uuid(),
            'name'   => $request->name,
            'visitor'   => $request->visitor,
            'created_by'   => $request->created_by,
            'updated_by'   => $request->updated_by,
            'deleted_by'   => $request->deleted_by,
            'deleted'   => $request->deleted,
        ]);

        return new UserAccountResource(true, 'Data User Account Berhasil Ditambahkan!', $post);
    }
}
