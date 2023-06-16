<?php

namespace App\Http\Controllers;

use App\Models\GameList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameListController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $gamelists = GameList::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List data',
            'data' => $gamelists
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
            'game_code' => 'required',
            'game_name' => 'required',
            'icon_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gamelist = GameList::create([
            'game_code' => $request->game_code,
            'game_name' => $request->game_name,
            'icon_url' => $request->icon_url
        ]);

        if ($gamelist) {
            return response()->json([
                'status' => true,
                'message' => 'Data gamelist berhasil dibuat!'
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data gamelist gagal dibuat!'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $gamelist = GameList::findOrfail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data gamelist',
            'data' => [$gamelist]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, GameList $gamelist) {
        $validator = Validator::make($request->all(), [
            'game_code' => 'required',
            'game_name' => 'required',
            'icon_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gamelist = GameList::findOrFail($id);

        if ($gamelist) {

            //update post
            $gamelist->update([
                'game_code' => $request->game_code,
                'game_name' => $request->game_name,
                'icon_url' => $request->icon_url
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data gamelist berhasil diubah!'
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
        $gamelist = GameList::findOrfail($id);

        if ($gamelist) {
            $gamelist->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data gamelist berhasil dihapus!',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data gamelist tidak ditemukan!',
        ], 404);
    }
}
