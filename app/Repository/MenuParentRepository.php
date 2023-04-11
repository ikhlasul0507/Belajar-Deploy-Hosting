<?php 
    namespace App\Repository;
    use App\Models\Menu_parent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
    class MenuParentRepository {

        public function listMenuParent($request)
        {
            return Menu_parent::select(['id','user_id','visitor','name','jenis','optional_description','account_number','detail_photo'])->latest()->paginate($request->limit !== null ? $request->limit :5);
        }

        public function listSearchMenuParent($request)
        {
            $data = explode(" ",$request->filter);
            return Menu_parent::where($data[0],'LIKE','%'.$data[1].'%')->get();
        }

        public function listDeleteMenuParent()
        {
            return Menu_parent::onlyTrashed()->get();
        }

        public function viewDetailMenuParent($list_id)
        {
            $data = explode(",",$list_id);
            return Menu_parent::whereIn('id', $data)->get();;
        }

        public function insertDataMenuParent($getField, $request)
        {
            return Menu_parent::create( [
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->name,
                $getField[2]   => $request->name_en,
                $getField[3]   => $request->sequence,
                $getField[4]   => $request->access_menu,
                $getField[5]   => $request->icon,
                $getField[6]   => $request->background,
                $getField[7]   => $request->available_action,
                $getField[8]   => true,
            ]);
        }

        public function updateDataMenuParent($getField, $request, $id)
        {
               
            $MenuParent = Menu_parent::find($id);
            $requestContent = json_decode($request->content);
            Storage::delete(config('constanta.path_account').json_decode($MenuParent->detail_photo)->filename);
            return  $MenuParent->update([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $requestContent->user_id,
                $getField[2]   => $requestContent->visitor,
                $getField[3]   => $requestContent->name,
                $getField[4]   => $requestContent->jenis,
                $getField[5]   => $requestContent->optional_description,
                $getField[6]   => $requestContent->account_number,
            ]);
        }

        public function deleteMenuParent($id)
        {
            $MenuParent = Menu_parent::find($id);
            Storage::delete(config('constanta.path_account').json_decode($MenuParent->detail_photo)->filename);
            return $MenuParent->delete();
        }

        public function countMenuParent($id)
        {
            if($id == 0){
                return Menu_parent::latest()->count();
            }else{
                return Menu_parent::where('id', $id)->latest()->count();
            }
        }

        public function countSearchMenuParent($request)
        {
            $data = explode(" ",$request->filter);
            return Menu_parent::where($data[0],'LIKE','%'.$data[1].'%')->get()->count();
        }

        public function countListTrash()
        {
            return Menu_parent::onlyTrashed()->get()->count();
        }

    }

?>