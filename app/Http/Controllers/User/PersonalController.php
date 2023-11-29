<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\info_user;
use App\Models\alamat_user;
use App\Models\pendidikan_user;
use App\Models\pendnformal_user;
use App\Models\bahasa_user;
use App\Models\keluarga_user;
use App\Models\organisasi_user;
use App\Models\kontak_user;
use App\Models\kdpos;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;


class PersonalController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:personal-index|personal-create|personal-edit|personal-delete', ['only' => ['index','show']]);
         $this->middleware('permission:personal-create', ['only' => ['create','store']]);
         $this->middleware('permission:personal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:personal-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');
        $jkOptions = config('options.jk');
        // dd($userId, $userPerson);
        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();
        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();
        return view('user/account-personal', compact('userPerson', 'jkOptions', 'divisiOptions', 'jkOptions', 'totalReward', 'totalPunishment',));
    }

    public function store(Request $request)
    {
        $id_user = Auth::id();
        $validatedData = $request->validate([
            'nik' => 'required|numeric',
            'name' => 'required|string',
            'ktp' => 'required|numeric',
            'divisi' => 'required|string',
            'penempatan' => 'required|string',
            'tl' => 'required|string',
            'jk' => 'required|string',
            'warga' => 'required|string',
            'goldar' => 'required|string',
            'ttl' => 'required|date|nullable',
            'agama' => 'required|string',
            'stper' => 'required|string',
            'foto' => 'image|nullable',
        ]);

        $photoPath = null;

        if ($request->hasFile('foto')) {
            $photoFile = $request->file('foto');

            $fileName = $validatedData['nik'] . '.' . $photoFile->getClientOriginalExtension();

            $disk = 'public';
            $photoPath = 'photos/' . $fileName;
            Storage::disk($disk)->put($photoPath, file_get_contents($photoFile));

            if (Storage::disk($disk)->size($photoPath) > 1024 * 1024) {
                $compressedPhoto = Image::make(Storage::disk($disk)->path($photoPath))
                    ->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('jpg', 80);

                Storage::disk($disk)->put($photoPath, $compressedPhoto);
            }
        }

        if ($photoPath) {
            $validatedData['foto'] = $photoPath;
        }

        info_user::updateOrInsert(['id_user' => $id_user], $validatedData);

        return redirect()->route('account')->with('success', 'Data Anda berhasil disimpan');
    }

}
