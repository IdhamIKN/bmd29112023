<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\info_user;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:dashboard-index|dashboard-create|dashboard-edit|dashboard-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:dashboard-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dashboard-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dashboard-delete', ['only' => ['destroy']]);
    }
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $user = auth()->user();
    //     $userPerson = info_user::all();
    //     $userId = User::all();

    //     if (auth()->user()->hasRole('superadmin')) {
    //         return view('dashboard/dashboardSUAdmin', compact('userPerson', 'userId'));
    //     } elseif (auth()->user()->hasRole('admin')) {
    //         return view('pages/dashboard-overview-1');
    //     } elseif (auth()->user()->hasRole('user')) {
    //         return view('pages/dashboard-overview-1');
    //     } else {
    //         return view('error-page');
    //     }
    // }
    public function index()
    {
        $user = auth()->user();
        $userPerson = info_user::all();
        $userId = User::all();

        $ageData = $userPerson->map(function ($person) {
            return Carbon::parse($person->ttl)->age;
        });

        $ageRange17_30 = $ageData->filter(function ($age) {
            return $age >= 17 && $age <= 30;
        })->count();

        $ageRange31_50 = $ageData->filter(function ($age) {
            return $age >= 31 && $age <= 50;
        })->count();

        $ageRangeAbove50 = $ageData->filter(function ($age) {
            return $age >= 50;
        })->count();

        // Menghitung total data
        $totalData = $userPerson->count();
        $genderCounts = $this->countGender(); // Mengambil hasil dalam bentuk array
        dd($genderCounts);
        if ($user->hasRole('superadmin')) {
            return view('dashboard/dashboardSUAdmin', compact('userPerson', 'genderCounts', 'userId', 'totalData', 'ageRange17_30', 'ageRange31_50', 'ageRangeAbove50'));
        } elseif ($user->hasRole('admin') || $user->hasRole('user')) {
            return view('pages/dashboard-overview-1');
        } else {
            return view('error-page');
        }
    }

    public function countGender()
    {
        // Menghitung jumlah karyawan laki-laki (jk = 1)
        $countMale = info_user::where('jk', 1)->count();

        // Menghitung jumlah karyawan perempuan (jk = 2)
        $countFemale = info_user::where('jk', 2)->count();

        return ['male' => $countMale, 'female' => $countFemale];
    }





    public function hitungUmur()
    {
        $userPerson = info_user::all();
        $umur17_30 = 0;
        $umur31_50 = 0;
        $umur50_plus = 0;

        foreach ($userPerson as $user) {
            $umur = Carbon::parse($user->ttl)->age;
            if ($umur >= 17 && $umur <= 30) {
                $umur17_30++;
            } elseif ($umur > 30 && $umur <= 50) {
                $umur31_50++;
            } else {
                $umur50_plus++;
            }
        }

        $total = $umur17_30 + $umur31_50 + $umur50_plus;
        return [
            '17-30' => $umur17_30 / $total * 100,
            '31-50' => $umur31_50 / $total * 100,
            '50+' => $umur50_plus / $total * 100,
        ];
    }
}
