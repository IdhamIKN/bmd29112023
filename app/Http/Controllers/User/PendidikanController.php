<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\pendidikan_user;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class PendidikanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pendidikan-index|pendidikan-create|pendidikan-edit|pendidikan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pendidikan-create', ['only' => ['create','store']]);
         $this->middleware('permission:pendidikan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pendidikan-delete', ['only' => ['destroy']]);
    }
    // public function index()
    // {
    //     $userId = auth()->user()->id;
    //     $userPend = pendidikan_user::where('id_user', $userId)->get();
    //     $jenjangOptions = config('options.jenjang');
    //     $statusOptions = config('options.status');
    //     return view('user/account-pendidikan', compact('userPend', 'jenjangOptions', 'statusOptions' ));
    // }
    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();

        $userPend = pendidikan_user::where('id_user', $userId)->get();
        $userPend = $userPend->sortBy('jenjang');

        $jenjangOptions = config('options.jenjang');
        $statusOptions = config('options.status');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();

        return view('user/account-pendidikan', compact('userPend', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'jenjangOptions', 'statusOptions'));
    }


    public function store(Request $request)
    {
        $userPend = pendidikan_user::first();
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'jenjang' => 'required|string',
            'sekolah' => 'required|string',
            'jurusan' => 'nullable|string',
            'kota' => 'required|string',
            'mulai' => 'required|string',
            'selesai' => 'required|string',
            'status' => 'required|string',
            'ipk' => 'required|string',
        ]);


        pendidikan_user::create($validatedData);

        return redirect()->route('account-pendidikan')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = pendidikan_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-pendidikan')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'jenjang' => 'required|string',
            'sekolah' => 'required|string',
            'jurusan' => 'nullable|string',
            'kota' => 'required|string',
            'mulai' => 'required|string',
            'selesai' => 'required|string',
            'status' => 'required|string',
            'ipk' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-pendidikan')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = pendidikan_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-pendidikan')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-pendidikan')->with('success', 'Data Anda berhasil dihapus');
    }

}
