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
	public function showField()
	{
		return [
            'fieldTableList' => ['id','uuid','name','visitor','created_at','updated_at'],
            'fieldTableView' => ['id','uuid','name','visitor','created_at','updated_at','deleted'],
        ];
	}
    /*
    |--------------------------------------------------------------------------
    | Validate User
    |--------------------------------------------------------------------------
    */
    public function validateUserAccount($request)
    {
        return Validator::make($request->all(), [
            'name'   => 'required',
            'visitor'   => 'required',
            'created_by'   => 'required',
            'updated_by'   => 'required',
            'deleted_by'   => 'required',
            'deleted'   => 'required',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistUserAccount ($request)
    {
        if ($request->filter !== null) {
            $data = explode(" ",$request->filter);
            return $this->formatOUTList(UserAccount::where($data[0],'LIKE','%'.$data[1].'%')->get());
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList(UserAccount::select($this->showField()['fieldTableList'])->latest()->paginate($request->limit !== null ? $request->limit :5));
        }else {
            return  UserAccount::onlyTrashed()->get();
        }
    }

    public function formatOUTList($result)
    {
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                'id' => $value->id,
                'name' => $value->name,
                'visitor' => $value->visitor,
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
        return UserAccount::create([
            'uuid'     => Str::uuid(),
            'name'   => $request->name,
            'visitor'   => $request->visitor,
            'created_by'   => $request->created_by,
            'updated_by'   => $request->updated_by,
            'deleted_by'   => $request->deleted_by,
            'deleted'   => $request->deleted,
        ]);
    }

    public function doViewUserAccount($id)
    {
        return $this->formatOUTView(UserAccount::find($id));
    }

    public function formatOUTView($result)
    {
        return [
            'id' => $result->id,
            'uuid' => $result->uuid,
            'name' => $result->name,
            'visitor' => $result->visitor,
            'created_at' => $result->created_at,
            'updated_at' => $result->updated_at,
            'deleted' => $result->deleted,
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
