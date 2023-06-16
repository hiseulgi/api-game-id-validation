<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $PaymentMethods = PaymentMethod::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'List data',
            'data' => $PaymentMethods
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
            'name' => 'required',
            'tax' => 'required',
            'icon_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $PaymentMethod = PaymentMethod::create([
            'name' => $request->name,
            'tax' => $request->tax,
            'icon_url' => $request->icon_url
        ]);

        if ($PaymentMethod) {
            return response()->json([
                'status' => true,
                'message' => 'Data PaymentMethod berhasil dibuat!'
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data PaymentMethod gagal dibuat!'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $PaymentMethod = PaymentMethod::findOrfail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data PaymentMethod',
            'data' => [$PaymentMethod]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PaymentMethod $PaymentMethod) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'tax' => 'required',
            'icon_url' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $PaymentMethod = PaymentMethod::findOrFail($id);

        if ($PaymentMethod) {

            //update post
            $PaymentMethod->update([
                'name' => $request->name,
                'tax' => $request->tax,
                'icon_url' => $request->icon_url
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data PaymentMethod berhasil diubah!'
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
        $PaymentMethod = PaymentMethod::findOrfail($id);

        if ($PaymentMethod) {
            $PaymentMethod->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data PaymentMethod berhasil dihapus!',
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Data PaymentMethod tidak ditemukan!',
        ], 404);
    }
}
