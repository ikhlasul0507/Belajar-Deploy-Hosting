<?php 
    namespace App\Repository;
    use App\Models\Account_payment;
    use Illuminate\Support\Str;

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
            return Account_payment::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->visitor,
                $getField[3]   => $request->name,
                $getField[4]   => $request->jenis,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->account_number,
                $getField[7]   => [
                    'path' => url(config('constanta.path_account')),
                    'filename' => $filename
                ]
            ]);

        }

        public function insertDataAccountPaymentDetail($getField, $request)
        {
            return Account_payment::create([
                $getField[0]   => Str::uuid(),
                $getField[1]   => $request->user_id,
                $getField[2]   => $request->visitor,
                $getField[3]   => $request->title,
                $getField[4]   => $request->description,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->amount,
            ]);

        }

        public function updateDataAccountPayment($getField, $request, $id)
        {
            return Account_payment::find($id)->update([
                $getField[3]   => $request->title,
                $getField[4]   => $request->description,
                $getField[5]   => $request->optional_description,
                $getField[6]   => $request->amount,
            ]);
        }

        public function deleteAccountPayment($id)
        {
            $AccountPayment = Account_payment::find($id);
            return $AccountPayment->delete();
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