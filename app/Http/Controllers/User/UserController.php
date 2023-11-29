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
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;
use Spatie\Permission\Models\Role;
use Elibyy\TCPDF\TCPDF;




class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-index|user-create|user-edit|user-delete', ['only' => ['index', 'profile']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

        $this->middleware('permission:password-index|password-create|password-edit|password-delete', ['only' => ['changepassword']]);
        $this->middleware('permission:password-edit', ['only' => ['updatepassword']]);
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);

        $user = User::with('roles')->orderBy('id')->paginate($perPage);
        $jkOptions = config('options.jk');
        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();

        $roles = Role::pluck('name', 'id');
        $role = Role::all();
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('user/user', compact('user','userfoto', 'jkOptions', 'totalReward', 'perPage', 'role', 'roles'));
    }

    public function search(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $query = $request->input('query');
        $user = user::where('name', 'LIKE', "%{$query}%")->paginate($perPage);
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');
        return view('user/user', compact('user', 'divisiOptions', 'jkOptions', 'perPage'));
    }

    public function ItemsPerPage(Request $request)
    {
        $perPage = $request->input('per_page');
        $request->session()->put('per_page', $perPage);
        \Log::info('Updated per_page in session: ' . $perPage);
        return response()->json(['status' => 'success']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // validasi request
        $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'roles' => 'required',
        ]);

        // update data pengguna
        $user->name = $request->name;
        $user->nohp = $request->nohp;
        $user->save();

        // update peran pengguna
        $user->syncRoles($request->roles);

        return redirect()->route('getuser')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('getuser')->with('success', 'Data User berhasil dihapus');
    }

    public function profile()
    {
        // $userPerson = info_user::first();
        $userId = auth()->user()->id;
        // $userPerson = info_user::where('id_user', $userId)->get();
        $userPerson = info_user::where('id_user', $userId)->first();
        $useralamat = alamat_user::where('id_user', $userId)->get();
        $userPend = pendidikan_user::where('id_user', $userId)->get();
        $userPend = $userPend->sortBy('jenjang');
        $userPendFrm = pendnformal_user::where('id_user', $userId)->get();
        $userbahasa = bahasa_user::where('id_user', $userId)->get();
        $userorganisasi = organisasi_user::where('id_user', $userId)->get();
        $userkeluarga = keluarga_user::where('id_user', $userId)->get();
        $userkontak = kontak_user::where('id_user', $userId)->get();
        // dd($userId, $userPerson);
        // Option
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

        return view('user/profile', compact('userPerson', 'divisiOptions', 'totalPunishment', 'totalReward', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions', 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions', 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend', 'userPendFrm', 'jenjangOptions', 'statusOptions'));
    }

    public function changepassword()
    {
        $userId = auth()->user()->id;
        $userPerson = info_user::where('id_user', $userId)->first();
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');
        return view('user/changepassword', compact('userPerson', 'divisiOptions','jkOptions'));
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('profileuser')->with('success', 'Kata sandi berhasil diperbarui.');
        } else {
            // dd('Password lama salah');
            return back()->with('error', 'Kata sandi lama salah. Kata sandi tidak diperbarui.');
        }
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
        $view = \View::make('user.cetak.cetak', compact('userPerson', 'foto',
        'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
        'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
        'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
        'userPendFrm', 'jenjangOptions', 'statusOptions'))->render();
        $pdf = new \TCPDF();
        $pdf->SetTitle($pdfFileName);
        $pdf->AddPage();
        $pdf->writeHTML($view, true, false, true, false, '');
        $pdf->Output($pdfFileName);
        //         return view('user/cetak/cetak',compact('userPerson', 'foto',
        // 'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
        // 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
        // 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
        // 'userPendFrm', 'jenjangOptions', 'statusOptions'));
        // return $pdf->stream();


    }
    // public function cetakPengaduan($id)
    // {
    //     ini_set('max_execution_time', '300');
    //     $userId = User::find($id);
    //     $userPerson = info_user::where('id_user', $id)->get();

    //     $pdfFileName = Carbon::now()->format('Y_m_d_H_i_s') . '.pdf';
    //     $pdf = PDF::loadView('user.cetak.cetak1', compact('userId', 'userPerson', ));

    //     return $pdf->download($pdfFileName);
    // }

    // public function cetakPengaduan($id)
    // {
    //     ini_set('max_execution_time', '300');
    //     $userId = User::find($id);
    //     $userPerson = info_user::where('id_user', $id)->get();
    //     $foto = info_user::where('id_user', $id)->get();
    //     $useralamat = alamat_user::where('id_user', $id)->get();
    //     $userPend = pendidikan_user::where('id_user', $id)->get();
    //     $userPendFrm = pendnformal_user::where('id_user', $id)->get();
    //     $userbahasa = bahasa_user::where('id_user', $id)->get();
    //     $userorganisasi = organisasi_user::where('id_user', $id)->get();
    //     $userkeluarga = keluarga_user::where('id_user', $id)->get();
    //     $userkontak = kontak_user::where('id_user', $id)->get();

    //     $jenjangOptions = config('options.jenjang');
    //     $statusOptions = config('options.status');
    //     $agamaOptions = config('options.agama');
    //     $kawinOptions = config('options.kawin');
    //     $goldarOptions = config('options.goldar');
    //     $jenisOptions = config('options.jenis');
    //     $jkOptions = config('options.jk');
    //     $tingkatOptions = config('options.tingkat');
    //     $hubOptions = config('options.hub');
    //     $jobOptions = config('options.job');
    //     $jabatanOptions = config('options.jabatan');
    //     $divisiOptions = config('options.divisi');

    //     // $pdfFileName = Carbon::now()->format('mdHis') . '.pdf';
    //     $pdfFileName = uniqid() . '.pdf';
    //     // $pdf = PDF::loadView('user.cetak.cetak', compact('userPerson', 'foto',
    //     // 'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
    //     // 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
    //     // 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
    //     // 'userPendFrm', 'jenjangOptions', 'statusOptions'))->setOptions(['defaultFont' => 'sans-serif']);
    //     // $pdf = PDF::loadView('user.cetak.cetak', compact('userPerson', 'foto',
    //     // 'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
    //     // 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
    //     // 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
    //     // 'userPendFrm', 'jenjangOptions', 'statusOptions'))->setOptions(['defaultFont' => 'sans-serif']);
    //     // return $pdf->download($pdfFileName);

    //     $view = \View::make('user.cetak.cetak', compact('userPerson', 'foto',
    //     'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
    //     'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
    //     'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
    //     'userPendFrm', 'jenjangOptions', 'statusOptions'))->render();
    //     $pdf = new \TCPDF();
    //     $pdf->SetTitle($pdfFileName);
    //     $pdf->AddPage();
    //     $pdf->writeHTML($view, true, false, true, false, '');
    //     $pdf->Output('filename.pdf');
    //     // return view('user/cetak/cetak',compact('userPerson', 'foto',
    //     // 'divisiOptions', 'jabatanOptions', 'userkontak', 'jobOptions', 'hubOptions',
    //     // 'userkeluarga', 'userorganisasi', 'tingkatOptions', 'jkOptions', 'jenisOptions',
    //     // 'goldarOptions', 'kawinOptions', 'agamaOptions', 'userbahasa', 'useralamat', 'userPend',
    //     // 'userPendFrm', 'jenjangOptions', 'statusOptions'));
    //     // return $pdf->stream();

    // }



}
