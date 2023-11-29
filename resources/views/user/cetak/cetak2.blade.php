<!DOCTYPE html>

<html lang="id" class="">
<head>
    <meta charset="utf-8">
    <link href="http://192.168.200.103:8000/build/assets/images/logo.svg" rel="shortcut icon">
    <meta name="csrf-token" content="7V2lqBwWLbScZBvCv3OsvPEEztfGaBku28ShPzSg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Karyawan - Employee Data - BMD Syariah</title>

    <!-- BEGIN: CSS Assets-->
    <link rel="preload" as="style" href="http://192.168.200.103:8000/build/assets/app.64dc0b8f.css" />
    <link rel="stylesheet" href="http://192.168.200.103:8000/build/assets/app.64dc0b8f.css" /> <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="py-5">
    <div class="content">

        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">Detail Karyawan</h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">

                        <img class="rounded-full" alt="user-profile" src="http://192.168.200.103:8000/storage/photos/1234567890.jpg">

                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">Idham Kohar Nazarudin</div>
                        <div class="text-slate-500">IT &amp; Support System</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-2"></i> superadmin@gmail.com
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>Laki-laki
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <i data-lucide="smartphone " class="w-4 h-4 mr-2"></i> 1234567890
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
                <a id="tabulator-print" class="btn btn-outline-primary w-1/2 sm:w-auto mr-2" href="http://192.168.200.103:8000/print/1">
                    <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                </a>
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
                                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <h2 class="font-bold text-base text-center w-full truncate">RESUME BIODATA KARYAWAN</h2>
                                </div>
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

                                                        <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                            <div class="pr-10">
                                                                <div class="text-slate-500 text-xs mt-0.5">
                                                                    <span class="event__days">Nama Lengkap</span> <span class="mx-1">:</span>
                                                                </div>
                                                                <div class="event__title truncate">Idham Kohar Nazarudin</div>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-12 gap-x-5">
                                                            <div class="col-span-12 xl:col-span-6">
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Nomer Induk Karyawan</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">1234567890</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Tempat Lahir</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">Ponorogo</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Agama</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">Islam</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Status Perkawinan</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">Belum Kawin</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Jenis Kelamin</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">Laki-laki</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-span-12 xl:col-span-6">
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Nomer Induk Kependudukan</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">234567890</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Tanggal Lahir</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">
                                                                            02 November 1993
                                                                            (30 tahun)
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Kewarganegaraan</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">Indonesia</div>
                                                                    </div>
                                                                </div>
                                                                <div class="event p-1 -mx-1 cursor-pointer transition duration-300 ease-in-out hover-bg-slate-100 dark-hover-bg-darkmode-400 rounded-md flex items-center">
                                                                    <div class="pr-10">
                                                                        <div class="text-slate-500 text-xs mt-0.5">
                                                                            <span class="event__days">Golongan Darah</span> <span class="mx-1">:</span>
                                                                        </div>
                                                                        <div class="event__title truncate">B</div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                                            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                    <img class="rounded-md" alt="user-profile" src="http://192.168.200.103:8000/storage/photos/1234567890.jpg">
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

                                            <div class="pr-10">
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    <span class="event__days">Jenis</span> <span class="mx-1">:</span>
                                                </div>
                                                <div class="event__title truncate">Alamat Sesuai KTP</div>
                                            </div>
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-6">
                                                    <div class="pr-10">
                                                        <div class="pr-10">
                                                            <div class="text-slate-500 text-xs mt-0.5">
                                                                <span class="event__days">Provinsi</span> <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="event__title truncate">Jawa Timur</div>
                                                        </div>
                                                        <div class="pr-10">
                                                            <div class="text-slate-500 text-xs mt-0.5">
                                                                <span class="event__days">Kecamatan</span> <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="event__title truncate">Babadan</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-12 xl:col-span-6">
                                                    <div class="pr-10">
                                                        <div class="pr-10">
                                                            <div class="text-slate-500 text-xs mt-0.5">
                                                                <span class="event__days">Kota/Kabupaten</span> <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="event__title truncate">Kabupaten Ponorogoo</div>
                                                        </div>
                                                        <div class="pr-10">
                                                            <div class="text-slate-500 text-xs mt-0.5">
                                                                <span class="event__days">Desa/Kelurahan</span> <span class="mx-1">:</span>
                                                            </div>
                                                            <div class="event__title truncate">Patihan Wetan</div>
                                                        </div>
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
                                                    <div class="font-medium text-base-center mr-auto truncate">Riwayat Pendidikan</div>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <div class="overflow-x-auto">
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
                                                                <tr>
                                                                    <td class="font-medium whitespace-nowrap">1</td>
                                                                    <td>D-IV/S-1/Profesi</td>
                                                                    <td>
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">Teknik Informatika</h6>
                                                                            <p class="text-xs text-secondary mb-0">Universitas Muhammadiyah Ponorogo</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>4.00</td>
                                                                    <td>Lulus</td>
                                                                    <td>07-2017 / 10-2021</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-medium whitespace-nowrap">2</td>
                                                                    <td>SMP/MTS</td>
                                                                    <td>
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">Teknik Informatika</h6>
                                                                            <p class="text-xs text-secondary mb-0">Universitas Muhammadiyah Ponorogo</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>4.00</td>
                                                                    <td>Lulus</td>
                                                                    <td>07-2017 / 10-2021</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-medium whitespace-nowrap">3</td>
                                                                    <td>SD/MI</td>
                                                                    <td>
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">Teknik Informatika</h6>
                                                                            <p class="text-xs text-secondary mb-0">Universitas Muhammadiyah Ponorogo</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>4.00</td>
                                                                    <td>Lulus</td>
                                                                    <td>07-2017 / 10-2021</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-medium whitespace-nowrap">4</td>
                                                                    <td>SMA/MA/SLTA/SMK/D1</td>
                                                                    <td>
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">Teknik Informatika</h6>
                                                                            <p class="text-xs text-secondary mb-0">Universitas Muhammadiyah Ponorogo</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>4.00</td>
                                                                    <td>Lulus</td>
                                                                    <td>07-2017 / 10-2021</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="font-medium whitespace-nowrap">5</td>
                                                                    <td>D-II</td>
                                                                    <td>
                                                                        <div class="d-flex flex-column justify-content-center">
                                                                            <h6 class="mb-0 text-sm">Teknik Informatika</h6>
                                                                            <p class="text-xs text-secondary mb-0">Universitas Muhammadiyah Ponorogo</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>4.00</td>
                                                                    <td>Lulus</td>
                                                                    <td>07-2017 / 10-2021</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Cisco</td>
                                                                    <td>Kabupaten Ponorogo</td>
                                                                    <td>018971324</td>
                                                                    <td>Lulus</td>
                                                                    <td>08-2023 / 10-2023</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Indonesian</td>
                                                                    <td>Mahir</td>
                                                                    <td>Mahir</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                    <div class="font-medium text-base-center mr-auto truncate">Pengalaman Organisasi</div>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <div class="overflow-x-auto">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="whitespace-nowrap">No</th>
                                                                    <th class="whitespace-nowrap">Organisasi</th>
                                                                    <th class="whitespace-nowrap">Jabatan</th>
                                                                    <th class="whitespace-nowrap">Tahun Mulai / Selesai</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>hurak huruk</td>
                                                                    <td>Ketua</td>
                                                                    <td>08-2023 / 10-2023</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Orang Tua - Bapak</td>
                                                                    <td>Idham</td>
                                                                    <td>0851750213812</td>
                                                                    <td>Ponorogo / 10-2023</td>
                                                                    <td>D-III</td>
                                                                    <td>KARYAWAN SWASTA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Orang Tua - Bapak</td>
                                                                    <td>Kohar</td>
                                                                    <td>0851750213812</td>
                                                                    <td>Ponorogo / 10-2023</td>
                                                                    <td>D-III</td>
                                                                    <td>KARYAWAN SWASTA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Orang Tua - Bapak</td>
                                                                    <td>Nazarudin</td>
                                                                    <td>0851750213812</td>
                                                                    <td>Ponorogo / 10-2023</td>
                                                                    <td>D-III</td>
                                                                    <td>KARYAWAN SWASTA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Orang Tua - Ibu</td>
                                                                    <td>Idham Kohar Nazarudin</td>
                                                                    <td>0851750213812</td>
                                                                    <td>Ponorogo / 10-2023</td>
                                                                    <td>D-III</td>
                                                                    <td>KARYAWAN SWASTA</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Orang Tua - Ibu</td>
                                                                    <td>Idham Kohar Nazarudin</td>
                                                                    <td>08517502</td>
                                                                    <td>Ponorogo / 10-2023</td>
                                                                    <td>D-III</td>
                                                                    <td>KARYAWAN SWASTA</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Idham Kohar Nazarudin</td>
                                                                    <td>Orang Tua - Bapak</td>
                                                                    <td>Ponorogo</td>
                                                                    <td>085175021381 </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Idham Kohar Nazarudin</td>
                                                                    <td>Orang Tua - Ibu</td>
                                                                    <td>Ponorogo</td>
                                                                    <td>08888888888 </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
    </div>
    </div>




    <!-- BEGIN: JS Assets-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <link rel="preload" as="style" href="http://192.168.200.103:8000/build/assets/app.5f5283bb.css" />
    <link rel="modulepreload" href="http://192.168.200.103:8000/build/assets/app.148c76d2.js" />
    <link rel="modulepreload" href="http://192.168.200.103:8000/build/assets/_commonjsHelpers.d2428edb.js" />
    <link rel="stylesheet" href="http://192.168.200.103:8000/build/assets/app.5f5283bb.css" />
    <script type="module" src="http://192.168.200.103:8000/build/assets/app.148c76d2.js"></script> <!-- END: JS Assets-->
</body>

</html>
