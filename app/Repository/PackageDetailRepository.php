<?php 
    namespace App\Repository;
    use App\Models\Package_detail;
    use Illuminate\Support\Str;

    class PackageDetailRepository {

       public function insertDataPackageDetail($getField, $detail, $id)
        {
            return Package_detail::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $id,
                $getField[2]   => $detail['sequence'],
                $getField[3]   => $detail['description'],
            ]);
        }

        public function listSearchPackageDetail($id)
        {
            return Package_detail::where('package_id',$id)->orderBy('sequence', 'ASC')->get();
        }

        public function forceDeletePackageDetail($id)
        {
            return Package_detail::where('package_id',$id)->forceDelete();
        }

    }

?>