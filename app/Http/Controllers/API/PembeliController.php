<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceApi;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembeliController extends Controller
{
    public function index()
    {
        $data = Pembeli::all();
        return new ResourceApi(true, 'Data Pembeli ', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pembeli'  => 'required',
            'jenis_kelamin' => 'required',
            'no_hp'         => 'required|numeric|unique:pembelis,no_hp',
            'alamat'        => 'required',
            'email'         => 'required|email|unique:pembelis,email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else{
            $data = Pembeli::create([
                'nama_pembeli'  => $request->nama_pembeli,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp'         => $request->no_hp,
                'alamat'        => $request->alamat,
                'email'         => $request->email,
                'password'      => $request->password,
            ]);
            return new ResourceApi(true, 'Data berhasil di simpan', $data);
        }
    }

    public function show($id)
    {
        $data = Pembeli::find($id);
        if ($data) {
            return new ResourceApi(true, 'Data ditemukan', $data);
        } else{
            return response()->json([
                'message' => 'Data tidak ada'
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pembeli'  => 'required',
            'jenis_kelamin' => 'required',
            'no_hp'         => 'required|numeric|unique:pembelis,no_hp',
            'alamat'        => 'required',
            'email'         => 'required|email|unique:pembelis,email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else{
            $datapembeli = Pembeli::find($id);
            if ($datapembeli) {
                $datapembeli->nama_pembeli = $request->nama_pembeli;
                $datapembeli->jenis_kelamin = $request->jenis_kelamin;
                $datapembeli->no_hp = $request->no_hp;
                $datapembeli->alamat = $request->alamat;
                $datapembeli->email = $request->email;
                $datapembeli->save();
                return new ResourceApi(true, 'Data berhasil di update', $datapembeli);
            } else {
                return response()->json([
                    'message' => 'Data not found'
                ]);
            } 
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
        $data = Pembeli::find($id);
        if ($data) {
            $data->delete();
            return new ResourceApi(true, 'Data berhasil di hapus', '');
        } else {
            return response()->json([
                'message' => 'Data not found'
            ]);
        }
    }
}
