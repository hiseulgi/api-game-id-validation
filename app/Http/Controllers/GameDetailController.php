<?php

namespace App\Http\Controllers;

use App\Models\GameDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $gamedetails = GameDetail::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List data',
            'data' => $gamedetails
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price' => 'required',
            'game_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $GameDetail = GameDetail::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'game_code' => $request->game_code
        ]);

        if ($GameDetail) {
            return response()->json([
                'status' => true,
                'message' => 'Data GameDetail berhasil dibuat!'
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data GameDetail gagal dibuat!'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $GameDetail = GameDetail::findOrfail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data GameDetail',
            'data' => [$GameDetail]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, GameDetail $GameDetail) {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'price' => 'required',
            'game_code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $GameDetail = GameDetail::findOrFail($id);

        if ($GameDetail) {

            //update post
            $GameDetail->update([
                'product_name' => $request->game_code,
                'price' => $request->game_name,
                'game_code' => $request->icon_url
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data GameDetail berhasil diubah!'
            ], 200);
        }

        //data post not found
        return response()->json([
            'status' => false,
            'message' => 'Post Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $GameDetail = GameDetail::findOrfail($id);

        if ($GameDetail) {
            $GameDetail->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data GameDetail berhasil dihapus!',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data GameDetail tidak ditemukan!',
        ], 404);
    }
}
