<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\organisasi_user;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class OrganisasiController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:organisasi-index|organisasi-create|organisasi-edit|organisasi-delete', ['only' => ['index','show']]);
         $this->middleware('permission:organisasi-create', ['only' => ['create','store']]);
         $this->middleware('permission:organisasi-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:organisasi-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $userPend = organisasi_user::where('id_user', $userId)->get();
        $jabatanOptions = config('options.jabatan');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');
        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();

        return view('user/account-organisasi', compact('userPend', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'userId', 'jabatanOptions' ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'organisasi' => 'required|string',
            // 'th1' => 'required|string',
            // 'th2' => 'required|string',
            // 'jabatan' => 'required|string',
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
            // 'th1' => 'required|string',
            // 'th2' => 'required|string',
            // 'jabatan' => 'required|string',
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
