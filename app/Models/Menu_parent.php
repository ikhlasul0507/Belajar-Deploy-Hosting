<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repository\MenuParentRepository;

class Menu_parent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /*
    |--------------------------------------------------------------------------
    | Initiate Field Insert Or Update
    |--------------------------------------------------------------------------
    */
    protected $fillable = ['uuid','name','name_en','sequence','access_menu','icon','background','available_action','status'];

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
        return ['id','name','available_action'];
    }

    private function fieldTableInsertOrUpdate()
    {
        return ['uuid','name','name_en','sequence','access_menu','icon','background','available_action','status'];
    }

    /*
    |--------------------------------------------------------------------------
    | Validate
    |--------------------------------------------------------------------------
    */
    

    private function fieldValidate()
    {
        return [
            'name' => config('constanta.validate_name'),
            'name_en'   => config('constanta.validate_name'),
        ];
    }

    public function validateMenuParent($request)
    {
        return Validator::make($request->all(),$this->fieldValidate());
    }

    /*
    |--------------------------------------------------------------------------
    | Function Do
    |--------------------------------------------------------------------------
    */
    public function doGetlistMenuParent ($request)
    {
        $MenuParents = new MenuParentRepository();
        if ($request->filter !== null && $request->deleted === false) {
            return $this->formatOUTList($MenuParents->listSearchMenuParent($request));
        }
        if ($request->deleted === false) {
            return  $this->formatOUTList($MenuParents->listMenuParent($request));
        }else {
            return  $MenuParents->listDeleteMenuParent();
        }
    }

    public function doInsertMenuParent ($request)
    {
        $MenuParents = new MenuParentRepository();
        return $MenuParents->insertDataMenuParent($this->fieldTableInsertOrUpdate(), $request)->id;
    }
    
    public function doUpdateMenuParent ($request, $id)
    {
        $MenuParents = new MenuParentRepository();
        if ( $id > 0)
        {
            $MenuParents->updateDataMenuParent($this->fieldTableInsertOrUpdate(), $request, $id);
        }
        return true;
    }

    public function doViewMenuParent($list_id)
    {
        $MenuParents = new MenuParentRepository();
        return $this->formatOUTViewListID($MenuParents->viewDetailMenuParent($list_id));
    }

    public function doDeleteMenuParent($id)
    {
        $MenuParents = new MenuParentRepository();
        return $MenuParents->deleteMenuParent($id);
    }

    public function doCountMenuParent($id = 0)
    {
        $MenuParents = new MenuParentRepository();
        return $MenuParents->countMenuParent($id);
    }

    public function doCountSearchMenuParent($request)
    {
        $MenuParents = new MenuParentRepository();
        return $MenuParents->countSearchMenuParent($request);
    }

    public function doCountListTrash()
    {
        $MenuParents = new MenuParentRepository();
        return $MenuParents->countListTrash();
    }

    public function formatOUTList($result)
    {
        $getField = $this->fieldTableList();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->user_id,
                $getField[2] => $value->menu_id,
                $getField[3] => $value->title,
                $getField[4] => $value->description,
                $getField[5] => $value->optional_description,
            ]);
        }
        return $value_result;
    }

    public function formatOUTViewListID($result)
    {
        $getField = $this->fieldTableView();
        $value_result = [];
        foreach ($result as $key => $value) {
            array_push($value_result,[
                $getField[0] => $value->id,
                $getField[1] => $value->name,
                $getField[2] => $value->available_action,
            ]);
        }
        return $value_result;
    }
 
    public function formatOUTView($result)
    {
        $getField = $this->fieldTableView();
        return [
            $getField[0] => $result['id'],
            $getField[1] => $result['name'],
        ];
    }

}
