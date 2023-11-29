@extends('../layout/' . $layout)

@section('subhead')
<title>Profile - Employee Data - BMD Syariah</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Resume Data</h2>
</div>
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                @if (!empty($userPerson) && !empty($userPerson->foto))
                <img class="rounded-full" alt="user-profile" src="{{ asset('storage/' . $userPerson->foto) }}">
                @else
                <img class="rounded-full" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                @endif
            </div>
            <div class="ml-5">
                @if (!empty($userPerson) && !empty($userPerson->name))
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $userPerson->name }}</div>
                @else
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ auth()->user()->name }}</div>
                @endif
                @if (!empty($userPerson) && !empty($userPerson->divisi))
                <div class="text-slate-500">{{ $divisiOptions[$userPerson->divisi] }}</div>
                @else
                <div class="text-slate-500"></div>
                @endif
            </div>
        </div>
        <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 mr-2"></i>{{ auth()->user() ? auth()->user()->email : '-' }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>{{ $userPerson ? $jkOptions[$userPerson->jk] : '-' }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-lucide="smartphone " class="w-4 h-4 mr-2"></i>{{ auth()->user() ? auth()->user()->nohp : '-' }}
                </div>
            </div>
        </div>
        <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-medium text-primary text-xl" id="totalReward"></div>
                <div class="text-slate-500">Reward</div>
            </div>
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-medium text-primary text-xl" id="totalPunishment"></div>
                <div class="text-slate-500">Punishment</div>
            </div>
        </div>
    </div>
    <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist">
        <li id="profile-tab" class="nav-item" role="presentation">
            <a href="{{ route('profileuser') }}" class="nav-link py-4 flex items-center {{ Request::routeIs('profileuser') ? 'active' : '' }}" data-tw-target="#profile" aria-controls="profile" aria-selected="true" role="tab">
                <i class="w-4 h-4 mr-2" data-lucide="user"></i> Resume Data
            </a>
        </li>
        <li id="account-tab" class="nav-item" role="presentation">
            <a href="{{ route('account') }}" class="nav-link py-4 flex items-center {{ Request::routeIs('account') ? 'active' : '' }}" data-tw-target="#account" aria-selected="false" role="tab">
                <i class="w-4 h-4 mr-2" data-lucide="shield"></i> Data
            </a>
        </li>
        <li id="change-password-tab" class="nav-item" role="presentation">
            <a href="{{ route('changepassword') }}" class="nav-link py-4 flex items-center {{ Request::routeIs('changepassword') ? 'active' : '' }}" data-tw-target="#change-password" aria-selected="false" role="tab">
                <i class="w-4 h-4 mr-2" data-lucide="lock"></i> Ganti Password
            </a>
        </li>
        {{-- <li id="settings-tab" class="nav-item" role="presentation">
            <a href="javascript:;" class="nav-link py-4 flex items-center {{ Request::routeIs('settings') ? 'active' : '' }}" data-tw-target="#settings" aria-selected="false" role="tab">
                <i class="w-4 h-4 mr-2" data-lucide="settings"></i> Settings
            </a>
        </li> --}}
    </ul>

</div>
@yield('profil-content')
<!-- END: Profile Info -->

@endsection
