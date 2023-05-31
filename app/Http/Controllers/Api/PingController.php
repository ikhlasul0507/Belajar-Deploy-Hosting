<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Payload;

class PingController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        return $payload->toArrayPayload(true, config('message.result_get'), [], 200);
    }
}
