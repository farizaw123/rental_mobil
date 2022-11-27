<?php

namespace App\Http\Controllers;
use App\Models\kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Kendaraan = kendaraan::all();
        return response()->json([
            "message" => "Load data success",
            "data" => $Kendaraan
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
        $table_kendaraan = kendaraan::create([
            "nama" => $request->nama,
            "merk" => $request->merk,
            "seat" => $request->seat,
            "cc" => $request->cc,
            "warna" => $request->warna,
            "transmisi" => $request->transmisi,
            "tahun" => $request->tahun,
            "harga" => $request->harga,
            "deskripsi" => $request->deskripsi,
        ]);

        return response()->json([
            "message" => "Store success",
            "data" => $table_kendaraan
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
        $table = kendaraan::find($id);
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
        $table = kendaraan::find($id);
        if($table){
            $table->nama = $request->nama ? $request->nama : $table->nama;
            $table->merk = $request->merk ? $request->merk : $table->merk;
            $table->seat = $request->seat ? $request->seat : $table->seat;
            $table->cc = $request->cc ? $request->cc : $table->cc;
            $table->warna = $request->warna ? $request->warna : $table->warna;
            $table->transmisi = $request->transmisi ? $request->transmisi : $table->transmisi;
            $table->tahun = $request->tahun ? $request->tahun : $table->tahun;
            $table->harga = $request->harga ? $request->harga : $table->harga;
            $table->deskripsi = $request->deskripsi ? $request->deskripsi : $table->deskripsi;
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
        $table = kendaraan::find($id);
        if($table){
            $table->delete();
            return ["message" => "Delete succes"];
        }else{
            return ["message" => "Data not found"];
        }
    }
}
