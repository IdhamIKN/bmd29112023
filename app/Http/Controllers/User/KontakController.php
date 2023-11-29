<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\kontak_user;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class KontakController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:kontak-index|kontak-create|kontak-edit|kontak-delete', ['only' => ['index','show']]);
         $this->middleware('permission:kontak-create', ['only' => ['create','store']]);
         $this->middleware('permission:kontak-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kontak-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $userId = auth()->user()->id;
        $userPend = kontak_user::where('id_user', $userId)->get();
        $hubOptions = config('options.hub');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();
        return view('user/account-kontak', compact('userPend', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'hubOptions'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'nama' => 'required|string',
            'hubungan' => 'required|string',
            'alamat' => 'required|string',
            'telp' => 'required|string',
        ]);

        kontak_user::create($validatedData);

        return redirect()->route('account-kontak')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = kontak_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-kontak')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'nama' => 'required|string',
            'hubungan' => 'required|string',
            'alamat' => 'required|string',
            'telp' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-kontak')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = kontak_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-kontak')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-kontak')->with('success', 'Data Anda berhasil dihapus');
    }

}
