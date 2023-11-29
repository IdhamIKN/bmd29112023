<?php

namespace App\Http\Controllers\Kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\organisasi_user;

class KantorController extends Controller
{
    public function index()
    {
        // $userId = auth()->user()->id;
        // $userPend = organisasi_user::where('id_user', $userId)->get();
        // $jabatanOptions = config('options.jabatan');
        // return view('user/account-organisasi', compact('userPend', 'userId', 'jabatanOptions' ));
        return view('kantor/index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'organisasi' => 'required|string',
            'th1' => 'required|string',
            'th2' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        organisasi_user::create($validatedData);

        return redirect()->route('account-organisasi')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = organisasi_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-organisasi')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'organisasi' => 'required|string',
            'th1' => 'required|string',
            'th2' => 'required|string',
            'jabatan' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-organisasi')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = organisasi_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-organisasi')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-organisasi')->with('success', 'Data Anda berhasil dihapus');
    }
}
