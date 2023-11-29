<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

use App\Models\keluarga_user;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;

class KeluargaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:keluarga-index|keluarga-create|keluarga-edit|keluarga-delete', ['only' => ['index','show', 'account_kontak']]);
         $this->middleware('permission:keluarga-create', ['only' => ['create','store']]);
         $this->middleware('permission:keluarga-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:keluarga-delete', ['only' => ['destroy']]);
    }

    public function account_kontak()
    {
        $provinces = Province::get();
        $city = City::get();
        $district = District::get();
        $village = Village::get();
        // dd($provinces);
        return view('user/account-kontak', compact('provinces', 'city', 'district', 'village'));
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $userPend = keluarga_user::where('id_user', $userId)->get();
        $jenjangOptions = config('options.jenjang');
        $hubOptions = config('options.hub');
        $jobOptions = config('options.job');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();
        return view('user/account-keluarga', compact('userId', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userPerson', 'jobOptions', 'userPend', 'jenjangOptions', 'hubOptions'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'status' => 'required|numeric',
            'nama' => 'required|string',
            'telp' => 'required|string',
            'ttl' => 'required|string',
            'tl' => 'required|string',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);
        keluarga_user::create($validatedData);

        return redirect()->route('account-keluarga')->with('success', 'Data Anda berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend =  keluarga_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-keluarga')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'status' => 'required|numeric',
            'nama' => 'required|string',
            'telp' => 'required|string',
            'ttl' => 'required|string',
            'tl' => 'required|string',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('account-keluarga')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend =  keluarga_user::find($id);

        if (!$userPend) {
            return redirect()->route('account-keluarga')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('account-keluarga')->with('success', 'Data Anda berhasil dihapus');
    }

}
