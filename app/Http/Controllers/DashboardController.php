<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\info_user;
use App\Models\User;
use App\Models\pendidikan_user;
use Illuminate\Support\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;
use Illuminate\Http\Request;

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
        $userPend = pendidikan_user::all();

        $ageData = [];
        foreach ($userPerson as $person) {
            $birthdate = Carbon::parse($person->ttl);
            $age = $birthdate->age;
            $ageData[] = $age;
        }

        $ageRange17_30 = collect($ageData)->filter(function ($age) {
            return $age >= 20 && $age <= 30;
        })->count();

        $ageRange31_50 = collect($ageData)->filter(function ($age) {
            return $age >= 31 && $age <= 50;
        })->count();

        $ageRangeAbove50 = collect($ageData)->filter(function ($age) {
            return $age >= 50;
        })->count();

        $totalData = count($userPerson);
        $genderCounts = $this->countGender();
        // dd($genderCounts);
        $countAgeCategories = $this->countAgeCategories();
        $educationStatistics = $this->calculateHighestEducationStatistics();
        $rewardController = new RewardController();
        $totalReward = $rewardController->calculateReward();
        $punishmentController = new PunishmentController();
        $totalPunishment = $punishmentController->calculatePunishment();

        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        if (auth()->user()->hasRole('superadmin')) {
            return view('dashboard/dashboardSUAdmin', compact(
                'userPerson',
                'totalPunishment',
                'totalReward',
                'educationStatistics',
                'userPend',
                'countAgeCategories',
                'genderCounts',
                'userId',
                'totalData',
                'ageRange17_30',
                'ageRange31_50',
                'ageRangeAbove50',
                'userfoto'
            ));
        } elseif (auth()->user()->hasRole('admin')) {
            return view('dashboard/dashboardSUAdmin', compact(
                'userPerson',
                'totalPunishment',
                'totalReward',
                'educationStatistics',
                'userPend',
                'countAgeCategories',
                'genderCounts',
                'userId',
                'totalData',
                'ageRange17_30',
                'ageRange31_50',
                'ageRangeAbove50',
                'userfoto'
            ));
        } elseif (auth()->user()->hasRole('user')) {
            return view('dashboard/dashboardSUAdmin', compact(
                'userPerson',
                'totalPunishment',
                'totalReward',
                'educationStatistics',
                'userPend',
                'countAgeCategories',
                'genderCounts',
                'userId',
                'totalData',
                'ageRange17_30',
                'ageRange31_50',
                'ageRangeAbove50',
                'userfoto'
            ));
        } else {
            return view('pages/error-page');
        }
    }

    public function countAgeCategories()
    {
        $today = new DateTime();

        $ageRange17_30 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 17 AND 30")->count();
        $ageRange31_50 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 31 AND 50")->count();
        $ageRangeAbove50 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) > 50")->count();

        return [
            'ageRange17_30' => $ageRange17_30,
            'ageRange31_50' => $ageRange31_50,
            'ageRangeAbove50' => $ageRangeAbove50,
        ];
    }

    // public function countGender()
    // {
    //     // Menghitung jumlah karyawan laki-laki (jk = 1)
    //     $countMale = info_user::where('jk', 1)->count();

    //     // Menghitung jumlah karyawan perempuan (jk = 2)
    //     $countFemale = info_user::where('jk', 2)->count();

    //     // Menghitung total karyawan
    //     $totalCount = $countMale + $countFemale;

    //     // Menghitung persentase laki-laki dan perempuan
    //     $malePercentage = ($countMale / $totalCount) * 100;
    //     $femalePercentage = ($countFemale / $totalCount) * 100;

    //     return ['male' => $countMale, 'female' => $countFemale, 'countmale' => $malePercentage, 'countfemale' => $femalePercentage];
    // }
    public function countGender()
    {
        // Menghitung jumlah karyawan laki-laki (jk = 1)
        $countMale = info_user::where('jk', 1)->count();
    
        // Menghitung jumlah karyawan perempuan (jk = 2)
        $countFemale = info_user::where('jk', 2)->count();
    
        // Menghitung total karyawan
        $totalCount = $countMale + $countFemale;
    
        // Menghitung persentase laki-laki dan perempuan
        if ($totalCount > 0) {
            $malePercentage = round(($countMale / $totalCount) * 100, 2);
            $femalePercentage = round(($countFemale / $totalCount) * 100, 2);
        } else {
            // Handle case when there is no data
            return ['male' => 0, 'female' => 0, 'countmale' => 0, 'countfemale' => 0];
        }
    
        return ['male' => $countMale, 'female' => $countFemale, 'countmale' => $malePercentage, 'countfemale' => $femalePercentage];
    }
    


    public function countGenderByAgeCategories()
    {
        $ageRange17_30 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 17 AND 30")->count();
        $ageRange31_50 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 31 AND 50")->count();
        $ageRangeAbove50 = info_user::whereRaw("YEAR(CURDATE()) - YEAR(ttl) > 50")->count();

        // Menghitung jumlah karyawan laki-laki (jk = 1) dan perempuan (jk = 2) dalam rentang usia 17-30
        $countMaleAgeRange17_30 = info_user::where('jk', 1)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 17 AND 30")
            ->count();

        $countFemaleAgeRange17_30 = info_user::where('jk', 2)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 17 AND 30")
            ->count();

        // Menghitung jumlah karyawan laki-laki (jk = 1) dan perempuan (jk = 2) dalam rentang usia 31-50
        $countMaleAgeRange31_50 = info_user::where('jk', 1)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 31 AND 50")
            ->count();

        $countFemaleAgeRange31_50 = info_user::where('jk', 2)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) BETWEEN 31 AND 50")
            ->count();

        // Menghitung jumlah karyawan laki-laki (jk = 1) dan perempuan (jk = 2) di atas usia 50
        $countMaleAgeRangeAbove50 = info_user::where('jk', 1)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) > 50")
            ->count();

        $countFemaleAgeRangeAbove50 = info_user::where('jk', 2)
            ->whereRaw("YEAR(CURDATE()) - YEAR(ttl) > 50")
            ->count();

        return [
            'ageRange17_30' => [
                'male' => $countMaleAgeRange17_30,
                'female' => $countFemaleAgeRange17_30,
            ],
            'ageRange31_50' => [
                'male' => $countMaleAgeRange31_50,
                'female' => $countFemaleAgeRange31_50,
            ],
            'ageRangeAbove50' => [
                'male' => $countMaleAgeRangeAbove50,
                'female' => $countFemaleAgeRangeAbove50,
            ],
        ];
    }

    // public function calculateHighestEducationStatistics()
    // {
    //     $users = user::has('pendidikan_user')->get();
    //     $educationStatistics = [
    //         'Group1' => 0,
    //         'Group2' => 0,
    //         'Group3' => 0,
    //     ];

    //     foreach ($users as $user) {
    //         $highestJenjang = $user->pendidikan_user->max('jenjang');

    //         if ($highestJenjang) {
    //             if ($highestJenjang >= 1 && $highestJenjang <= 3) {
    //                 $educationStatistics['Group1']++;
    //             } elseif ($highestJenjang >= 4 && $highestJenjang <= 6) {
    //                 $educationStatistics['Group2']++;
    //             } elseif ($highestJenjang >= 7 && $highestJenjang <= 8) {
    //                 $educationStatistics['Group3']++;
    //             }
    //         }
    //     }

    //     return $educationStatistics;
    // }
    // public function calculateHighestEducationStatistics()
    // {
    //     $users = User::has('pendidikan_user')->get();
    //     $educationStatistics = [
    //         'Group1' => 0,
    //         'Group2' => 0,
    //         'Group3' => 0,
    //     ];

    //     foreach ($users as $user) {
    //         $highestJenjang = $user->pendidikan_user->max('jenjang');

    //         if ($highestJenjang) {
    //             if ($highestJenjang >= 1 && $highestJenjang <= 3) {
    //                 $educationStatistics['Group1']++;
    //             } elseif ($highestJenjang >= 4 && $highestJenjang <= 7) {
    //                 $educationStatistics['Group2']++;
    //             } elseif ($highestJenjang >= 8 && $highestJenjang <= 9) {
    //                 $educationStatistics['Group3']++;
    //             }
    //         }
    //     }

    //     $totalCount = count($users);

    //     $percentageGroup1 = number_format(($educationStatistics['Group1'] / $totalCount) * 100, 2);
    //     $percentageGroup2 = number_format(($educationStatistics['Group2'] / $totalCount) * 100, 2);
    //     $percentageGroup3 = number_format(($educationStatistics['Group3'] / $totalCount) * 100, 2);

    //     return [
    //         'Group1' => $percentageGroup1,
    //         'Group2' => $percentageGroup2,
    //         'Group3' => $percentageGroup3,
    //     ];
    // }
    public function calculateHighestEducationStatistics()
    {
        $users = User::has('pendidikan_user')->get();

        // Cek apakah data pengguna kosong
        if (count($users) === 0) {
            return [
                'Group1' => 0.00,
                'Group2' => 0.00,
                'Group3' => 0.00,
            ];
        }

        $educationStatistics = [
            'Group1' => 0,
            'Group2' => 0,
            'Group3' => 0,
        ];

        foreach ($users as $user) {
            $highestJenjang = $user->pendidikan_user->max('jenjang');

            if ($highestJenjang) {
                if ($highestJenjang >= 1 && $highestJenjang <= 3) {
                    $educationStatistics['Group1']++;
                } elseif ($highestJenjang >= 4 && $highestJenjang <= 7) {
                    $educationStatistics['Group2']++;
                } elseif ($highestJenjang >= 8 && $highestJenjang <= 9) {
                    $educationStatistics['Group3']++;
                }
            }
        }

        $totalCount = count($users);

        $percentageGroup1 = number_format(($educationStatistics['Group1'] / $totalCount) * 100, 2);
        $percentageGroup2 = number_format(($educationStatistics['Group2'] / $totalCount) * 100, 2);
        $percentageGroup3 = number_format(($educationStatistics['Group3'] / $totalCount) * 100, 2);

        return [
            'Group1' => $percentageGroup1,
            'Group2' => $percentageGroup2,
            'Group3' => $percentageGroup3,
        ];
    }



    // public function hitungUmur()
    // {
    //     $userPerson = info_user::all();
    //     $umur17_30 = 0;
    //     $umur31_50 = 0;
    //     $umur50_plus = 0;

    //     foreach ($userPerson as $user) {
    //         $umur = Carbon::parse($user->ttl)->age;
    //         if ($umur >= 17 && $umur <= 30) {
    //             $umur17_30++;
    //         } elseif ($umur > 30 && $umur <= 50) {
    //             $umur31_50++;
    //         } else {
    //             $umur50_plus++;
    //         }
    //     }

    //     $total = $umur17_30 + $umur31_50 + $umur50_plus;
    //     return [
    //         '17-30' => $umur17_30 / $total * 100,
    //         '31-50' => $umur31_50 / $total * 100,
    //         '50+' => $umur50_plus / $total * 100,
    //     ];
    // }
    public function hitungUmur()
    {
        $userPerson = info_user::all();

        if ($userPerson->isEmpty()) {
            return [];
        }

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


    public function search(Request $request)
    {
        $query = $request->input('query');
        // Cari halaman berdasarkan query
        $pages = Page::where('title', 'LIKE', "%{$query}%")->get();
        return view('search-results', compact('pages'));
    }
}
