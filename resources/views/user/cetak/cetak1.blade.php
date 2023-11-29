<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('css/materialize.css')}}">
    <title>Employee Management System</title>
    <style>
        td {
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
        }

    </style>
</head>
<body>
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Detail Karyawan</h2>
    </div>
    <!-- BEGIN: Profile Info -->

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">RESUME BIODATA KARYAWAN</h2>
    </div>
    <div class="tab-content mt-5">
        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                @if (!empty($userPerson) && !empty($userPerson[0]->foto))
                {{-- @dump($userPerson[0]->foto) --}}
                    <img class="rounded-md" alt="user-profile" src="{{ public_path('/storage/' . $userPerson[0]->foto) }}">
                @else
                    {{-- <img class="rounded-md" alt="user-profile" src="{{ public_path('build/assets/images/user.png') }}"> --}}
                    {{-- <img class="rounded-md" alt="user-profile" src="{{ public_path('storage/' . $userPerson[0]->foto)"> --}}

                @endif
                </div>
            </div>
        </div>
    </div>

</body>

</html>
