<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payload;
use App\Models\Account_payment;
use Illuminate\Http\Request;

class AccountPaymentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $payload = new Payload();
        $accountPayments = new Account_payment;
        return $payload->toArrayPayload(true, config('message.result_get'), $accountPayments->doGetlistAccountPayment($request), 200, ($request->deleted ? $accountPayments->doCountListTrash() : ($request->filter !== null ?  $accountPayments->doCountSearchAccountPayment($request):$accountPayments->doCountAccountPayment())));
    }
    public function show($id)
    {
        $payload = new Payload();
        $accountPayments = new Account_payment;
        if ($accountPayments->doCountAccountPayment($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_payment'), null, 404);
        }

        return $payload->toArrayPayload(true, config('message.result_get'), $accountPayments->doViewAccountPayment($id), 200, $accountPayments->doCountAccountPayment($id));
    }

    public function store(Request $request)
    {
        $payload = new Payload();
        $accountPayments = new Account_payment;
        if ($accountPayments->validateAccountPayment($request)->fails()) {
            return $payload->toArrayPayload(false,$accountPayments->validateAccountPayment($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_post'), $accountPayments->doInsertAccountPayment($request), 201);
    }

    public function update(Request $request, $id)
    {
        $payload = new Payload();
        $accountPayments = new Account_payment;
        if ($accountPayments->doCountAccountPayment($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_payment'), null, 404);
        }
        if ($accountPayments->validateAccountPayment($request)->fails()) {
            return $payload->toArrayPayload(false,$accountPayments->validateAccountPayment($request)->errors(), "", 422);
        }
        return $payload->toArrayPayload(true, config('message.result_put'), $accountPayments->doUpdateAccountPayment($request, $id), 200);
    }
    public function destroy($id)
    {
        $payload = new Payload();
        $accountPayments = new Account_payment;
        if ($accountPayments->doCountAccountPayment($id) == 0){
            return $payload->toArrayPayload(false, config('message.result_data_found_payment'), null, 404);
        }
        return $payload->toArrayPayload(true, config('message.result_delete'), $accountPayments->doDeleteAccountPayment($id), 200, $accountPayments->doCountAccountPayment($id));
    }
}
