<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use App\Repository\AccountPaymentRepository;
use Illuminate\Support\Facades\Storage;

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
        return ['id','user_id','visitor','name','jenis','optional_description','account_number','detail_photo'];
    }

    private function fieldTableView()
    {
        return ['id','uuid','user_id','visitor','title','description','optional_description','details','amount','created_at','updated_at'];
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
            'content'   => 'required',
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
        $AccountPayments = new AccountPaymentRepository();
        
        return "RER";
        if ($request->filter !== null && $request->deleted === false) {
            return $this->formatOUTList($AccountPayments->listSearchAccountPayment($request));
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList($AccountPayments->listAccountPayment($request));
        }else {
            return  $AccountPayments->listDeleteAccountPayment();
        }
    }

    public function doInsertAccountPayment ($request)
    {
        $AccountPayments = new AccountPaymentRepository();
        $image = $request->file(config('constanta.photo_field_body'));
        $filename = $image->hashName();
        $image->storeAs(config('constanta.path_account'), $filename);
        return $AccountPayments->insertDataAccountPayment($this->fieldTableInsertOrUpdate(), json_decode($request->content), $filename);
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->user_id,
                $getField[2] => $value->visitor,
                $getField[3] => $value->name,
                $getField[4] => $value->jenis,
                $getField[5] => $value->optional_description,
                $getField[6] => $value->account_number,
                $getField[7] => $value->detail_photo
            ]);
        }
        return $value_result;
    }
}
