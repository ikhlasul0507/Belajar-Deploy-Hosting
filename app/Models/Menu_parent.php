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
    protected $fillable = ['uuid','name','name_en','sequence','access_menu','icon','background','available_action','set_label','status'];

    /*
    |--------------------------------------------------------------------------
    | Get Field Names
    |--------------------------------------------------------------------------
    */

    private function fieldTableList()
    {
        return ['id','uuid','name','name_en','sequence','access_menu','icon','background','available_action','set_label','status','link_url'];
    }

    private function fieldTableView()
    {
        return ['id','name','available_action','set_label','icon','link_url'];
    }

    private function fieldTableInsertOrUpdate()
    {
        return ['uuid','name','name_en','sequence','access_menu','icon','background','available_action','set_label','status'];
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
                $getField[1] => $value->uuid,
                $getField[2] => $value->name,
                $getField[3] => $value->name_en,
                $getField[4] => $value->sequence,
                $getField[5] => $value->access_menu,
                $getField[6] => $value->icon,
                $getField[7] => $value->background,
                $getField[8] => $value->available_action,
                $getField[9] => $value->set_label,
                $getField[10] => $value->status,
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
                $getField[3] => $value->set_label,
                $getField[4] => $value->icon,
                $getField[5] => $value->link_url,
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
