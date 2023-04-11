<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payload;
use App\Models\Menu_parent;
use Illuminate\Http\Request;

class MenuParentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $MenuParents = new Menu_parent;
        return $payload->toArrayPayload(true, config('message.result_get'), $MenuParents->doGetlistMenuParent($request), 200, ($request->deleted ? $MenuParents->doCountListTrash() : ($request->filter !== null ?  $MenuParents->doCountSearchMenuParent($request):$MenuParents->doCountMenuParent())));
    }
    public function show($id)
    {
        $payload = new Payload();
        $MenuParents = new Menu_parent;
        if ($MenuParents->doCountMenuParent($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_MenuParent'), null, 404);
        }

        return $payload->toArrayPayload(true, config('message.result_get'), $MenuParents->doViewMenuParent($id), 200, $MenuParents->doCountMenuParent($id));
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $MenuParents = new Menu_parent;
        if ($MenuParents->validateMenuParent($request)->fails()) {
            return $payload->toArrayPayload(false,$MenuParents->validateMenuParent($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_post'), $MenuParents->doInsertMenuParent($request), 201);
    }

    public function update(Request $request, $id)
    {
        $payload = new Payload();
        $MenuParents = new Menu_parent;
        if ($MenuParents->doCountMenuParent($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_MenuParent'), null, 404);
        }
        if ($MenuParents->validateMenuParent($request)->fails()) {
            return $payload->toArrayPayload(false,$MenuParents->validateMenuParent($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_put'), $MenuParents->doUpdateMenuParent($request, $id), 200);
    }
    public function destroy($id)
    {
        $payload = new Payload();
        $MenuParents = new Menu_parent;
        if ($MenuParents->doCountMenuParent($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_MenuParent'), null, 404);
        }
        return $payload->toArrayPayload(true, config('message.result_delete'), $MenuParents->doDeleteMenuParent($id), 200, $MenuParents->doCountMenuParent($id));
    }
}
