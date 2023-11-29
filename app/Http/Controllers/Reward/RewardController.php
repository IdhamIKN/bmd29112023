<?php

namespace App\Http\Controllers\Reward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\organisasi_user;
use App\Models\info_user;
use App\Models\reward;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RewardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:reward-index|reward-create|reward-edit|reward-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:reward-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:reward-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:reward-delete', ['only' => ['destroy']]);
        $this->middleware('permission:reward-search', ['only' => ['search']]);
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->hasAnyPermission(['reward-index', 'reward-create', 'reward-edit', 'reward-delete'])) {
                return redirect()->route('error-page');
            }
            return $next($request);
        });
    }

    // public function index()
    // {
    //     $user = auth()->user();

    //     if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
    //         $reward = Reward::all();
    //     } else {
    //         $infoUser = info_user::where('id_user', $user->id)->first();
    //         if ($infoUser) {
    //             $reward = reward::where('karyawan', $infoUser->id)->get();
    //         } else {
    //             $reward = collect();
    //         }
    //     }
    //     $calculateReward = $this->calculateReward();
    //     $user = info_user::all();
    //     $getuser = user::all();
    //     $userMap = $user->keyBy('id');
    //     $userget = $getuser->keyBy('id');
    //     return view('reward/index', compact('reward', 'calculateReward', 'user', 'userget', 'userMap'));
    // }
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = (int) $request->session()->get('per_page', 10);

        if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin')) {
            $reward = Reward::orderBy('id', 'desc')->paginate($perPage);
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $reward = reward::where('karyawan', $infoUser->id)->orderBy('id', 'desc')->paginate($perPage);
            } else {
                $reward = collect();
            }
        }

        $calculateReward = $this->calculateReward();
        $user = info_user::all();
        $getuser = user::all();
        $userMap = $user->keyBy('id');
        $userget = $getuser->keyBy('id');
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');

        return view('reward/index', compact('reward', 'userfoto', 'divisiOptions', 'jkOptions',  'calculateReward', 'user', 'userget', 'userMap', 'perPage'));
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
            $reward = Reward::whereIn('karyawan', $userIds)->orderBy('id')->paginate($perPage);
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $reward = reward::where('karyawan', $infoUser->id)
                ->whereBetween('tanggal', [$startDate, $endDate])->orderBy('id')->paginate($perPage);
            } else {
                $reward = collect();
            }
        }

        $calculateReward = $this->calculateReward();
        $user = info_user::all();
        $getuser = user::all();
        $userMap = $user->keyBy('id');
        $userget = $getuser->keyBy('id');

        return view('reward/index', compact('reward', 'calculateReward', 'user', 'userget', 'userMap', 'perPage'));
    }



    public function updateItemsPerPage(Request $request)
    {
        $perPage = $request->input('per_page');
        $request->session()->put('per_page', $perPage);
        \Log::info('Updated per_page in session: ' . $perPage);
        return response()->json(['status' => 'success']);
    }

    public function calculateReward()
    {
        $user = auth()->user();
        $totalReward = 0;

        if ($user->hasRole('superadmin') || $user->hasRole('admin')) {
            $totalReward = (string) reward::count();
        } else {
            $infoUser = info_user::where('id_user', $user->id)->first();
            if ($infoUser) {
                $totalReward = (string) reward::where('karyawan', $infoUser->id)->count();
            }
        }

        return response()->json(['totalReward' => $totalReward]);
    }

    public function create()
    {
        $user = info_user::all();
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('reward/create', compact('user','userfoto', 'userPerson'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pemberi' => 'numeric',
            'tanggal' => 'required|date',
            'reward' => 'required|string',
            'karyawan' => 'required|array',
            'ket' => 'required|string',
        ]);

        $karyawanIds = $validatedData['karyawan'];

        foreach ($karyawanIds as $karyawanId) {

            Reward::create([
                'pemberi' => $validatedData['pemberi'],
                'tanggal' => $validatedData['tanggal'],
                'reward' => $validatedData['reward'],
                'karyawan' => $karyawanId,
                'ket' => $validatedData['ket'],
            ]);
        }

        return redirect()->route('reward-create')->with('success', 'Data Reward berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $userPend = reward::find($id);

        if (!$userPend) {
            return redirect()->route('reward-index')->with('error', 'Data tidak ditemukan.');
        }

        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'reward' => 'required|string',
            'ket' => 'required|string',
        ]);

        $userPend->update($validatedData);

        return redirect()->route('reward-index')->with('success', 'Data Anda berhasil diperbarui');
    }

    public function delete($id)
    {
        $userPend = reward::find($id);

        if (!$userPend) {
            return redirect()->route('reward-index')->with('error', 'Data tidak ditemukan.');
        }

        $userPend->delete();

        return redirect()->route('reward-index')->with('success', 'Data Anda berhasil dihapus');
    }
}
