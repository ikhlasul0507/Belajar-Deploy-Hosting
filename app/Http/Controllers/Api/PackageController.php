<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payload;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $packages = new Package;
        return $payload->toArrayPayload(true, config('message.result_get'), $packages->doGetlistPackage($request), 200, ($request->deleted ? $packages->doCountListTrash() : ($request->filter !== null ?  $packages->doCountSearchPackage($request):$packages->doCountPackage())));
    }
    public function show($id)
    {
        $payload = new Payload();
        $packages = new Package;
        if ($packages->doCountPackage($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }

        return $payload->toArrayPayload(true, config('message.result_get'), $packages->doViewPackage($id), 200, $packages->doCountPackage($id));
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $packages = new Package;
        if ($packages->validatePackage($request)->fails()) {
            return $payload->toArrayPayload(false,$packages->validatePackage($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_post'), $packages->doInsertPackage($request), 201);
    }

    public function update(Request $request, $id)
    {
        $payload = new Payload();
        $packages = new Package;
        if ($packages->doCountPackage($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }
        if ($packages->validatePackage($request)->fails()) {
            return $payload->toArrayPayload(false,$packages->validatePackage($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_put'), $packages->doUpdatePackage($request, $id), 200);
    }
    public function destroy($id)
    {
        $payload = new Payload();
        $packages = new Package;
        if ($packages->doCountPackage($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }
        return $payload->toArrayPayload(true, config('message.result_delete'), $packages->doDeletePackage($id), 200, $packages->doCountPackage($id));
    }
}
