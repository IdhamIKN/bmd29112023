<?php

namespace App\Http\Controllers\Punishment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\organisasi_user;
use App\Models\info_user;
use App\Models\punishment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PunishmentController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:punishment-index|punishment-create|punishment-edit|punishment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:punishment-create', ['only' => ['create','store']]);
         $this->middleware('permission:punishment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:punishment-delete', ['only' => ['destroy']]);
    }
    // public function index()
    // {
    //     $userId = auth()->user()->id;
    //     $userInfo = info_user::where('id_user', $userId)->first();
    //     // if (Auth::user()->hasRole(['superadmin', 'admin'])) {
    //     //     $punishment = punishment::all();
    //     // } else {
    //     //     $punishment = punishment::where('karyawan', $userInfo->id)->get();
    //     // } else {
    //     //     $reward = null; // Set $reward menjadi null jika $userInfo null
    //     // }
    //     if ($userInfo) { // Memeriksa apakah $userInfo tidak null
    //         $punishment = punishment::where('karyawan', $userInfo->id)->get();
    //     } else {
    //         $punishment = null; // Set $reward menjadi null jika $userInfo null
    //     }

    //     $user = info_user::all();
    //     $getuser = user::all();

    //     $userMap = $user->keyBy('id');
    //     $userget = $getuser->keyBy('id');

    //     return view('punishment/index', compact('punishment', 'user', 'userget', 'userMap'));
    // }
    // public function index()
    // {
    //     $user = auth()->user();

    //     if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
    //         $punishment = punishment::all();
    //     } else {
    //         $infoUser = info_user::where('id_user', $user->id)->first();
    //         if ($infoUser) {
    //             $punishment = punishment::where('karyawan', $infoUser->id)->get();
    //         } else {
    //             $punishment = collect();
    //         }
    //     }
    //     $calculatePunishment = $this->calculatePunishment();
    //     $user = info_user::all();
    //     $getuser = user::all();
    //     $userMap = $user->keyBy('id');
    //     $userget = $getuser->keyBy('id');
    //     return view('punishment/index', compact('punishment', 'calculatePunishment', 'user', 'userget', 'userMap'));
    // }

    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = (int) $request->session()->get('per_page', 10);

        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            $punishment = punishment::orderBy('id', 'desc')->paginate($perPage);
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $punishment = punishment::where('karyawan', $infoUser->id)->orderBy('id', 'desc')->paginate($perPage);
            } else {
                $punishment = collect();
            }
        }

        $calculatePunishment = $this->calculatePunishment();
        $user = info_user::all();
        $getuser = user::all();
        $userMap = $user->keyBy('id');
        $userget = $getuser->keyBy('id');
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();

        return view('punishment/index', compact('punishment','userfoto', 'calculatePunishment', 'user', 'userget', 'userMap', 'perPage'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $user = auth()->user();
        $perPage = (int) $request->session()->get('per_page', 10);

        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            $userIds = info_user::where('name', 'LIKE', "%{$search}%")->pluck('id');
            $punishment = punishment::whereIn('karyawan', $userIds)->orderBy('id')->paginate($perPage);
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $punishment = punishment::where('karyawan', $infoUser->id)
                ->whereBetween('tanggal', [$startDate, $endDate])->orderBy('id')->paginate($perPage);
            } else {
                $punishment = collect();
            }
        }

        $calculatePunishment = $this->calculatePunishment();
        $user = info_user::all();
        $getuser = user::all();
        $userMap = $user->keyBy('id');
        $userget = $getuser->keyBy('id');

        return view('punishment/index', compact('punishment', 'calculatePunishment', 'user', 'userget', 'userMap', 'perPage'));
    }

    public function updateItemsPerPage(Request $request)
    {
        $perPage = $request->input('per_page');
        $request->session()->put('per_page', $perPage);
        \Log::info('Updated per_page in session: ' . $perPage);
        return response()->json(['status' => 'success']);
    }

    public function calculatePunishment()
    {
        $user = auth()->user();
        $totalPunishment = 0;

        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            $totalPunishment = (string) punishment::count();
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $totalPunishment = (string) punishment::where('karyawan', $infoUser->id)->count();
            }
        }

        return response()->json(['totalPunishment' => $totalPunishment]);
    }

    public function create()
    {
        $user = info_user::all();
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
                $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('punishment/create', compact('user','userfoto', 'userPerson'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pemberi' => 'numeric',
            'tanggal' => 'required|date',
            'punishment' => 'required|string',
            'karyawan' => 'required|array',
            'ket' => 'required|string',
        ]);

        $karyawanIds = $validatedData['karyawan'];

        foreach ($karyawanIds as $karyawanId) {

            punishment::create([
                'pemberi' => $validatedData['pemberi'],
                'tanggal' => $validatedData['tanggal'],
                'punishment' => $validatedData['punishment'],
                'karyawan' => $karyawanId,
                'ket' => $validatedData['ket'],
            ]);
        }

        return redirect()->route('punishment-create')->with('success', 'Data Punishment berhasil disimpan');
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
