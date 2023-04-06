<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'uuid',
        'name',
        'visitor',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted',
    ];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */
	private function showField()
	{
		return [
            'fieldTableList' => ['id','uuid','name','visitor'],
            'fieldTableView' => ['id','uuid','name','visitor','created_at','updated_at','deleted'],
            'fieldTableInsert' => ['uuid','name','visitor','created_by','updated_by','deleted_by','deleted'],
        ];
	}
    private function fieldValidate()
    {
        return [
            'name'   => 'required',
            'visitor'   => 'required',
            'created_by'   => 'required',
            'updated_by'   => 'required',
            'deleted_by'   => 'required',
            'deleted'   => 'required',
        ];
    }
    /*
    |--------------------------------------------------------------------------
    | Validate User
    |--------------------------------------------------------------------------
    */
    public function validateUserAccount($request)
    {
        return Validator::make($request->all(),$this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistUserAccount ($request)
    {
        if ($request->filter !== null && $request->deleted === false) {
            $data = explode(" ",$request->filter);
            return $this->formatOUTList(UserAccount::where($data[0],'LIKE','%'.$data[1].'%')->get());
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList(UserAccount::select(['id','uuid','name','visitor'])->latest()->paginate($request->limit !== null ? $request->limit :5));
        }else {
            return  UserAccount::onlyTrashed()->get();
        }
    }

    public function formatOUTList($result)
    {
        $getField = $this->showField()['fieldTableList'];
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->uuid,
                $getField[2] => $value->name,
                $getField[3] => $value->visitor,
                'dev' =>[
                    'id' => 1,
                    'name' => 'Admin'
                ]
            ]);
        }
        return $value_result;
    }

    public function doInsertUserAccount ($request)
    {
        $getField = $this->showField()['fieldTableInsert'];
        return UserAccount::create([
            $getField[0]     => Str::uuid(),
            $getField[1]   => $request->name,
            $getField[2]   => $request->visitor,
            $getField[3]   => $request->created_by,
            $getField[4]   => $request->updated_by,
            $getField[5]   => $request->deleted_by,
            $getField[6]   => $request->deleted,
        ]);
    }

    public function doViewUserAccount($id)
    {
        return $this->formatOUTView(UserAccount::find($id));
    }

    public function formatOUTView($result)
    {
        $getField = $this->showField()['fieldTableView'];
        return [
            $getField[0] => $result->id,
            $getField[1] => $result->uuid,
            $getField[2] => $result->name,
            $getField[3] => $result->visitor,
            $getField[4] => $result->created_at,
            $getField[5] => $result->updated_at,
            $getField[6] => $result->deleted,
            'dev' =>[
                'id' => 1,
                'name' => 'Admin'
            ]
        ];
    }

    public function doDeleteUserAccount($id)
    {
        $userAccount = UserAccount::find($id);
        return $userAccount->delete();
    }

    public function doCountUserAccount($id = 0)
    {
        if($id == 0){
            return UserAccount::latest()->count();
        }else{
            return UserAccount::where('id', $id)->latest()->count();
        }
    }

    public function doCountSearchUserAccount($request)
    {
        $data = explode(" ",$request->filter);
        return UserAccount::where($data[0],'LIKE','%'.$data[1].'%')->get()->count();
    }

    public function doCountListTrash()
    {
        return UserAccount::onlyTrashed()->get()->count();
    }
}
