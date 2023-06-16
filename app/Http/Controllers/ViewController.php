<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ViewController extends Controller {
    public function index() {
        $request = Request::create('/api/v1/gamelist', 'GET');
        $json = json_decode(Route::dispatch($request)->getContent());

        $gamelists = null;
        if ($json->status) {
            $gamelists = $json->data;
        }

        return view('gamelist.index', compact('gamelists'));
    }

    public function gameDetail($gamecode) {
        // request game detail
        $request = Request::create('/api/v1/gamedetail', 'GET');
        $json = json_decode(Route::dispatch($request)->getContent());

        $gamedetails = null;
        if ($json->status) {
            $collection = collect($json->data);
            $filtered = $collection->whereIn('game_code', $gamecode);
            $gamedetails = ($filtered);
        }

        $request2 = Request::create('/api/v1/payment', 'GET');
        $response2 =  app()->handle($request2);
        $payments = $response2->original['data'];

        return view('gamedetail.index', compact('gamedetails', 'payments'));
        // return response()->json([
        //     $gamedetails,
        // ], 409);
    }

    public function storeTransaction(Request $request) {
        $body = [
            'game_code' => $request->game_code,
            'game_detail_id' => $request->game_detail_id,
            'buyer_game_id'=>$request->buyer_game_id,
            'amount'=>$request->amount,
            'payment_method_id'=>$request->payment_method_id,
            'email'=>$request->email,
            'status'=>$request->status,
            'user_id'=>$request->user_id
        ];
        
        $request = Request::create('/api/v1/transaction', 'POST', $body);
        // $json = json_decode(Route::dispatch($request)->getContent());

        $response =  app()->handle($request);

        return response()->json([
            $response
        ], 409);
    }
}
