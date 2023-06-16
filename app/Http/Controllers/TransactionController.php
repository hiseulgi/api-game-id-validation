<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Transactions = Transaction::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List data',
            'data' => $Transactions
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validasi form
        $validator = Validator::make($request->all(), [
            'game_code' => 'required',
            'game_detail_id' => 'required',
            'buyer_game_id' => 'required',
            'amount' => 'required',
            'payment_method_id' => 'required',
            'email' => 'required',
            'status' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // validasi buyer_game_id apakah ada di game atau tidak
        $key = '01b2964cbb65db4';
        $url = "https://api-bo.my.id/v2.1/game/freefire/?id=" . $request->buyer_game_id . "&key=" . $key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($output, TRUE);

        // cek apakah berhasil ambil api
        if ($data){
            // cek apakah data id ff valid
            if (count($data) == 2) $isValid = false;
            else $isValid = true;
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghubungkan ke api!'
            ], 409);
        }

        // cek apakah data id ff valid
        if ($isValid) {
            // skip
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data id ff tidak ada!'
            ], 409);
        }

        // generate transaction number and reference number
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $trans_num = str_shuffle($pin);

        $ref_num = uniqid();

        $Transaction = Transaction::create([
            'transaction_number' => $trans_num,
            'reference_number' => $ref_num,
            'game_code' => $request->game_code,
            'game_detail_id' => $request->game_detail_id,
            'buyer_game_id' => $request->buyer_game_id,
            'amount' => $request->amount,
            'payment_method_id' => $request->payment_method_id,
            'email' => $request->email,
            'status' => $request->status,
            'user_id' => $request->user_id
        ]);

        if ($Transaction) {
            return response()->json([
                'status' => true,
                'message' => 'Data Transaction berhasil dibuat!'
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data Transaction gagal dibuat!'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $Transaction = Transaction::findOrfail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data Transaction',
            'data' => [$Transaction]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * Only update status by Transaction_number
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $trans_num = $request->query('transaction_number');
        $Transaction = Transaction::where('transaction_number', $trans_num)->first();
        if (!$Transaction) {
            return response()->json([
                'status' => false,
                'message' => 'Transaction Not Found',
            ], 404);
        }

        if ($Transaction) {

            //update post
            $Transaction->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data Transaction berhasil diubah!'
            ], 200);
        }

        //data post not found
        return response()->json([
            'status' => false,
            'message' => 'Transaction Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $Transaction = Transaction::findOrfail($id);

        if ($Transaction) {
            $Transaction->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data Transaction berhasil dihapus!',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data Transaction tidak ditemukan!',
        ], 404);
    }
}
