@extends('../layout/' . $layout)

@section('subhead')
<title>Detail Karyawan - Employee Data - BMD Syariah</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Detail Karyawan</h2>
</div>
<!-- BEGIN: Profile Info -->

<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                @if (!empty($userPerson) && !empty($userPerson[0]->foto))
                <img class="rounded-full" alt="user-profile" src="{{ asset('storage/' . $userPerson[0]->foto) }}">
                @else
                <img class="rounded-full" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                @endif
                {{-- <img alt="user-profil" class="rounded-full" src="{{ asset('build/assets/images/user.png') }}"> --}}
            </div>
            @foreach ($userPerson as $index => $userPerson)
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
            @endforeach
        </div>
        <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 mr-2"></i> {{ $userId->email }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>{{ $jkOptions[$userPerson->jk] }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-lucide="smartphone " class="w-4 h-4 mr-2"></i> {{ $userId->nohp }}
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
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">RESUME BIODATA KARYAWAN</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        @if (!empty($userPerson) && !empty($userPerson->id_user))
        <a id="tabulator-print" class="btn btn-outline-primary w-1/2 sm:w-auto mr-2" href="{{ route('printContent', ['id' => $userPerson->id_user]) }}">
            <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
        </a>
        @else
        <div class="text-slate-500"></div>
        @endif
    </div>
</div>

