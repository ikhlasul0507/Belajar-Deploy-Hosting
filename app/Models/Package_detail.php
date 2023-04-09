<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\PackageDetailRepository;
use Illuminate\Support\Str;

class Package_detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /*
    |--------------------------------------------------------------------------
    | Initiate Field Insert Or Update
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['uuid','package_id','sequence','description'];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */

    private function fieldTableList()
    {
        return ['id','package_id','sequence','description'];
    }

    private function fieldTableView()
    {
        return ['id','uuid','package_id','visitor','title','description','optional_description','amount','created_at','updated_at'];
    }

    public function fieldTableInsertOrUpdate()
    {
        return ['uuid','package_id','sequence','description'];
    }

     /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */

    public function doInsertPackageDetail ($detail, $id)
    {
        $packages_detail = new PackageDetailRepository();
        return $packages_detail->insertDataPackageDetail($this->fieldTableInsertOrUpdate(), $detail, $id);
    }

    public function doGetlistPackageDetail ($id)
    {
        $packages_detail = new PackageDetailRepository();
        if ($id > 0)  {
            return $this->formatOUTList($packages_detail->listSearchPackageDetail($id));
        } 
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->package_id,
                $getField[2] => $value->sequence,
                $getField[3] => $value->description
            ]);
        }
        return $value_result;
    }

    public function doForceDeletePackageDetail($id)
    {
        $packages_detail = new PackageDetailRepository();
        return $packages_detail->forceDeletePackageDetail($id);
    }

}
