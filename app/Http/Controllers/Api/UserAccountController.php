<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAccountResource;
use App\Http\Resources\Payload;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserAccountController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $users = new UserAccount;
        return $payload->toArrayPayload(true, config('message.result_get'), $users->doGetlistUserAccount($request), 200, ($request->deleted ? $users->doCountListTrash() : ($request->filter !== null ?  $users->doCountSearchUserAccount($request):$users->doCountUserAccount())));
    }
    public function show($id)
    {
        $payload = new Payload();
        $users = new UserAccount;
        if ($users->doCountUserAccount($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }

        return $payload->toArrayPayload(true, config('message.result_get'), $users->doViewUserAccount($id), 200, $users->doCountUserAccount($id));
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $users = new UserAccount;
        if ($users->validateUserAccount($request)->fails()) {
            return $payload->toArrayPayload(false,$users->validateUserAccount($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_post'), $users->doInsertUserAccount($request), 200);
    }
    public function destroy($id)
    {
        $payload = new Payload();
        $users = new UserAccount;
        if ($users->doCountUserAccount($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }
        return $payload->toArrayPayload(true, config('message.result_delete'), $users->doDeleteUserAccount($id), 200, $users->doCountUserAccount($id));
    }
}
