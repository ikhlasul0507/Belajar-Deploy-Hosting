<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Payload;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $payload = new Payload();
        $users = new User();
        //set validation
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8|confirmed'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return $payload->toArrayPayload(false, $validator->errors(), null, 422);
        }
        //return response JSON user is created
        $user = $users->doInsertUserAccount($request);
        if($user > 0) {
            return $payload->toArrayPayload(true,  config('message.result_post'),$user, 201);
        }

        //return JSON process insert failed 
        return $payload->toArrayPayload(false, $user, null, 409);
    }
}