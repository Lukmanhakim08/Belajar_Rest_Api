<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceApi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return new ResourceApi(true, 'Data Barang ', $barangs);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'  => 'required',
            'harga_barang' => 'required|numeric',
            'stok_barang'  => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else{
            $barangs = Barang::create([
                'nama_barang' => $request->nama_barang,
                'foto_barang' => '',
                'harga_barang'=> $request->harga_barang,
                'stok_barang' => $request->stok_barang,
            ]);
            return new ResourceApi(true, 'Data berhasil di simpan', $barangs);
        }
    }

    public function show($id)
    {
        $barangs = Barang::find($id);
        if ($barangs) {
            return new ResourceApi(true, 'Data ditemukan', $barangs);
        } else{
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'  => 'required',
            'harga_barang' => 'required|numeric',
            'stok_barang'  => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else{
            $barangs = Barang::find($id);
            if ($barangs) {
                $barangs->nama_barang = $request->nama_barang;
                $barangs->harga_barang = $request->harga_barang;
                $barangs->stok_barang = $request->stok_barang;
                $barangs->save();
                return new ResourceApi(true, 'Data berhasil di update', $barangs);
            } else {
                return response()->json([
                    'message' => 'Data not found'
                ]);
            } 
        }
    }
    public function destroy($id)
    {
        $barangs = Barang::find($id);
        if ($barangs) {
            $barangs->delete();
            return new ResourceApi(true, 'Data berhasil di hapus', '');
        } else {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
    }
}
