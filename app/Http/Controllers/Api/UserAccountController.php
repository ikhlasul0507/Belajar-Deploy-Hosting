<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Http\Resources\Payload;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserAccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index()
    {
        $payload = new Payload();
        $users = new UserAccount;
        $result =  UserAccount::select($users->showField()['fieldTable'])->latest()->paginate(10);
        return $payload->toArrayPayload(false, config('message.result_get'), $result, 200);
    }
    public function show(UserAccount $userAccount)
    {
        $payload = new Payload();
        return $payload->toArrayPayload(false, config('message.result_get'), $userAccount, 200);
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'visitor'   => 'required',
            'created_by'   => 'required',
            'updated_by'   => 'required',
            'deleted_by'   => 'required',
            'deleted'   => 'required',
        ]);

        if ($validator->fails()) {
            return $payload->toArrayPayload(false, $validator->errors(), "", 422);
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
        return $payload->toArrayPayload(false, config('message.result_post'), $post, 200);
    }
}
