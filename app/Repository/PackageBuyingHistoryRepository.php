<?php 
    namespace App\Repository;
    use App\Models\Package_buying_history;
    use Illuminate\Support\Str;

    class PackageBuyingHistoryRepository {

        public function listPackageBuyingHistory($request)
        {
            return Package_buying_history::
                join('packages','package_buying_histories.package_id','=','packages.id')
                ->join('account_payments','account_payment_id','=','account_payments.id')
                ->join('users','package_buying_histories.user_id','=','users.id')
                ->select([
                    'package_buying_histories.id',
                    'packages.title',
                    'account_payments.name',
                    'account_payments.account_number',
                    'package_buying_histories.status',
                    'package_buying_histories.created_at',
                    ])
                ->where('users.id', $request->user_id)
                ->orderBy('package_buying_histories.id', 'DESC')
                ->paginate($request->limit !== null ? $request->limit :5);
        }

        public function listSearchPackageBuyingHistory($request)
        {
            $data = explode(" ",$request->filter);
            return Package_buying_history::
                join('packages','package_buying_histories.package_id','=','packages.id')
                ->join('account_payments','account_payment_id','=','account_payments.id')
                ->join('users','package_buying_histories.user_id','=','users.id')
                ->select([
                    'package_buying_histories.id',
                    'packages.title',
                    'account_payments.name',
                    'account_payments.account_number',
                    'package_buying_histories.status',
                    'package_buying_histories.created_at',
                    ])
                ->where($data[0],'LIKE','%'.$data[1].'%')
                ->orderBy('package_buying_histories.id', 'DESC')
                ->get();
        }

        public function listDeletePackageBuyingHistory()
        {
            return Package_buying_history::onlyTrashed()->get();
        }

        public function viewDetailPackageBuyingHistory($id)
        {
            return Package_buying_history::find($id);
        }

        public function insertDataPackageBuyingHistory($getField, $request)
        {
            return Package_buying_history::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->package_id,
                $getField[3]   => $request->account_payment_id,
                $getField[4]   => $request->visitor,
                $getField[5]   => $request->net_amount
            ]);

        }

        public function updateDataPackageBuyingHistory($getField, $request, $id)
        {
            return Package_buying_history::find($id)->update([
                $getField[2]   => $request->package_id,
                $getField[3]   => $request->account_payment_id,
                $getField[5]   => $request->net_amount,
                $getField[6]   => $request->status
            ]);
        }
        
        public function deletePackageBuyingHistory($id)
        {
            $Package = Package_buying_history::find($id);
            return $Package->delete();
        }

        public function countPackageBuyingHistory($id)
        {
            if($id == 0){
                return Package_buying_history::latest()->count();
            }else{
                return Package_buying_history::where('id', $id)->latest()->count();
            }
        }

        public function countSearchPackageBuyingHistory($request)
        {
            $data = explode(" ",$request->filter);
            return Package_buying_history::where($data[0],'LIKE','%'.$data[1].'%')->get()->count();
        }

        public function countListTrashBuyingHistory()
        {
            return Package_buying_history::onlyTrashed()->get()->count();
        }

    }