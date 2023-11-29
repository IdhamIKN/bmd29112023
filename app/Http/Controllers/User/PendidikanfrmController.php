<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Laravolt\Indonesia\Models\Extended\Provinsi;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\alamat_user;
use App\Models\bahasa_user;
use App\Models\pendidikan_user;
use App\Models\pendnformal_user;
use App\Models\keluarga_user;
use App\Models\organisasi_user;
use App\Models\kontak_user;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class PendidikanfrmController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:pendidikanfrm-index|pendidikanfrm-create|pendidikanfrm-edit|pendidikanfrm-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pendidikanfrm-create', ['only' => ['create','store']]);
         $this->middleware('permission:pendidikanfrm-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pendidikanfrm-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $userPend = pendnformal_user::where('id_user', $userId)->get();
        $statusOptions = config('options.status');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();
        return view('user/account-pendidikanfrm', compact('userPend', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'statusOptions' ));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'lembaga' => 'required|string',
            'kota' => 'required|string',
            'mulai' => 'required|string',
            'selesai' => 'required|string',
            'sertif' => 'required|string',
            'status' => 'required|string',
        ]);

        pendnformal_user::create($validatedData);

        return redirect()->route('account-pendidikanfrm')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = pendnformal_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-pendidikanfrm')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'lembaga' => 'required|string',
            'kota' => 'required|string',
            'mulai' => 'required|string',
            'selesai' => 'required|string',
            'sertif' => 'required|string',
            'status' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-pendidikanfrm')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = pendnformal_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-pendidikanfrm')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-pendidikanfrm')->with('success', 'Data Anda berhasil dihapus');
    }
}
