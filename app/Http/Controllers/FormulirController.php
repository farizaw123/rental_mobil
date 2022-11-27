<?php

namespace App\Http\Controllers;
use App\Models\formulir;
use App\Models\kendaraan;
use Illuminate\Http\Request;
use Auth;

class FormulirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formulir = formulir::all();
        return response()->json([
            "message" => "Load data success",
            "data" => $formulir
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_kendaraan = kendaraan::find($request->mobil_sewa);
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code.$character;
        }

        if (formulir::select('order_code')->where('order_code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        $id_user = Auth::id();
        $table = formulir::create([
            "id_user" => $id_user,
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "telp" => $request->telp,
            "email" => $request->email,
            "tanggal_sewa" => $request->tanggal_sewa,
            "mobil_sewa" => $request->mobil_sewa,
            "pickup_time" => $request->pickup_time,
            "harga" => $data_kendaraan->harga,
            "order_code" => $code,
        ]);

        return response()->json([
            "message" => "Store success",
            "data" => $table
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = formulir::find($id);
        if($table){
            return $table;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = formulir::find($id);
        if($table){
            $table->nama = $request->nama ? $request->nama : $table->nama;
            $table->alamat = $request->alamat ? $request->alamat : $table->alamat;
            $table->telp = $request->telp ? $request->telp : $table->telp;
            $table->email = $request->email ? $request->email : $table->email;
            $table->tanggal_sewa = $request->tanggal_sewa ? $request->tanggal_sewa : $table->tanggal_sewa;
            $table->mobil_sewa = $request->mobil_sewa ? $request->mobil_sewa : $table->mobil_sewa;
            $table->pickup_time = $request->pickup_time ? $request->pickup_time : $table->pickup_time;
            $table->harga = $request->harga ? $request->harga : $table->harga;
            $table->order_code = $request->order_code ? $request->order_code : $table->order_code;
            $table->save();

            return $table;
        }else{
            return ["message" => "Data not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
