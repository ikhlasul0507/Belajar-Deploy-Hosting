<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\Payload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAccount;
use App\Models\Menu_parent;

class LoginController extends Controller
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
        $users = new UserAccount;
        $menu = new Menu_parent();
        //set validation
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return $payload->toArrayPayload(false, $validator->errors(), "", 422);
        }

        //get credentials from request
        $credentials = $request->only('email', 'password');

        //if auth failed
        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return $payload->toArrayPayload(false, config('message.password_wrong'), "", 401);
        }

        //if auth success
        $result_user = auth()->guard('api')->user();
        $detail =  $users->doViewUserAccount($result_user->id);
        $post = [
            'user'    => $result_user,  
            'detail' =>$detail,  
            'list_access_menu' => $menu->doViewMenuParent($detail['list_access_menu']),
            'token'   => $token,   
            'exp' => config('jwt.ttl')
        ];
        return $payload->toArrayPayload(true, config('message.login_success'), $post, 200);
    }
}