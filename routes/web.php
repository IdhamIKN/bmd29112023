<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckRole;

use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Role\PermissionController;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\Kantor\KantorController;
use App\Http\Controllers\Karyawan\KaryawanController;
use App\Http\Controllers\Punishment\PunishmentController;
use App\Http\Controllers\Reward\RewardController;
use App\Http\Controllers\User\KeluargaController;
use App\Http\Controllers\User\PendidikanController;
use App\Http\Controllers\User\PendidikanfrmController;
use App\Http\Controllers\User\BahasaUserController;
use App\Http\Controllers\User\OrganisasiController;
use App\Http\Controllers\User\KontakController;
use App\Http\Controllers\User\PersonalController;
use App\Http\Controllers\User\AlamatController;
use App\Models\info_user;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::get('password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::controller(RegisterController::class)->middleware('guest')->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('storeregister', 'store')->name('storeregister');
    Route::get('import', 'import')->name('import');
    Route::post('importcsv', 'importCSV')->name('importCSV');
    Route::get('importkd', 'importkd')->name('importkd');
    Route::post('importKDpos', 'importKDpos')->name('importKDpos');
});

Route::controller(ForgotPasswordController::class)->middleware('guest')->group(function () {
    Route::get('forgotpassword', 'forgotpassword')->name('forgotpassword');
    Route::post('send', 'sendResetLinkEmail')->name('send');
});
// Route::get('/forgot-password', function () {
//     return view('auth.passwords.email', [
//         'layout' => 'login'
//     ]);
// })->middleware('guest')->name('password.request');



Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/menu', [MenuController::class, 'sideMenu'])->name('menu');

    // Role
    Route::resource('roles', RoleController::class);
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/searchrole', [RoleController::class, 'search'])->name('searchrole');
    Route::post('/roleupdate-items-per-page', [RoleController::class, 'updateItemsPerPage']);

    // Permissions
    Route::resource('permission', PermissionController::class);
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/searchpermission', [PermissionController::class, 'search'])->name('searchpermission');
    Route::post('/permissionupdate-items-per-page', [PermissionController::class, 'updateItemsPerPage']);

    Route::controller(UserController::class)->group(function () {
        // User
        Route::get('user', 'index')->name('getuser');
        Route::post('user/{id}', 'update')->name('user.update');
        Route::get('profile', 'profile')->name('profileuser');
        Route::get('changepassword', 'changepassword')->name('changepassword');
        Route::post('changepassword', 'updatepassword')->name('update.password');
        Route::get('/print/{id}', 'cetakPengaduan')->name('printContent');
        Route::get('/searchuser', 'search')->name('searchuser');
        Route::post('/items-per-page', 'ItemsPerPage');
        Route::delete('user/{id}', 'delete')->name('deleteuser');
    });

    Route::controller(PersonalController::class)->group(function () {
        Route::get('account', 'index')->name('account');
        Route::post('accountStore', 'store')->name('accountStore');
    });

    Route::controller(AlamatController::class)->group(function () {
        Route::get('account-alamat', 'index')->name('account-alamat');
        Route::post('account-alamatStore', 'store')->name('account-alamatStore');
    });

    Route::controller(PendidikanController::class)->group(function () {
        Route::get('account-pendidikan', 'index')->name('account-pendidikan');
        Route::post('account-pendidikanStore', 'store')->name('account-pendidikanStore');
        Route::post('account-pendidikanUpdate/{id}', 'update')->name('account-pendidikanUpdate');
        Route::delete('account-pendidikanDelete/{id}', 'delete')->name('account-pendidikanDelete');
    });

    Route::controller(PendidikanfrmController::class)->group(function () {
        Route::get('account-pendidikanfrm', 'index')->name('account-pendidikanfrm');
        Route::post('account-pendidikanfrmStore', 'store')->name('account-pendidikanfrmStore');
        Route::post('account-pendidikanfrmUpdate/{id}', 'update')->name('account-pendidikanfrmUpdate');
        Route::delete('account-pendidikanfrmDelete/{id}', 'delete')->name('account-pendidikanfrmDelete');
    });

    Route::controller(KeluargaController::class)->group(function () {
        Route::get('account-keluarga', 'index')->name('account-keluarga');
        Route::post('account-keluargaStore', 'store')->name('account-keluargaStore');
        Route::post('account-keluargaUpdate/{id}', 'update')->name('account-keluargaUpdate');
        Route::delete('account-keluargaDelete/{id}', 'delete')->name('account-keluargaDelete');
    });

    Route::controller(BahasaUserController::class)->group(function () {
        Route::get('account-bahasa', 'index')->name('account-bahasa');
        Route::post('account-bahasaStore', 'store')->name('account-bahasaStore');
        Route::post('account-bahasaUpdate/{id}', 'update')->name('account-bahasaUpdate');
        Route::delete('account-bahasaDelete/{id}', 'delete')->name('account-bahasaDelete');
    });

    Route::controller(OrganisasiController::class)->group(function () {
        Route::get('account-organisasi', 'index')->name('account-organisasi');
        Route::post('account-organisasiStore', 'store')->name('account-organisasiStore');
        Route::post('account-organisasiUpdate/{id}', 'update')->name('account-organisasiUpdate');
        Route::delete('account-organisasiDelete/{id}', 'delete')->name('account-organisasiDelete');
    });

    Route::controller(KontakController::class)->group(function () {
        Route::get('account-kontak', 'index')->name('account-kontak');
        Route::post('account-kontakStore', 'store')->name('account-kontakstore');
        Route::post('account-kontakUpdate/{id}', 'update')->name('account-kontakUpdate');
        Route::delete('account-kontakDelete/{id}', 'delete')->name('account-kontakDelete');
    });

    Route::prefix('karyawan')->group(function () {
        Route::get('/index', [KaryawanController::class, 'index'])->name('karyawan-index');
        Route::post('/create', [KaryawanController::class, 'create'])->name('karyawan-create');
        Route::get('/show/{id}', [KaryawanController::class, 'show'])->name('showeuser');
        Route::get('/search', [KaryawanController::class, 'search'])->name('searchkaryawan');
        Route::post('/update-items-per-page', [KaryawanController::class, 'updateItemsPerPage']);
    });
    Route::get('/get-tabulator-data', function () {
        $user = info_user::all();
        $jkOptions = config('options.jk');
        $divisiOptions = config('options.divisi');

        return response()->json([
            'user' => $user,
            'jkOptions' => $jkOptions,
            'divisiOptions' => $divisiOptions,
        ]);
    });

    Route::prefix('kantor')->group(function () {
        Route::get('/index', [KantorController::class, 'index'])->name('kantor-index');
        Route::post('/create', [KantorController::class, 'create'])->name('kantor-create');
    });

    Route::prefix('reward')->group(function () {
        Route::get('/index', [RewardController::class, 'index'])->name('reward-index');
        Route::get('/create', [RewardController::class, 'create'])->name('reward-create');
        Route::post('/store', [RewardController::class, 'store'])->name('reward-store');
        Route::post('/update/{id}', [RewardController::class, 'update'])->name('reward-update');
        Route::delete('/delete/{id}', [RewardController::class, 'delete'])->name('reward-delete');
        Route::get('/search', [RewardController::class, 'search'])->name('searchreward');
        Route::post('/update-items-per-page', [RewardController::class, 'updateItemsPerPage']);

        Route::get('/count', [RewardController::class, 'calculateReward'])->name('reward-count');
    });

    Route::prefix('punishment')->group(function () {
        Route::get('/index', [PunishmentController::class, 'index'])->name('punishment-index');
        Route::get('/create', [PunishmentController::class, 'create'])->name('punishment-create');
        Route::post('/store', [PunishmentController::class, 'store'])->name('punishment-store');
        Route::post('/update/{id}', [PunishmentController::class, 'update'])->name('punishment-update');
        Route::delete('/delete/{id}', [PunishmentController::class, 'delete'])->name('punishment-delete');
        Route::get('/search', [PunishmentController::class, 'search'])->name('searchpunishment');
        Route::post('/update-items-per-page', [PunishmentController::class, 'updateItemsPerPage']);

        Route::get('/count', [PunishmentController::class, 'calculatePunishment'])->name('punishment-count');
    });

    // Route::prefix('dashboard')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        // Route::get('/', [DashboardController::class, 'index'])->name('dashboard-overview-1');
        Route::get('/', 'index')->name('dashboard-overview-1');
        Route::get('/jk', 'countGender');
        Route::get('/search','search')->name('search');
    });


    Route::controller(PageController::class)->group(function () {
        // Route::get('/', 'dashboard')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});

Route::controller(DependantDropdownController::class)->group(function () {
    Route::get('/provinces', 'provinces')->name('provinces');
    Route::get('/cities', 'cities')->name('cities');
    Route::get('/districts', 'districts')->name('districts');
    Route::get('/villages', 'villages')->name('villages');
});

// Auth::routes();
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('/getAlamat', [App\Http\Controllers\AlamatController::class, 'getAlamat']);
Route::get('/getVillage', [App\Http\Controllers\AlamatController::class, 'getVillage']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
