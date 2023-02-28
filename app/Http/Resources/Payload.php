<?php
namespace App\Http\Resources;
use Illuminate\Support\Str;

class Payload
{ 
    public function toArrayPayload($status, $message, $resource, $kode)
    {
        return response()->json([
                config('global.name') => [
                    'header' =>[
                    'request_id' => Str::uuid(),
                    'version'   => config('global.version'),
                    'status'   => $status,
                    'timestamp' => config('global.date_now'),
                    ],
                    'payload' => [
                        'status'=>
                            [
                                'success' => $status,
                                'message'   => $message,
                                'detail' => null
                            ]
                    ],
                    'data' => [
                        'meta' => null,
                        'content' => $resource
                        ]
                ]
                    ],$kode);
    }

    public function toArrayFailed($request, $status, $message, $resource , $kode)
    {
        return response()->json([
            config('global.name') => [
                'header' =>[
                'request_id' => Str::uuid(),
                'version'   => config('global.version'),
                'server_address'   => $request->ip(),
                'status'   => false,
                'timestamp' => config('global.date_now'),
                ],
                'payload' => [
                    'status'=>
                        [
                            'success' => false,
                            'message'   => $message,
                            'detail' => null
                        ]
                ],
                'data' => [
                    'meta' => null,
                    'content' => null
                    ]
            ]
    ], $kode);
    }
}