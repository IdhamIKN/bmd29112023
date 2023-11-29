<!DOCTYPE html>
<html lang="en">

<head>
    <title>Curriculum vitae</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    {{-- <style>
        /* GENERAL */
        * {
            margin: 0;
            box-sizing: border-box;
        }

        /* @font-face {
        font-family: 'Helvetica';
        font-style: normal;
        font-weight: normal;
        src: url('{{ public_path('fonts/Helvetica.ttf') }}') format('truetype');
    } */
    body {
    font-family: 'Helvetica', sans-serif;
    }

    a {
    text-decoration: none;
    color: #4472C4;
    }

    a:hover {
    text-decoration: underline;
    }

    p {
    margin: 0 0 1rem;
    }

    h1 {
    margin: 0 0 1rem;
    font-size: 2.5rem;
    margin-bottom: .5rem;
    }

    h2 {
    margin: 0 0 1rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    }

    .text-blue {
    color: #04954c;
    }

    .text-darkblue {
    color: #002060;
    }

    .text-uppercase {
    text-transform: uppercase;
    }

    .icon {
    margin-right: .5rem;
    }

    .cv-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-areas: "left-column right-column right-column";
    width: 1200px;
    margin: 100px auto;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    }

    .section {
    margin-bottom: 1.5rem;
    }

    /* LEFT COLUMN */
    .left-column {
    grid-area: left-column;
    padding: 50px;
    background-color: #04954c;
    color: white;
    }

    .portait {
    border-radius: 50%;
    max-width: 150px;
    margin: auto;
    display: block;
    margin-bottom: 50px;
    }

    .skills {
    list-style-type: none;
    padding: 0;
    font-size: 1.1rem;
    letter-spacing: 1px;
    margin: 0 0 1rem;
    }

    /* RIGHT COLUMN */
    .right-column {
    grid-area: right-column;
    display: grid;
    grid-template-rows: 250px 1fr;
    grid-template-areas:
    "header"
    "content";
    }

    /* HEADER */
    .header {
    grid-area: header;
    padding: 50px;
    background-color: #F2F2F2;
    display: flex;
    flex-direction: column;
    justify-content: center;
    }

    .infos {
    columns: 2;
    list-style-type: none;
    padding: 0;
    }

    /* CONTENT */
    .content {
    grid-area: content;
    padding: 50px;
    }

    .experience-list {
    list-style-type: circle;
    }

    </style> --}}
    <style>
        /* GENERAL */
        * {
            margin: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            /* background-color: #4CAF50; */
            color: rgb(5, 5, 5);
            border-bottom: 2px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }


        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px
        }

        a {
            text-decoration: none;
            color: #4472C4;
            font-size: 12px
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin: 0 0 1rem;
            font-size: 12px
        }

        h1 {
            margin: 0 0 1rem;
            /* font-size: 2.5rem; */
            font-size: 16px;
            margin-bottom: .5rem;
        }

        h2 {
            margin: 0 0 1rem;
            letter-spacing: 1px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .text-blue {
            color: #04954c;
        }

        .text-darkblue {
            color: #002060;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .icon {
            margin-right: .5rem;
        }

        .cv-container {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-areas: "left-column right-column right-column";
            width: 210mm;
            height: 297mm;
            margin: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .section {
            margin-bottom: 1.0rem;
        }

        /* LEFT COLUMN */
        .left-column {
            grid-area: left-column;
            padding: 30px;
            background-color: #04954c;
            color: white;
        }

        .portait {
            border-radius: 50%;
            max-width: 150px;
            margin: auto;
            display: block;
            margin-bottom: 50px;
        }

        .skills {
            list-style-type: none;
            padding: 0;
            font-size: 12px;
            letter-spacing: 1px;
            margin: 0 0 1rem;
        }

        /* RIGHT COLUMN */
        .right-column {
            grid-area: right-column;
            display: grid;
            grid-template-rows: 250px 1fr;
            grid-template-areas:
                "header"
                "content";
            font-size: 12px;
        }

        /* HEADER */
        .header {
            grid-area: header;
            padding: 30px;
            background-color: #F2F2F2;
            display: flex;
            font-size: 18px;
            flex-direction: column;
            justify-content: center;
        }

        .infos {
            columns: 2;
            list-style-type: none;
            padding: 0;
            font-size: 12px;
        }

        /* CONTENT */
        .content {
            grid-area: content;
            padding: 30px;
        }

        .experience-list {
            list-style-type: circle;
            font-size: 12px;
        }

    </style>

</head>

<body>
    <div class="cv-container">
        <div class="left-column">
            <p style="text-align: center;">RESUME BIODATA KARYAWAN</p>
            @if (!empty($foto) && !empty($foto[0]->foto))
            <img class="portait" src="{{ public_path('/storage/' . $foto[0]->foto) }}" width="160" height="211">
            @else
            @endif
            <div class="section">
                @if (!empty($userPerson))
                @foreach ($userPerson as $userPerson)
                <div style="text-align: center;">
                    <div class="">
                        <font>
                            <u>{{ $userPerson->name }}</u>
                        </font>
                    </div>
                    <font class="text-center">
                        {{ $userPerson->nik }}
                    </font>
                </div>
                @endforeach
                @else
                @endif
            </div>

            <div class="section">
                @if (!empty($useralamat) && count($useralamat) > 0)
                <h4><i class="icon fas fa-check-circle text-darkblue"></i>Informasi Alamat</h4>
                <ul class="experience-list" p>
                    <li>
                        <strong>{{ $jenisOptions[$useralamat->first()->jenis] }}</strong>
                        <br>
                        {{ $useralamat->first()->alamat }}, {{ $useralamat->first()->desa }}, {{ $useralamat->first()->kecamatan }}, {{ $useralamat->first()->kota }},{{ $useralamat->first()->provinsi }}. <em>{{ $useralamat->first()->kodepos }}.</em>
                    </li>
                </ul>
                @else
                @endif
            </div>
            <div class="section">
                @if (!empty($userbahasa) && count($userbahasa) > 0)
                <h4><i class="icon fas fa-check-circle text-darkblue"></i>Bahasa</h4>
                <ul class="experience-list">
                    @foreach ($userbahasa as $index => $pendidikan)
                    <li><strong>{{ $pendidikan->bahasa }}</strong> &#124;
                        Lisan {{ $tingkatOptions[$pendidikan->lisan] }} &#124;
                        Tulisan {{ $tingkatOptions[$pendidikan->tulisan] }}
                    </li>
                    @endforeach
                </ul>
                @else
                @endif
            </div>
            <div class="section">
                <h4><i class="icon fas fa-check-circle text-darkblue"></i>Pendidikan Non-Formal</h4>
                @if (!empty($userPendFrm) && count($userPendFrm) > 0)
                @foreach ($userPendFrm as $index => $pendidikan)

                <ul class="experience-list">
                    <li>
                        <p>
                            <strong>{{ $pendidikan->lembaga }}, {{ $pendidikan->kota }}</strong>
                            <br>
                            Sertifikat: {{ $pendidikan->sertif }}<br>
                            Tahun: {{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }} ( {{ $statusOptions[$pendidikan->status] }})<br>
                        </p>
                    </li>
                </ul>
                @endforeach
                @endif
            </div>
            <div class="section">
                <h4><i class="icon fas fa-check-circle text-darkblue"></i>Kontak Darurat</h4>
                @if (!empty($userkontak) && count($userkontak) > 0)
                <ul>
                    @foreach ($userkontak as $index => $pendidikan)
                    <li>
                        <strong>{{ $hubOptions[$pendidikan->hubungan] }} :</strong><br>
                        <strong>{{ $pendidikan->nama }}</strong> ({{ $pendidikan->telp }})<br>
                        {{ $pendidikan->alamat }}<br>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="text-slate-500">
                </div>
                @endif
            </div>
        </div>
        <div class="right-column">
            @if (!empty($userPerson))
            <div class="header">
                <h1>BMD SYARIAH</h1>
                <p>{{ $divisiOptions[$userPerson->divisi] }} / {{ $userPerson->penempatan }}</p>
                <ul class="infos">
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $userPerson->ktp }}</li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $userPerson->tl }}, {{ date('d F Y', strtotime($userPerson->ttl)) }} </li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $kawinOptions[$userPerson->stper] }}</li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $userPerson->warga }}</li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $agamaOptions[$userPerson->agama] }}</li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $goldarOptions[$userPerson->goldar] }}</li>
                    <li><i class="icon fas fa-check-circle text-darkblue"></i> {{ $jkOptions[$userPerson->jk] }}</li>
                </ul>
            </div>
            @else
            @endif
            <div class="content">
                <div class="section">
                    <h2>Riwayat <span class="text-blue">Pendidikan</span></h2>
                    @if (!empty($userPend) && count($userPend) > 0)
                    @foreach ($userPend as $pendidikan)
                    <p>
                        <strong>{{ $jenjangOptions[$pendidikan->jenjang] }}</strong>
                        <br>
                        {{ date('m-Y', strtotime($pendidikan->mulai)) }} / {{ date('m-Y', strtotime($pendidikan->selesai)) }}
                    </p>
                    <ul class="experience-list">
                        <li>
                            Sekolah/Universitas: {{ $pendidikan->jurusan }}, {{ $pendidikan->sekolah }}<br>
                            Nilai/IPK: {{ $pendidikan->ipk }} / {{ $statusOptions[$pendidikan->status] }}<br>
                        </li>
                        <br>
                    </ul>
                    @endforeach
                    @endif
                </div>
                <div class="section">
                    <h2>Jenjang <span class="text-blue">Karier</span></h2>
                    @if (!empty($userorganisasi) && count($userorganisasi) > 0)
                    @foreach ($userorganisasi as $index => $pendidikan)
                    <ul class="experience-list">
                        <li>
                            {{ $pendidikan->organisasi }}
                        </li>
                        <br>
                    </ul>
                    @endforeach
                    @endif
                </div>
                <div class="section">
                    <h2>Data <span class="text-blue">Keluarga</span></h2>
                    @if (!empty($userkeluarga) && count($userkeluarga) > 0)
                    @foreach ($userkeluarga as $index => $pendidikan)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">
                                    Nama
                                </th>
                                <th class="whitespace-nowrap">
                                    Tempat Lahir
                                </th>
                                <th class="whitespace-nowrap">
                                    No.Hp
                                </th>
                                <th class="whitespace-nowrap">
                                    Pekerjaan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userkeluarga as $index => $pendidikan)
                            <tr>
                                <td>
                                   {{ $pendidikan->nama }}
                                </td>
                                <td>
                                    {{ $pendidikan->tl }}, {{ date('d-m-Y', strtotime($pendidikan->ttl)) }}
                                </td>
                                <td>
                                    {{ $pendidikan->telp }}
                                </td>
                                <td>
                                    {{ $jobOptions[$pendidikan->pekerjaan] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
