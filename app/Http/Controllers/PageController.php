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
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\Punishment\PunishmentController;
use Illuminate\Http\Request;

class PageController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:dashboard-index|dashboard-create|dashboard-edit|dashboard-delete', ['only' => ['index','show']]);
         $this->middleware('permission:dashboard-create', ['only' => ['create','store']]);
         $this->middleware('permission:dashboard-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:dashboard-delete', ['only' => ['destroy']]);
    }
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        // dd($educationStatistics);
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
                'ageRangeAbove50'
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
                'ageRangeAbove50'
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
                'ageRangeAbove50'
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
            $malePercentage = ($countMale / $totalCount) * 100;
            $femalePercentage = ($countFemale / $totalCount) * 100;
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


    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview2()
    {
        return view('pages/dashboard-overview-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview3()
    {
        return view('pages/dashboard-overview-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview4()
    {
        return view('pages/dashboard-overview-4');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        return view('pages/inbox');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        return view('pages/categories');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct()
    {
        return view('pages/add-product');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productList()
    {
        return view('pages/product-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productGrid()
    {
        return view('pages/product-grid');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transactionList()
    {
        return view('pages/transaction-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transactionDetail()
    {
        return view('pages/transaction-detail');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sellerList()
    {
        return view('pages/seller-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sellerDetail()
    {
        return view('pages/seller-detail');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reviews()
    {
        return view('pages/reviews');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileManager()
    {
        return view('pages/file-manager');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pointOfSale()
    {
        return view('pages/point-of-sale');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chat()
    {
        return view('pages/chat');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        return view('pages/post');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        return view('pages/calendar');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crudDataList()
    {
        return view('pages/crud-data-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crudForm()
    {
        return view('pages/crud-form');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout1()
    {
        return view('pages/users-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout2()
    {
        return view('pages/users-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout3()
    {
        return view('pages/users-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview1()
    {
        return view('pages/profile-overview-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview2()
    {
        return view('pages/profile-overview-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview3()
    {
        return view('pages/profile-overview-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout1()
    {
        return view('pages/wizard-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout2()
    {
        return view('pages/wizard-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout3()
    {
        return view('pages/wizard-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout1()
    {
        return view('pages/blog-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout2()
    {
        return view('pages/blog-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout3()
    {
        return view('pages/blog-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pricingLayout1()
    {
        return view('pages/pricing-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pricingLayout2()
    {
        return view('pages/pricing-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceLayout1()
    {
        return view('pages/invoice-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceLayout2()
    {
        return view('pages/invoice-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout1()
    {
        return view('pages/faq-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout2()
    {
        return view('pages/faq-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout3()
    {
        return view('pages/faq-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('pages/login');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function register()
    // {

    //     return view('pages/register');
    // }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function errorPage()
    {
        return view('pages/error-page');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
        return view('pages/update-profile');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('pages/change-password');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regularTable()
    {
        return view('pages/regular-table');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tabulator()
    {
        return view('pages/tabulator');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modal()
    {
        return view('pages/modal');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slideOver()
    {
        return view('pages/slide-over');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
        return view('pages/notification');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tab()
    {
        return view('pages/tab');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accordion()
    {
        return view('pages/accordion');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function button()
    {
        return view('pages/button');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alert()
    {
        return view('pages/alert');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function progressBar()
    {
        return view('pages/progress-bar');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tooltip()
    {
        return view('pages/tooltip');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropdown()
    {
        return view('pages/dropdown');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function typography()
    {
        return view('pages/typography');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function icon()
    {
        return view('pages/icon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadingIcon()
    {
        return view('pages/loading-icon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regularForm()
    {
        return view('pages/regular-form');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function datepicker()
    {
        return view('pages/datepicker');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tomSelect()
    {
        return view('pages/tom-select');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('pages/file-upload');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorClassic()
    {
        return view('pages/wysiwyg-editor-classic');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorInline()
    {
        return view('pages/wysiwyg-editor-inline');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorBalloon()
    {
        return view('pages/wysiwyg-editor-balloon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorBalloonBlock()
    {
        return view('pages/wysiwyg-editor-balloon-block');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorDocument()
    {
        return view('pages/wysiwyg-editor-document');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validation()
    {
        return view('pages/validation');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chart()
    {
        return view('pages/chart');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slider()
    {
        return view('pages/slider');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imageZoom()
    {
        return view('pages/image-zoom');
    }
}
