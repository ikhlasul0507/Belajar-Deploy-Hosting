<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\PackageRepository;
use App\Models\Package_detail;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /*
    |--------------------------------------------------------------------------
    | Initiate Field Insert Or Update
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['uuid','user_id','menu_id','visitor','title','description','optional_description','amount'];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */

    private function fieldTableList()
    {
        return ['id','user_id','menu_id','title','description','optional_description','amount','details'];
    }

    private function fieldTableView()
    {
        return ['id','uuid','user_id','menu_id','visitor','title','description','optional_description','details','amount','created_at','updated_at'];
    }

    private function fieldTableInsertOrUpdate()
    {
        return ['uuid','user_id','menu_id','visitor','title','description','optional_description','amount'];
    }

    /*
    |--------------------------------------------------------------------------
    | Validate
    |--------------------------------------------------------------------------
    */
    

    private function fieldValidate()
    {
        return [
            'menu_id' => config('constanta.validate_id'),
            'title'   => config('constanta.validate_title'),
            'description'   => config('constanta.validate_description'),
            'amount'   => config('constanta.validate_amount'),
            'detail' => config('constanta.validate_detail'),
        ];
    }

    public function validatePackage($request)
    {
        return Validator::make($request->all(),$this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistPackage ($request)
    {
        $packages = new PackageRepository();
        if ($request->filter !== null && $request->deleted === false)  {
            return $this->formatOUTList($packages->listSearchPackage($request));
        }
        if ($request->deleted === false || $request->deleted === null) {
            return  $this->formatOUTList($packages->listPackage($request));
        }else {
            return  $packages->listDeletePackage();
        }
    }

    public function doInsertPackage ($request)
    {
        $packages = new PackageRepository();
        $packages_detail = new Package_detail();
        $idPackage = $packages->insertDataPackage($this->fieldTableInsertOrUpdate(), $request)->id;
        if ( $idPackage > 0)
        {
            for ($i = 0; $i < count($request->detail); $i++) {
                $packages_detail->doInsertPackageDetail($request->detail[$i], $idPackage);
            } 
        }
        return true;
    }
    
    public function doUpdatePackage ($request, $id)
    {
        $packages = new PackageRepository();
        $packages_detail = new Package_detail();
        if ( $id > 0)
        {
            if ($packages->updateDataPackage($this->fieldTableInsertOrUpdate(), $request, $id))
            {
                $packages_detail->doForceDeletePackageDetail($id);
                for ($i = 0; $i < count($request->detail); $i++) {
                    $packages_detail->doInsertPackageDetail($request->detail[$i], $id);
                } 
            }

        }
        return true;
    }

    public function doViewPackage($id)
    {
        $packages = new PackageRepository();
        return $this->formatOUTView($packages->viewDetailPackage($id));
    }

    public function doDeletePackage($id)
    {
        $packages = new PackageRepository();
        return $packages->deletePackage($id);
    }

    public function doCountPackage($id = 0)
    {
        $packages = new PackageRepository();
        return $packages->countPackage($id);
    }

    public function doCountSearchPackage($request)
    {
        $packages = new PackageRepository();
        return $packages->countSearchPackage($request);
    }

    public function doCountListTrash()
    {
        $packages = new PackageRepository();
        return $packages->countListTrash();
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $packages_detail = new Package_detail();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->user_id,
                $getField[2] => $value->menu_id,
                $getField[3] => $value->title,
                $getField[4] => $value->description,
                $getField[5] => $value->optional_description,
                $getField[6] => $value->amount,
                $getField[7] => $packages_detail->doGetlistPackageDetail($value->id)
            ]);
        }
        return $value_result;
    }
 
    public function formatOUTView($result)
    {
        $getField = $this->fieldTableView();
        $packages_detail = new Package_detail();
        return [
            $getField[0] => $result->id,
            $getField[1] => $result->uuid,
            $getField[2] => $result->user_id,
            $getField[3] => $result->menu_id,
            $getField[4] => $result->visitor,
            $getField[5] => $result->title,
            $getField[6] => $result->description,
            $getField[7] => $result->optional_description,
            $getField[8] => $packages_detail->doGetlistPackageDetail($result->id),
            $getField[9] => $result->amount,
            $getField[10] => $result->created_at,
            $getField[11] => $result->updated_at
        ];
    }

}
