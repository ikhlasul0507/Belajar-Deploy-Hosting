<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payload;
use App\Models\Package_buying_history;
use Illuminate\Http\Request;
use App\Models\Account_payment;
use App\Models\Package;
use App\Models\UserAccount;

class PackageBuyingHistoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $PackageBuyingHistorys = new Package_buying_history;
        return $payload->toArrayPayload(true, config('message.result_get'), $PackageBuyingHistorys->doGetlistPackageBuyingHistory($request), 200, ($request->deleted ? $PackageBuyingHistorys->doCountListTrash() : ($request->filter !== null ?  $PackageBuyingHistorys->doCountSearchPackageBuyingHistory($request):$PackageBuyingHistorys->doCountPackageBuyingHistory())));
    }
    public function show($id)
    {
        $payload = new Payload();
        $PackageBuyingHistorys = new Package_buying_history;
        if ($PackageBuyingHistorys->doCountPackageBuyingHistory($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }

        return $payload->toArrayPayload(true, config('message.result_get'), $PackageBuyingHistorys->doViewPackageBuyingHistory($id), 200, $PackageBuyingHistorys->doCountPackageBuyingHistory($id));
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $PackageBuyingHistorys = new Package_buying_history;
        $accountPayments = new Account_payment;
        $packages = new Package;
        $users = new UserAccount;
        if ($users->doCountUserAccount($request->user_id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_user'), null, 404);
        }
        if ($packages->doCountPackage($request->package_id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_package'), null, 404);
        }
        if ($accountPayments->doCountAccountPayment($request->account_payment_id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_payment'), null, 404);
        }
        if ($PackageBuyingHistorys->validatePackageBuyingHistory($request)->fails()) {
            return $payload->toArrayPayload(false,$PackageBuyingHistorys->validatePackageBuyingHistory($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_post'), $PackageBuyingHistorys->doInsertPackageBuyingHistory($request), 201);
    }

    public function update(Request $request, $id)
    {
        $payload = new Payload();
        $PackageBuyingHistorys = new Package_buying_history;
        if ($PackageBuyingHistorys->doCountPackageBuyingHistory($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }
        if ($PackageBuyingHistorys->validatePackageBuyingHistory($request)->fails()) {
            return $payload->toArrayPayload(false,$PackageBuyingHistorys->validatePackageBuyingHistory($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_put'), $PackageBuyingHistorys->doUpdatePackageBuyingHistory($request, $id), 200);
    }
    public function destroy($id)
    {
        $payload = new Payload();
        $PackageBuyingHistorys = new Package_buying_history;
        if ($PackageBuyingHistorys->doCountPackageBuyingHistory($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found'), null, 404);
        }
        return $payload->toArrayPayload(true, config('message.result_delete'), $PackageBuyingHistorys->doDeletePackageBuyingHistory($id), 200, $PackageBuyingHistorys->doCountPackageBuyingHistory($id));
    }
}
