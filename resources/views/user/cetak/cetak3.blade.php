<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{public_path('css/materialize.css')}}">
    <title>RESUME BIODATA KARYAWAN</title>
    <style>
        /* td {
            border-top: #9e9e9e 1px solid !important;
            border-bottom: #9e9e9e 1px solid !important;
            border-right: #e0e0e0 1px solid !important;
            border-left: #e0e0e0 1px solid !important;
        }

        th {
            border-bottom: #212121 1px solid !important;
            border-top: #212121 1px solid !important;
            border-right: #9e9e9e 1px solid !important;
            border-left: #9e9e9e 1px solid !important;
        } */
        .borderless td,
        .borderless th {
            border: none;
        }

    </style>
</head>
<body>
    <div class="tab-content mt-5">
        <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y box col-span-12 lg:col-span-10">
                    <!-- BEGIN: Profile Menu -->
                    <div class="col-span-12 lg:col-span-8 2xl:col-span-12 flex lg:block flex-col-reverse">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center dark:border-darkmode-400">
                                <h1 class="font-bold text-base text-center w-full truncate">BMD SYARIAH</h1>
                            </div>
                            <div class="flex items-center dark:border-darkmode-400">
                                <div class="text-center">
                                    <font class="text-base text-center w-full" size="1">Jl. Raya Ponorogo No.8 Dolopo, Madiun, Jawa Timur Telp: (0351) 369980.</font>
                                </div>
                            </div>
                            <hr style="height:3px;border-width:0;color:gray;background-color:gray">
                            <div class="">
                                <h2 class="font-bold text-base text-center w-full truncate">RESUME BIODATA KARYAWAN</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="">
                    @if (!empty($userPerson))
                    @foreach ($userPerson as $userPerson)
                    <div class="row">
                        <div class="col-md-4">
                            @if (!empty($foto) && !empty($foto[0]->foto))
                            <img class="rounded float-end" src="{{ public_path('/storage/' . $foto[0]->foto) }}" width="160" height="211">
                            @else
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                <div class="pr-10">
                                    <div class="text-slate-500 text-xs mt-0.5">
                                        <font size="2">
                                            <span>Nama Lengkap</span> <span class="mx-1">:</span>
                                        </font>
                                    </div>
                                    <font class="text-uppercase fw-bold" size="2">
                                        <span>{{ $userPerson->name }}</span>
                                    </font>
                                </div>
                            </div>
                            <table class="table borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Nomer Induk Karyawan</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $userPerson->nik }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Nomer Induk Kependudukan</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $userPerson->ktp }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Tempat Lahir</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $userPerson->tl }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Tanggal Lahir</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ date('d F Y', strtotime($userPerson->ttl)) }}
                                                            ({{ \Carbon\Carbon::parse($userPerson->ttl)->age }} tahun)</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Status Perkawinan</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $kawinOptions[$userPerson->stper] }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Kewarganegaraan</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $userPerson->warga }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Agama</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $agamaOptions[$userPerson->agama] }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Golongan Darah</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $goldarOptions[$userPerson->goldar] }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                <div class="pr-10">
                                                    <div class="text-slate-500 text-xs mt-0.5">
                                                        <font size="2">
                                                            <span>Jenis Kelamin</span> <span class="mx-1">:</span>
                                                        </font>
                                                    </div>
                                                    <font class="text-uppercase fw-bold" size="2">
                                                        <span>{{ $jkOptions[$userPerson->jk] }}</span>
                                                    </font>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="text-center">
                        <div class="text-uppercase fw-bold">Alamat Information</div>
                    </div>
                    <div class="mt-1 mb-1">
                        @if (!empty($useralamat) && count($useralamat) > 0)
                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                            <div class="pr-10">
                                <div class="text-slate-500 text-xs mt-0.5">
                                    <font size="2">
                                        <span>Jenis</span> <span class="mx-1">:</span>
                                    </font>
                                </div>
                                <font class="text-uppercase fw-bold" size="2">
                                    <span>{{ $jenisOptions[$useralamat->first()->jenis] }}</span>
                                </font>
                            </div>
                        </div>
                        <table class="table borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <font size="2">
                                                        <span>Provinsi</span> <span class="mx-1">:</span>
                                                    </font>
                                                </div>
                                                <font class="text-uppercase fw-bold" size="2">
                                                    <span>{{ $useralamat->first()->provinsi }}</span>
                                                </font>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <font size="2">
                                                        <span>Kota/Kabupaten</span> <span class="mx-1">:</span>
                                                    </font>
                                                </div>
                                                <font class="text-uppercase fw-bold" size="2">
                                                    <span>{{ $useralamat->first()->kota }}</span>
                                                </font>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <font size="2">
                                                        <span>Kecamatan</span> <span class="mx-1">:</span>
                                                    </font>
                                                </div>
                                                <font class="text-uppercase fw-bold" size="2">
                                                    <span>{{ $useralamat->first()->kecamatan }}</span>
                                                </font>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <font size="2">
                                                        <span>Desa/Kelurahan</span> <span class="mx-1">:</span>
                                                    </font>
                                                </div>
                                                <font class="text-uppercase fw-bold" size="2">
                                                    <span>{{ $useralamat->first()->desa }}</span>
                                                </font>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <font size="2">
                                                        <span>Alamat Lengkap</span> <span class="mx-1">:</span>
                                                    </font>
                                                </div>
                                                <font class="fw-bold" size="2">
                                                    <span>{{ $useralamat->first()->alamat }}</span>
                                                </font>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @else
                        @endif
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <br>

                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Riwayat Pendidikan</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userPend) && count($userPend) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Jenjang</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Sekolah/Universitas</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Nilai/IPK</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Status</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $nomorUrut = 1; @endphp
                                            @foreach ($userPend as $pendidikan)
                                            <tr>
                                                <td class="font-medium whitespace-nowrap">{{ $nomorUrut }}</td>
                                                <td>
                                                    <font size="2">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $jenjangOptions[$pendidikan->jenjang] }}</p>
                                                            <p class="text-xs text-secondary mb-0">{{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }}</p>
                                                        </div>
                                                    </font>
                                                </td>
                                                <td>
                                                    <font size="2">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $pendidikan->jurusan }}</p>
                                                            <p class="text-xs text-secondary mb-0">{{ $pendidikan->sekolah }}</p>
                                                        </div>
                                                    </font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->ipk }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $statusOptions[$pendidikan->status] }}</font>
                                                </td>
                                            </tr>
                                            @php $nomorUrut++; @endphp>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Riwayat Pendidikan-Non Formal</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userPendFrm) && count($userPendFrm) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Lembaga</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Kota</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No.Sertifikat</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Status</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Tahun Mulai / Selesai</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userPendFrm as $index => $pendidikan)
                                            <tr>
                                                <td>
                                                    <font size="2">{{ $index + 1 }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->lembaga }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->kota }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->sertif }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $statusOptions[$pendidikan->status] }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }}</font>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Data Bahasa</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userbahasa) && count($userbahasa) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Bahasa</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Lisan</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Tulisan</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userbahasa as $index => $pendidikan)
                                            <tr>
                                                <td>
                                                    <font size="2">{{ $index + 1 }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->bahasa}}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $tingkatOptions[$pendidikan->lisan] }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $tingkatOptions[$pendidikan->tulisan] }}</font>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                        Belum ada Data Bahasa . Silakan menambahkan Data Bahasa
                                        <a href="{{ route('account-pendidikanfrm') }}">di sini</a>.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Jenjang Karier</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userorganisasi) && count($userorganisasi) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Karier</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userorganisasi as $index => $pendidikan)
                                            <tr>
                                                <td>
                                                    <font size="2">{{ $index + 1 }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->organisasi }}</font>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Data Keluarga Karyawan</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userkeluarga) && count($userkeluarga) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Nama</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Tempat/Tanggal Lahir</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No.Hp</font>
                                                </th>

                                                <th class="whitespace-nowrap">
                                                    <font size="2">Pendidikan</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Pekerjaan</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userkeluarga as $index => $pendidikan)
                                            <tr>
                                                <td>
                                                    <font size="2">{{ $index + 1 }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs text-secondary mb-0">{{ $hubOptions[$pendidikan->status] }}</p>
                                                            <p class="mb-0 text-sm">{{ $pendidikan->nama }}</p>
                                                        </div>
                                                    </font>
                                                </td>
                                                <td>
                                                    <font size="2">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="text-xs text-secondary mb-0">{{ $pendidikan->tl }}</p>
                                                            <p class="mb-0 text-sm">{{ date('d F Y', strtotime($pendidikan->ttl)) }}</p>
                                                        </div>
                                                    </font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->telp }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $jenjangOptions[$pendidikan->pendidikan] }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $jobOptions[$pendidikan->pekerjaan] }}</font>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 2xl:col-span-6">
                            <div class="text-center">
                                <div class="text-uppercase fw-bold">Kontak Darurat</div>
                            </div>
                            <br>
                            <div class="mt-1 mb-1">
                                <div class="overflow-x-auto">
                                    @if (!empty($userkontak) && count($userkontak) > 0)
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Nama</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Hubungan</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">Alamat</font>
                                                </th>
                                                <th class="whitespace-nowrap">
                                                    <font size="2">No. Hp.</font>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userkontak as $index => $pendidikan)
                                            <tr>
                                                <td>
                                                    <font size="2">{{ $index + 1 }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->nama }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $hubOptions[$pendidikan->hubungan] }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->alamat }}</font>
                                                </td>
                                                <td>
                                                    <font size="2">{{ $pendidikan->telp }} </font>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="text-slate-500">
                                    </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
            </div>
        </div>
    </div>
    </div>
    <!-- END: Profile Menu -->
    </div>
    </div>
    </div>
</body>

</html>
