<?php

namespace App\Http\Controllers\Karyawan;

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
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;
use Illuminate\Pagination\CursorPaginator;

class KaryawanController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:karyawan-index|karyawan-create|karyawan-edit|karyawan-delete', ['only' => ['index']]);
         $this->middleware('permission:karyawan-show', ['only' => ['show']]);
         $this->middleware('permission:karyawan-create', ['only' => ['create','store']]);
         $this->middleware('permission:karyawan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:karyawan-delete', ['only' => ['destroy']]);
    }
    // public function index()
    // {
    //     // $user = info_user::all();
    //     // $user = info_user::orderBy('id')->cursorPaginate(3);
    //     $user = info_user::orderBy('id')->paginate(3);

    //     // $user = info_user::paginate(3);
    //     $jkOptions = config('options.jk');
    //     $divisiOptions = config('options.divisi');
    //     return view('karyawan/index', compact('user', 'divisiOptions', 'jkOptions'));
    // }
    // public function index(Request $request)
    // {
    //     $perPage = $request->query('per_page', 3);
    //     $user = info_user::orderBy('id')->paginate($perPage);
    //     $jkOptions = config('options.jk');
    //     $divisiOptions = config('options.divisi');
    //     return view('karyawan/index', compact('user', 'divisiOptions', 'jkOptions'));
    // }
    public function index(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $user = info_user::orderBy('id')->paginate($perPage);
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('karyawan/index', compact('user', 'userfoto', 'divisiOptions', 'jkOptions', 'perPage'));
    }


    public function search(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $query = $request->input('query');
        $permissions = Permission::whereHas('roles', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })->paginate($perPage);
    
        return view('permission.index', compact('permissions', 'perPage'));
    }
    
    public function updateItemsPerPage(Request $request)
    {
        $perPage = $request->input('per_page');
        $request->session()->put('per_page', $perPage);
        \Log::info('Updated per_page in session: ' . $perPage);
        return response()->json(['status' => 'success']);
    }
    


    public function show($id)
    {
        $userId = User::find($id);
        $userPerson = info_user::where('id_user', $id)->get();
        $useralamat = alamat_user::where('id_user', $id)->get();
        $userPend = pendidikan_user::where('id_user', $id)->get();
        $userPendFrm = pendnformal_user::where('id_user', $id)->get();
        $userbahasa = bahasa_user::where('id_user', $id)->get();
        $userorganisasi = organisasi_user::where('id_user', $id)->get();
        $userkeluarga = keluarga_user::where('id_user', $id)->get();
        $userkontak = kontak_user::where('id_user', $id)->get();

        $jenjangOptions = config('options.jenjang');
        $statusOptions = config('options.status');
        $agamaOptions = config('options.agama');
        $kawinOptions = config('options.kawin');
        $goldarOptions = config('options.goldar');
        $jenisOptions = config('options.jenis');
        $jkOptions = config('options.jk');
        $tingkatOptions = config('options.tingkat');
        $hubOptions = config('options.hub');
        $jobOptions = config('options.job');
        $jabatanOptions = config('options.jabatan');
        $divisiOptions = config('options.divisi');

        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();

        return view('karyawan/show', compact('userPerson','userfoto', 'divisiOptions', 'totalPunishment', 'totalReward', 'userId', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions', 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions', 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend', 'userPendFrm', 'jenjangOptions', 'statusOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'numeric',
            'organisasi' => 'required|string',
            'th1' => 'required|string',
            'th2' => 'required|string',
            'jabatan' => 'required|string',
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

    public function cetakPengaduan($id)
    {
        ini_set('max_execution_time', '300');
        $userId = User::find($id);
        $userPerson = info_user::where('id_user', $id)->get();
        $foto = info_user::where('id_user', $id)->get();
        $useralamat = alamat_user::where('id_user', $id)->get();
        $userPend = pendidikan_user::where('id_user', $id)->get();
        $userPendFrm = pendnformal_user::where('id_user', $id)->get();
        $userbahasa = bahasa_user::where('id_user', $id)->get();
        $userorganisasi = organisasi_user::where('id_user', $id)->get();
        $userkeluarga = keluarga_user::where('id_user', $id)->get();
        $userkontak = kontak_user::where('id_user', $id)->get();

        $jenjangOptions = config('options.jenjang');
        $statusOptions = config('options.status');
        $agamaOptions = config('options.agama');
        $kawinOptions = config('options.kawin');
        $goldarOptions = config('options.goldar');
        $jenisOptions = config('options.jenis');
        $jkOptions = config('options.jk');
        $tingkatOptions = config('options.tingkat');
        $hubOptions = config('options.hub');
        $jobOptions = config('options.job');
        $jabatanOptions = config('options.jabatan');
        $divisiOptions = config('options.divisi');

        // $pdfFileName = Carbon::now()->format('mdHis') . '.pdf';
        $pdfFileName = uniqid() . '.pdf';
        $pdf = PDF::loadView('user.cetak.cetak', compact('userPerson', 'foto', 'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions', 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions', 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend', 'userPendFrm', 'jenjangOptions', 'statusOptions'));
        // return $pdf->download($pdfFileName);
        return $pdf->stream();

    }


}
