<?php 
    namespace App\Repository;
    use App\Models\Account_payment;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;
    class AccountPaymentRepository {

        public function listAccountPayment($request)
        {
            return Account_payment::select(['id','user_id','visitor','name','jenis','optional_description','account_number','detail_photo'])->latest()->paginate($request->limit !== null ? $request->limit :5);
        }

        public function listSearchAccountPayment($request)
        {
            $data = explode(" ",$request->filter);
            return Account_payment::where($data[0],'LIKE','%'.$data[1].'%')->get();
        }

        public function listDeleteAccountPayment()
        {
            return Account_payment::onlyTrashed()->get();
        }

        public function viewDetailAccountPayment($id)
        {
            return Account_payment::find($id);
        }

        public function insertDataAccountPayment($getField, $request, $filename)
        {
            return Account_payment::create( [
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->visitor,
                $getField[3]   => $request->name,
                $getField[4]   => $request->jenis,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->account_number,
                $getField[7]   => json_encode([
                    'path' => url(config('constanta.path_account')),
                    'filename' => $filename
                ])
            ]);

        }

        public function updateDataAccountPayment($getField, $request, $filename, $id)
        {
               
            $accountPayment = Account_payment::find($id);
            $requestContent = json_decode($request->content);
            Storage::delete(config('constanta.path_account').json_decode($accountPayment->detail_photo)->filename);
            return  $accountPayment->update([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $requestContent->user_id,
                $getField[2]   => $requestContent->visitor,
                $getField[3]   => $requestContent->name,
                $getField[4]   => $requestContent->jenis,
                $getField[5]   => $requestContent->optional_description,
                $getField[6]   => $requestContent->account_number,
                $getField[7]   => json_encode([
                    'path' => url(config('constanta.path_account')),
                    'filename' => $filename
                ])
            ]);
        }

        public function deleteAccountPayment($id)
        {
            $accountPayment = Account_payment::find($id);
            Storage::delete(config('constanta.path_account').json_decode($accountPayment->detail_photo)->filename);
            return $accountPayment->delete();
        }

        public function countAccountPayment($id)
        {
            if($id == 0){
                return Account_payment::latest()->count();
            }else{
                return Account_payment::where('id', $id)->latest()->count();
            }
        }

        public function countSearchAccountPayment($request)
        {
            $data = explode(" ",$request->filter);
            return Account_payment::where($data[0],'LIKE','%'.$data[1].'%')->get()->count();
        }

        public function countListTrash()
        {
            return Account_payment::onlyTrashed()->get()->count();
        }

    }

?>