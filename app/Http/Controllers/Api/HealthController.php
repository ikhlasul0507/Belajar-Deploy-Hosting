<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Payload;

class HealthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $result = [];
        for ($i = 0; $i < count($request->data); $i++) {
            array_push($result, $this->getStatusResponse($request->data[$i]));
        }
        return $payload->toArrayPayload(true, config('message.result_get'), $result, 200, count($request->data));
    }

    private function getStatusResponse($request)
    {
        $ip =  $request['url'];
        $url = $ip;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $speeddownload = curl_getinfo($ch, CURLINFO_SPEED_DOWNLOAD_T);
        curl_close($ch);
        if ($health) {
            $codeRespon = 200;
            $msg =  config('message.result_get');
            $data = ['health' => $health, 'status' => true, 'speed_downloaded' => $speeddownload];
        } else {
            $codeRespon = 404;
            $msg =  config('message.result_data_found');
            $data = ['health' => $health, 'status' => false];
        }
        $json = [
            'url' =>  $url,
            'code' => $codeRespon,
            'message' => $msg,
            'data' => $data
        ];

        return $json;
    }
}
