<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\bahasa_user;
use App\Models\languages;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class BahasaUserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:bahasa-index|bahasa-create|bahasa-edit|bahasa-delete', ['only' => ['index','show']]);
         $this->middleware('permission:bahasa-create', ['only' => ['create','store']]);
         $this->middleware('permission:bahasa-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bahasa-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $languages = languages::all();
        $userPend = bahasa_user::where('id_user', $userId)->get();
        $tingkatOptions = config('options.tingkat');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();

        return view('user/account-bahasa', compact('languages', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'userPend', 'userId', 'tingkatOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'bahasa' => 'required|string',
            'lisan' => 'required|string',
            'tulisan' => 'required|string',
        ]);

        bahasa_user::create($validatedData);

        return redirect()->route('account-bahasa')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = bahasa_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-bahasa')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'bahasa' => 'required|string',
            'lisan' => 'required|string',
            'tulisan' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-bahasa')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = bahasa_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-bahasa')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-bahasa')->with('success', 'Data Anda berhasil dihapus');
    }

}
