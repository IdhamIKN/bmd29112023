<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\alamat_user;
use App\Models\kdpos;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\info_user;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;


class AlamatController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:alamat-index|alamat-create|alamat-edit|alamat-delete', ['only' => ['index','show']]);
         $this->middleware('permission:alamat-create', ['only' => ['create','store']]);
         $this->middleware('permission:alamat-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:alamat-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $jawaTimurProvince = kdpos::where('province', 'Jawa Timur')->get();
        $provinces = Province::all();
        $city = Regency::all();
        $district = District::all();
        $village = Village::all();
        $alamat = kdpos::where('province', 'Jawa Timur')->get();
        $userId = auth()->user()->id;
        $userAddress = alamat_user::where('id_user', $userId)->first();
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();

        return view('user/account-alamat', compact('provinces', 'jkOptions', 'divisiOptions', 'totalReward', 'totalPunishment', 'userId', 'userPerson', 'alamat', 'city', 'district', 'village', 'userAddress'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'jenis' => 'required',
            'kodepos' => 'required|numeric',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $id_user = $validatedData['id_user'];

        $result = alamat_user::updateOrInsert(
            ['id_user' => $id_user],
            $validatedData
        );

        $message = $result ? 'Data berhasil disimpan!' : 'Gagal menyimpan atau memperbarui data!';

        return redirect()->route('account-alamat')->with('success', $message);
    }

}
