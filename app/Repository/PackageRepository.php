<?php 
    namespace App\Repository;
    use App\Models\Package;
    use Illuminate\Support\Str;

    class PackageRepository {

        public function listPackage($request)
        {
            return Package::select(['id','user_id','title','description','optional_description','amount'])->latest()->paginate($request->limit !== null ? $request->limit :5);
        }

        public function listSearchPackage($request)
        {
            $data = explode(" ",$request->filter);
            return Package::where($data[0],'LIKE','%'.$data[1].'%')->get();
        }

        public function listDeletePackage()
        {
            return Package::onlyTrashed()->get();
        }

        public function viewDetailPackage($id)
        {
            return Package::find($id);
        }

        public function insertDataPackage($getField, $request)
        {
            return Package::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->visitor,
                $getField[3]   => $request->title,
                $getField[4]   => $request->description,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->amount,
            ]);

        }

        public function insertDataPackageDetail($getField, $request)
        {
            return Package::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->visitor,
                $getField[3]   => $request->title,
                $getField[4]   => $request->description,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->amount,
            ]);

        }

        public function updateDataPackage($getField, $request, $id)
        {
            return Package::find($id)->update([
                $getField[3]   => $request->title,
                $getField[4]   => $request->description,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->amount,
            ]);
        }
        
        public function deletePackage($id)
        {
            $Package = Package::find($id);
            return $Package->delete();
        }

        public function countPackage($id)
        {
            if($id == 0){
                return Package::latest()->count();
            }else{
                return Package::where('id', $id)->latest()->count();
            }
        }

        public function countSearchPackage($request)
        {
            $data = explode(" ",$request->filter);
            return Package::where($data[0],'LIKE','%'.$data[1].'%')->get()->count();
        }

        public function countListTrash()
        {
            return Package::onlyTrashed()->get()->count();
        }

    }

?>