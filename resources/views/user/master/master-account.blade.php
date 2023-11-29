@extends('user.master.master')

@section('profil-content')
<!-- END: Profile Info -->
<div class="tab-content mt-5">
    <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab"></div>
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Profile Menu -->
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="w-12 h-12 image-fit">
                        @if (!empty($userPerson) && !empty($userPerson->foto))
                        <img class="rounded-full" alt="user-profile" src="{{ asset('storage/' . $userPerson->foto) }}">
                        @else
                        <img class="rounded-full" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                        @endif
                        {{-- <img alt="user-profil" class="rounded-full" src="{{ asset('build/assets/images/user.png') }}"> --}}
                    </div>
                    <div class="ml-4 mr-auto">
                        @if (!empty($userPerson) && !empty($userPerson->name))
                        <div class="font-medium text-base">{{ $userPerson->name }}</div>
                        @else
                        <div class="font-medium text-base">{{ auth()->user()->name }}</div>
                        @endif
                        @if (!empty($userPerson) && !empty($userPerson->divisi))
                        <div class="text-slate-500">{{ $divisiOptions[$userPerson->divisi] }}</div>
                        @else
                        <div class="text-slate-500"></div>
                        @endif
                        {{-- <div class="font-medium text-base"> {{ $userPerson->name }}</div> --}}
                        {{-- <div class="text-slate-500">{{ $userPerson->divisi }}</div> --}}
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account') }}">
                        <i data-lucide="user" class="w-4 h-4 mr-2"></i> Personal Information
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href=" {{ route('account-alamat') }}">
                        <i data-lucide="map" class="w-4 h-4 mr-2"></i> Alamat
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-pendidikan') }}">
                        <i data-lucide="album" class="w-4 h-4 mr-2"></i> Pendidikan Formal
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-pendidikanfrm') }}">
                        <i data-lucide="bookmark" class="w-4 h-4 mr-2"></i> Pendidikan Non-Formal
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-keluarga') }}">
                        <i data-lucide="contact" class="w-4 h-4 mr-2"></i> Data Keluarga
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-bahasa') }}">
                        <i data-lucide="languages" class="w-4 h-4 mr-2"></i> Data Bahasa
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-organisasi') }}">
                        <i data-lucide="archive" class="w-4 h-4 mr-2"></i> Jenjang Karier
                    </a>
                    <a class="flex items-center mt-5 {{ Request::routeIs('profileuser') ? 'active' : '' }}" href="{{ route('account-kontak') }}">
                        <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i> Kotak Darurat
                    </a>
                    {{-- <a class="flex items-center mt-5" href="">
                        <i data-lucide="settings" class="w-4 h-4 mr-2"></i> User Settings
                    </a> --}}
                </div>
            </div>
        </div>
        @yield('account-content')
    </div>
</div>

@endsection