<div class="tab-content mt-5">
    <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 lg:col-span-10">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-8 2xl:col-span-12 flex lg:block flex-col-reverse">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">

                        {{-- <div class="flex items-center dark:border-darkmode-400">
                            <h2 class="font-bold text-base text-center w-full truncate">KOPERASI KONSUMEN BERKAH MULIA DINAR SYARIAH</h2>
                        </div>
                        <div class="flex items-center dark:border-darkmode-400">
                            <h1 class="font-bold text-base text-center w-full  truncate">BMD Syariah</h1>
                        </div>
                        <div class="flex items-center dark:border-darkmode-400">
                            <font class="text-base text-center w-full" size="1">Jl. Raya Ponorogo No.8 Dolopo, Madiun, Jawa Timur Telp: (0351) 369980.</font>
                        </div>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray"> --}}
                        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-bold text-base text-center w-full truncate">RESUME BIODATA KARYAWAN</h2>
                        </div>

                        {{-- Ambil dari DB info_user --}}
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row">
                                <div class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 2xl:col-span-6">
                                            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                                <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                                <div class="font-medium text-base-center mr-auto truncate">Personal Information</div>
                                            </div>
                                            <div class="mt-1 mb-1">
                                                @if (!empty($userPerson))
                                                {{-- @if (!empty($userPerson) && count($userPerson) > 0) --}}
                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                    <div class="pr-10">
                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                            <span class="event__days">Nama Lengkap</span> <span class="mx-1">:</span>
                                                        </div>
                                                        <div class="event__title truncate">{{ $userPerson->name }}</div>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-12 gap-x-5">
                                                    <div class="col-span-12 xl:col-span-6">
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Nomer Induk Karyawan</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $userPerson->nik }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Tempat Lahir</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $userPerson->tl }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Agama</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $agamaOptions[$userPerson->agama] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Status Perkawinan</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $kawinOptions[$userPerson->stper] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Jenis Kelamin</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $jkOptions[$userPerson->jk] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-6">
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Nomer Induk Kependudukan</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $userPerson->ktp }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Tanggal Lahir</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">
                                                                    {{ date('d F Y', strtotime($userPerson->ttl)) }}
                                                                    ({{ \Carbon\Carbon::parse($userPerson->ttl)->age }} tahun)
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Kewarganegaraan</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $userPerson->warga }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Golongan Darah</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $goldarOptions[$userPerson->goldar] }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Divisi / Penempatan</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">{{ $divisiOptions[$userPerson->divisi] ?? '' }} - {{ $userPerson->penempatan ?? '' }}</div>
                                                            </div>
                                                        </div>
                                                        

                                                    </div>
                                                </div>
                                                @else
                                                <div class="text-slate-500">Belum ada data Personal. Silahkan Menambahkan data personal <a href="{{ route('account') }}">Klik Saya</a>.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                    <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            @if (!empty($userPerson) && !empty($userPerson->foto))
                                            <img class="rounded-md" alt="user-profile" src="{{ asset('storage/' . $userPerson->foto) }}">
                                            @else
                                            <img class="rounded-md" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                    <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                    <div class="font-medium text-base-center mr-auto truncate">Alamat Information</div>
                                </div>
                                <div class="mt-1 mb-1">
                                    {{-- @if (!empty($useralamat)) --}}
                                    @if (!empty($useralamat) && count($useralamat) > 0)
                                    <div class="pr-10">
                                        <div class="text-slate-500 text-xs mt-0.5">
                                            <span class="event__days">Jenis</span> <span class="mx-1">:</span>
                                        </div>
                                        <div class="event__title truncate">{{ $jenisOptions[$useralamat->first()->jenis] }}</div>
                                    </div>
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-6">
                                            <div class="pr-10">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <span class="event__days">Provinsi</span> <span class="mx-1">:</span>
                                                    </div>
                                                    <div class="event__title truncate">{{ $useralamat->first()->provinsi }}</div>
                                                </div>
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <span class="event__days">Kecamatan</span> <span class="mx-1">:</span>
                                                    </div>
                                                    <div class="event__title truncate">{{ $useralamat->first()->kecamatan }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 xl:col-span-6">
                                            <div class="pr-10">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <span class="event__days">Kota/Kabupaten</span> <span class="mx-1">:</span>
                                                    </div>
                                                    <div class="event__title truncate">{{ $useralamat->first()->kota }}</div>
                                                </div>
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <span class="event__days">Desa/Kelurahan</span> <span class="mx-1">:</span>
                                                    </div>
                                                    <div class="event__title truncate">{{ $useralamat->first()->desa }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="text-slate-500">Belum ada Data Alamat. </div>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Riwayat Pendidikan</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userPend) && count($userPend) > 0)
                                                <table class="table table-report -mt-2">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Jenjang</th>
                                                            <th class="whitespace-nowrap">Sekolah/Universitas</th>
                                                            <th class="whitespace-nowrap">Nilai/IPK</th>
                                                            <th class="whitespace-nowrap">Status</th>
                                                            <th class="whitespace-nowrap">Tahun Mulai / Selesai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userPend as $index => $pendidikan)
                                                        <tr>
                                                            <td class="font-medium whitespace-nowrap">{{ $index + 1 }}</td>
                                                            <td>{{ $jenjangOptions[$pendidikan->jenjang] }}</td>
                                                            <td>
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $pendidikan->jurusan }}</h6>
                                                                    <p class="text-xs text-secondary mb-0">{{ $pendidikan->sekolah }}</p>
                                                                </div>
                                                            </td>
                                                            <td>{{ $pendidikan->ipk }}</td>
                                                            <td>{{ $statusOptions[$pendidikan->status] }}</td>
                                                            <td>{{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada data Riwayat Pendidikan.
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Riwayat Pendidikan-Non Formal</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userPendFrm) && count($userPendFrm) > 0)
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Lembaga</th>
                                                            <th class="whitespace-nowrap">Kota</th>
                                                            <th class="whitespace-nowrap">No.Sertifikat</th>
                                                            <th class="whitespace-nowrap">Status</th>
                                                            <th class="whitespace-nowrap">Tahun Mulai / Selesai</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userPendFrm as $index => $pendidikan)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $pendidikan->lembaga }}</td>
                                                            <td>{{ $pendidikan->kota }}</td>
                                                            <td>{{ $pendidikan->sertif }}</td>
                                                            <td>{{ $statusOptions[$pendidikan->status] }}</td>
                                                            <td>{{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada data Pendidikan Non-Formal.
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Data Bahasa</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userbahasa) && count($userbahasa) > 0)
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Bahasa</th>
                                                            <th class="whitespace-nowrap">Lisan</th>
                                                            <th class="whitespace-nowrap">Tulisan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userbahasa as $index => $pendidikan)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $pendidikan->bahasa}}</td>
                                                            <td>{{ $tingkatOptions[$pendidikan->lisan] }}</td>
                                                            <td>{{ $tingkatOptions[$pendidikan->tulisan] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada Data Bahasa.
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Jenjang Karier</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userorganisasi) && count($userorganisasi) > 0)
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Karies</th>
                                                            {{-- <th class="whitespace-nowrap">Jabatan</th>
                                                            <th class="whitespace-nowrap">Tahun Mulai / Selesai</th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userorganisasi as $index => $pendidikan)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $pendidikan->organisasi }}</td>
                                                            {{-- <td>{{ $jabatanOptions[$pendidikan->jabatan] }}</td> --}}
                                                            {{-- <td>{{ date('m-Y', strtotime($pendidikan->th1)) }} / {{ date('m-Y', strtotime($pendidikan->th2)) }}</td> --}}
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada Data Pengalaman Organisasi .
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Data Keluarga Karyawan</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userkeluarga) && count($userkeluarga) > 0)
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Hubungan</th>
                                                            <th class="whitespace-nowrap">Nama</th>
                                                            <th class="whitespace-nowrap">No.Hp</th>
                                                            <th class="whitespace-nowrap">Tempat/Tanggal Lahir</th>
                                                            <th class="whitespace-nowrap">Pendidikan</th>
                                                            <th class="whitespace-nowrap">Pekerjaan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userkeluarga as $index => $pendidikan)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $hubOptions[$pendidikan->status] }}</td>
                                                            <td>{{ $pendidikan->nama }}</td>
                                                            <td>{{ $pendidikan->telp }}</td>
                                                            <td>{{ $pendidikan->tl }} / {{ date('d-m-Y', strtotime($pendidikan->ttl)) }}</td>
                                                            <td>{{ $jenjangOptions[$pendidikan->pendidikan] }}</td>
                                                            <td>{{ $jobOptions[$pendidikan->pekerjaan] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada Data Keluarga.
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="flex-1 mt-6 xl:mt-0">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 2xl:col-span-6">
                                        <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                                            <div class="font-medium text-base-center mr-auto truncate">Kontak Darurat</div>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <div class="overflow-x-auto">
                                                @if (!empty($userkontak) && count($userkontak) > 0)
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="whitespace-nowrap">No</th>
                                                            <th class="whitespace-nowrap">Nama</th>
                                                            <th class="whitespace-nowrap">Hubungan</th>
                                                            <th class="whitespace-nowrap">Alamat</th>
                                                            <th class="whitespace-nowrap">No. Hp.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($userkontak as $index => $pendidikan)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $pendidikan->nama }}</td>
                                                            <td>{{ $hubOptions[$pendidikan->hubungan] }}</td>
                                                            <td>{{ $pendidikan->alamat }}</td>
                                                            <td>{{ $pendidikan->telp }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                @else
                                                <div class="text-slate-500">
                                                    Belum ada data Kontak Darurat.
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Profile Menu -->
        </div>
    </div>
</div>
<script>
    document.getElementById("tabulator-print").addEventListener("click", function() {
        var printContents = document.getElementById("print-content").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>
@endsection
