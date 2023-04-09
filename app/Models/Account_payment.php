<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use App\Repository\AccountPaymentRepository;


class Account_payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /*
    |--------------------------------------------------------------------------
    | Initiate Field Insert Or Update
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['uuid','user_id','visitor','name','jenis','optional_description','account_number','detail_photo'];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */

    private function fieldTableList()
    {
        return ['id','name','jenis','optional_description','account_number','detail_photo'];
    }

    private function fieldTableView()
    {
        return ['id','uuid','user_id','visitor','name','jenis','optional_description','account_number','detail_photo','created_at','updated_at'];
    }

    private function fieldTableInsertOrUpdate()
    {
        return ['uuid','user_id','visitor','name','jenis','optional_description','account_number','detail_photo'];
    }

    /*
    |--------------------------------------------------------------------------
    | Validate 
    |--------------------------------------------------------------------------
    */
    

    private function fieldValidate()
    {
        return [
            'photo'     => config('constanta.validate_photo'),
            'content'   => config('constanta.validate_content'),
        ];
    }

    public function validateAccountPayment($request)
    {
        return Validator::make($request->all(),$this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistAccountPayment ($request)
    {
        $accountPayments = new AccountPaymentRepository();
    
        if ($request->filter !== null && $request->deleted === false) {
            return $this->formatOUTList($accountPayments->listSearchAccountPayment($request));
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList($accountPayments->listAccountPayment($request));
        }else {
            return  $accountPayments->listDeleteAccountPayment();
        }
    }

    public function doInsertAccountPayment ($request)
    {
        $accountPayments = new AccountPaymentRepository();
        $image = $request->file(config('constanta.photo_field_body'));
        $filename = $image->hashName();
        $image->storeAs(config('constanta.path_account'), $filename);
        return $accountPayments->insertDataAccountPayment($this->fieldTableInsertOrUpdate(), json_decode($request->content), $filename)->id;
    }

    public function doUpdateAccountPayment ($request, $id)
    {
        $accountPayments = new AccountPaymentRepository();
        $image = $request->file(config('constanta.photo_field_body'));
        $filename = $image->hashName();
        $image->storeAs(config('constanta.path_account'), $filename);
        return $accountPayments->updateDataAccountPayment($this->fieldTableInsertOrUpdate(), $request, $filename, $id);
    }

    public function doViewAccountPayment($id)
    {
        $accountPayments = new AccountPaymentRepository();
        return $this->formatOUTView($accountPayments->viewDetailAccountPayment($id));
    }

    public function doDeleteAccountPayment($id)
    {
        $accountPayments = new AccountPaymentRepository();
        return $accountPayments->deleteAccountPayment($id);
    }

    public function doCountAccountPayment($id = 0)
    {
        $accountPayments = new AccountPaymentRepository();
        return $accountPayments->countAccountPayment($id);
    }

    public function doCountSearchAccountPayment($request)
    {
        $accountPayments = new AccountPaymentRepository();
        return $accountPayments->countSearchAccountPayment($request);
    }

    public function doCountListTrash()
    {
        $accountPayments = new AccountPaymentRepository();
        return $accountPayments->countListTrash();
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->name,
                $getField[2] => $value->jenis,
                $getField[3] => $value->optional_description,
                $getField[4] => $value->account_number,
                $getField[5] => json_decode($value->detail_photo)
            ]);
        }
        return $value_result;
    }

    public function formatOUTView($result)
    {
        $getField = $this->fieldTableView();
        return [
            $getField[0] => $result->id,
            $getField[1] => $result->uuid,
            $getField[2] => $result->user_id,
            $getField[3] => $result->visitor,
            $getField[4] => $result->name,
            $getField[5] => $result->jenis,
            $getField[6] => $result->optional_description,
            $getField[7] => $result->account_number,
            $getField[8] => json_decode($result->detail_photo),
            $getField[9] => $result->created_at,
            $getField[10] => $result->updated_at
        ];
    }
}
