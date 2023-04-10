<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\PackageBuyingHistoryRepository;

class Package_buying_history extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /*
    |--------------------------------------------------------------------------
    | Initiate Field Insert Or Update
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['uuid','user_id','package_id','account_payment_id','visitor','net_amount','status'];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */

    private function fieldTableList()
    {
        return ['id','title','name','account_number','status','created_at'];
    }

    private function fieldTableView()
    {
        return ['id','uuid','user_id','package_id','account_payment_id','visitor','net_amount','status','created_at','updated_at'];
    }

    private function fieldTableInsertOrUpdate()
    {
        return ['uuid','user_id','package_id','account_payment_id','visitor','net_amount','status'];
    }

    /*
    |--------------------------------------------------------------------------
    | Validate
    |--------------------------------------------------------------------------
    */
    

    private function fieldValidate()
    {
        return [
            'net_amount'   => config('constanta.validate_amount'),
            'user_id'   => config('constanta.validate_id'),
            'account_payment_id'   => config('constanta.validate_id'),
        ];
    }

    public function validatePackageBuyingHistory($request)
    {
        return Validator::make($request->all(),$this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistPackageBuyingHistory ($request)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        if ($request->filter !== null && $request->deleted === false) {
            return $this->formatOUTList($packageBuyingHistorys->listSearchPackageBuyingHistory($request));
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList($packageBuyingHistorys->listPackageBuyingHistory($request));
        }else {
            return  $packageBuyingHistorys->listDeletePackageBuyingHistory();
        }
    }

    public function doInsertPackageBuyingHistory ($request)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        $packageBuyingHistorys->insertDataPackageBuyingHistory($this->fieldTableInsertOrUpdate(), $request)->id;
        return true;
    }
    
    public function doUpdatePackageBuyingHistory ($request, $id)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        $packageBuyingHistorys->updateDataPackageBuyingHistory($this->fieldTableInsertOrUpdate(), $request, $id);
        return true;
    }

    public function doViewPackageBuyingHistory($id)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        return $this->formatOUTView($packageBuyingHistorys->viewDetailPackageBuyingHistory($id));
    }

    public function doDeletePackageBuyingHistory($id)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        return $packageBuyingHistorys->deletePackageBuyingHistory($id);
    }

    public function doCountPackageBuyingHistory($id = 0)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        return $packageBuyingHistorys->countPackageBuyingHistory($id);
    }

    public function doCountSearchPackageBuyingHistory($request)
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        return $packageBuyingHistorys->countSearchPackageBuyingHistory($request);
    }

    public function doCountListTrash()
    {
        $packageBuyingHistorys = new PackageBuyingHistoryRepository();
        return $packageBuyingHistorys->countListTrashBuyingHistory();
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->title,
                $getField[2] => $value->name,
                $getField[3] => $value->account_number,
                $getField[4] => $value->status,
                $getField[5] => $value->created_at,
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
            $getField[4] => $result->title,
            $getField[5] => $result->description,
            $getField[6] => $result->optional_description,
            $getField[8] => $result->amount,
            $getField[9] => $result->created_at,
            $getField[10] => $result->updated_at
        ];
    }

}
