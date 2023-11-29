<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kdpos;

class AlamatController extends Controller
{
    public function getAlamat(Request $request)
    {
        $kodepos = $request->input('kodepos');

        $alamat = kdpos::where('postal', $kodepos)->first();

        if ($alamat) {
            return response()->json([
                'provinsi' => $alamat->province,
                'kota' => $alamat->city,
                'kecamatan' => $alamat->district,
                'desa' => $alamat->village,
            ]);
        } else {
            return response()->json(['error' => 'Alamat tidak ditemukan'], 404);
        }
    }

    public function getVillage(Request $request)
    {
        $kodepos = $request->input('kodepos');

        $alamat = kdpos::where('postal', $kodepos)->get();

        if ($alamat->isNotEmpty()) {
            return response()->json($alamat);
        } else {
            return response()->json(['error' => 'Alamat tidak ditemukan'], 404);
        }
    }


}
