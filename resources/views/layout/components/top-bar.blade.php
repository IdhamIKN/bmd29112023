<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification sm:hidden" href="">
            <i data-lucide="search" class="notification__icon dark:text-slate-500"></i>
        </a>
        <div class="search-result">
            <div class="search-result__content">
                {{-- <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="inbox"></i>
                        </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="users"></i>
                        </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full">
                            <i class="w-4 h-4" data-lucide="credit-card"></i>
                        </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    @foreach (array_slice($fakers, 0, 4) as $faker)
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                        </div>
                        <div class="ml-3">{{ $faker['users'][0]['name'] }}</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">{{ $faker['users'][0]['email'] }}</div>
                    </a>
                    @endforeach
                </div>
                <div class="search-result__content__title">Products</div>
                @foreach (array_slice($fakers, 0, 4) as $faker)
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}">
                    </div>
                    <div class="ml-3">{{ $faker['products'][0]['name'] }}</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">{{ $faker['products'][0]['category'] }}</div>
                </a>
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- END: Search -->
    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-auto sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i>
        </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
                {{-- @foreach (array_slice($fakers, 0, 5) as $key => $faker)
                <div class="cursor-pointer relative flex items-center {{ $key ? 'mt-5' : '' }}">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('build/assets/images/' . $faker['photos'][0]) }}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">{{ $faker['users'][0]['name'] }}</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $faker['times'][0] }}</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">{{ $faker['news'][0]['short_content'] }}</div>
                    </div>
                </div>
                @endforeach --}}
            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            @if (!empty($userfoto) && !empty($userfoto->foto))
            <img class="rounded-full" alt="user-profile" src="{{ asset('storage/' . $userfoto->foto) }}">
            @else
            <img class="rounded-full" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
            @endif
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">

                <li class="p-2">
                    @if (!empty($userPerson) && !empty($userPerson->name))
                    <div class="font-medium">{{ $userPerson->name }}</div>
                    @else
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                    @endif
                    @if (!empty($userPerson) && !empty($userPerson->penempatan))
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ $userPerson->penempatan }}</div>
                    @else
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500"></div>
                    @endif
                    {{-- <div class="font-medium">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ $fakers[0]['jobs'][0] }}</div> --}}
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('profileuser') }}" class="dropdown-item hover:bg-white/5 {{ Request::routeIs('profileuser') ? 'active' : '' }}">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Resume Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('account') }}" class="dropdown-item hover:bg-white/5 {{ Request::routeIs('account') ? 'active' : '' }}">
                        <i data-lucide="shield" class="w-4 h-4 mr-2"></i> Data Saya
                    </a>
                </li>
                <li>
                    <a href="{{ route('changepassword') }}" class="dropdown-item hover:bg-white/5 {{ Request::routeIs('changepassword') ? 'active' : '' }}">
                        <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Ganti Password
                    </a>
                </li>
                {{-- <li>
                    <a href="" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help
                    </a>
                </li> --}}
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('dark-mode-switcher') }}" data-url="{{ route('dark-mode-switcher') }}" class="flex items-center">
                        @if ($dark_mode)
                        <i data-lucide="sun" class="notification__icon dark:text-slate-500"></i>
                        <p class="ml-2">Light Mode</p>
                        @else
                        <i data-lucide="moon" class="notification__icon dark:text-slate-500"></i>
                        <p class="ml-2">Dark Mode</p>
                        @endif
                    </a>
                </li>
                <li>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500 text-center">Color Scheme</div>
                    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'default']) }}" class="inline-block w-8 h-8 cursor-pointer bg-blue-800 rounded-full border-4 mr-1 hover:border-slate-200 {{ $color_scheme =='default' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
                    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-1']) }}" class="inline-block w-8 h-8 cursor-pointer bg-emerald-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ $color_scheme =='theme-1' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
                    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-2']) }}" class="inline-block w-8 h-8 cursor-pointer bg-blue-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ $color_scheme =='theme-2' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
                    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-3']) }}" class="inline-block w-8 h-8 cursor-pointer bg-cyan-900 rounded-full border-4 mr-1 hover:border-slate-200 {{ $color_scheme =='theme-3' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
                    <a href="{{ route('color-scheme-switcher', ['color_scheme' => 'theme-4']) }}" class="inline-block w-8 h-8 cursor-pointer bg-indigo-900 rounded-full border-4 hover:border-slate-200 {{ $color_scheme =='theme-4' ? 'border-slate-300 dark:border-darkmode-800/80' : 'border-white dark:border-darkmode-600' }}"></a>
                </li>

                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item hover:bg-white/5">
                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
