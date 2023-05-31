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
        'user_id',
        'is_super_user',
        'user_level',
        'address1',
        'address2',
        'phone',
        'user_login_valid_from',
        'user_login_valid_thru',
        'list_access_menu'
    ];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */
    private function showField()
    {
        return [
            'fieldTableList' => ['id', 'uuid', 'name', 'visitor'],
            'fieldTableView' => ['id', 'uuid', 'is_super_user', 'user_level', 'address1', 'address2', 'phone', 'list_access_menu'],
            'fieldTableInsert' => ['uuid', 'user_id', 'is_super_user', 'user_level', 'address1', 'address2', 'phone', 'user_login_valid_from', 'user_login_valid_thru', 'list_access_menu'],
        ];
    }
    private function fieldValidate()
    {
        return [
            'name'   => config('constanta.validate_name'),
            'user_id' => config('constanta.validate_user_id'),
            'user_level' => config('constanta.validate_user_level'),
            'address1' => config('constanta.validate_address1'),
        ];
    }
    /*
    |--------------------------------------------------------------------------
    | Validate User
    |--------------------------------------------------------------------------
    */
    public function validateUserAccount($request)
    {
        return Validator::make($request->all(), $this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistUserAccount($request)
    {
        if ($request->filter !== null && $request->deleted === false) {
            $data = explode(" ", $request->filter);
            return $this->formatOUTList(UserAccount::where($data[0], 'LIKE', '%' . $data[1] . '%')->get());
        }
        if ($request->deleted === false || $request->deleted === null) {
            return  $this->formatOUTList(UserAccount::select(['id', 'uuid', 'name', 'visitor'])->latest()->paginate($request->limit !== null ? $request->limit : 5));
        } else {
            return  UserAccount::onlyTrashed()->get();
        }
    }

    public function formatOUTList($result)
    {
        $getField = $this->showField()['fieldTableList'];
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result, [
                $getField[0] => $value->id,
                $getField[1] => $value->uuid,
                $getField[2] => $value->name,
                $getField[3] => $value->visitor,
                'dev' => [
                    'id' => 1,
                    'name' => 'Admin'
                ]
            ]);
        }
        return $value_result;
    }

    public function doInsertUserAccount($request, $user_id = 0)
    {

        $getField = $this->showField()['fieldTableInsert'];
        return UserAccount::create([
            $getField[0]   => Str::uuid(),
            $getField[1]   => $user_id,
            $getField[2]   => $request['is_super_user'],
            $getField[3]   => $request['user_level'],
            $getField[4]   => $request['address1'],
            $getField[5]   => $request['address2'],
            $getField[6]   => $request['phone'],
            $getField[7]   => $request['user_login_valid_from'],
            $getField[8]   => $request['user_login_valid_thru'],
            $getField[9]   => $request['list_access_menu']
        ]);
    }

    public function doViewUserAccount($id)
    {
        return $this->formatOUTView(UserAccount::where('user_id', $id)->first());
    }

    public function formatOUTView($result)
    {
        $getField = $this->showField()['fieldTableView'];
        return [
            $getField[0] => $result->id,
            $getField[1] => $result->uuid,
            $getField[2] => $result->is_super_user,
            $getField[3] => $result->user_level,
            $getField[4] => $result->address1,
            $getField[5] => $result->address2,
            $getField[6] => $result->phone,
            $getField[7] => $result->list_access_menu,
        ];
    }

    public function doDeleteUserAccount($id)
    {
        $userAccount = UserAccount::find($id);
        return $userAccount->delete();
    }

    public function doCountUserAccount($id = 0)
    {
        if ($id == 0) {
            return UserAccount::latest()->count();
        } else {
            return UserAccount::where('user_id', $id)->latest()->count();
        }
    }

    public function doCountSearchUserAccount($request)
    {
        $data = explode(" ", $request->filter);
        return UserAccount::where($data[0], 'LIKE', '%' . $data[1] . '%')->get()->count();
    }

    public function doCountListTrash()
    {
        return UserAccount::onlyTrashed()->get()->count();
    }
}
