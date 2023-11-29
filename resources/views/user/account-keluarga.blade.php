@extends('user.master.master-account')

@section('account-content')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Data Keluarga</h2>
        </div>
        @if (session('success'))
        <div role="alert" class="alert alert-success alert-dismissible show flex items-center mb-2">
            <i data-lucide="check-circle-2" class="w-6 h-6 mr-2"></i></i>
            <ul>
                {{ session('success') }}
                <button data-tw-dismiss="alert" type="button" aria-label="Close" class="text-slate-800 py-2 px-3 absolute right-0 my-auto mr-2 btn-close">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
        </div>
        @endif

        @if ($errors->any())
        <div role="alert" class="alert alert-danger alert-dismissible show flex items-center mb-2">
            <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i></i>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button data-tw-dismiss="alert" type="button" aria-label="Close" class="text-slate-800 py-2 px-3 absolute right-0 my-auto mr-2 btn-close">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        @endif
        <form method="POST" action="{{ route('account-keluargaStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="col-span-2">
                                <div class="mt-3 mb-3" hidden>
                                    <label for="update-profile-form-1" class="form-label">id_user</label>
                                    <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ old('id_user', Auth::id()) }}">
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-1" class="form-label">Hubungan</label>
                                    <select id="status" name="status" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Hubungan Keluarga</option>
                                        <option value="1"@if (old('status')==1) selected @endif>Orang Tua - Bapak</option>
                                        <option value="2"@if (old('status')==2) selected @endif>Orang Tua - Ibu</option>
                                        <option value="3"@if (old('status')==3) selected @endif>Mertua - Bapak</option>
                                        <option value="4"@if (old('status')==4) selected @endif>Mertua - Ibu</option>
                                        <option value="5"@if (old('status')==5) selected @endif>Suami</option>
                                        <option value="6"@if (old('status')==6) selected @endif>Istri</option>
                                        <option value="7"@if (old('status')==7) selected @endif>Anak</option>
                                        <option value="8"@if (old('status')==8) selected @endif>Sudara Kandung</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-2" class="form-label">Nama</label>
                                    <input id="nama" name="nama" class="form-control" placeholder="Input Nama Lengkap" value="{{ old('nama') }}">
                                    @error('nama')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-3" class="form-label">No. Hp</label>
                                    <input id="telp" name="telp" class="form-control" placeholder="Input Nomor HP aktif" value="{{ old('telp') }}">
                                    @error('telp')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-4" class="form-label">Tempat Lahir</label>
                                    <input id="tl" name="tl" type="text" class="form-control" placeholder="Input Tempat Lahir" value="{{ old('tl') }}">
                                    @error('tl')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-5" class="form-label">Tanggal Lahir</label>
                                    <input id="ttl" name="ttl" type="date" class="form-control" placeholder="Input Tanggal Lahir" value="{{ old('ttl') }}">
                                    @error('ttl')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Pendidikan</label>
                                    <select id="pendidikan" name="pendidikan" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Pendidikan</option>
                                        <option value="1" @if (old('pendidikan')==1) selected @endif>SD/MI</option>
                                        <option value="2" @if (old('pendidikan')==2) selected @endif>SMP/MTS</option>
                                        <option value="3" @if (old('pendidikan')==3) selected @endif>SMA/MA/SLTA/SMK</option>
                                        <option value="4" @if (old('pendidikan')==4) selected @endif>D-I</option>
                                        <option value="5" @if (old('pendidikan')==5) selected @endif>D-II</option>
                                        <option value="6" @if (old('pendidikan')==6) selected @endif>D-III</option>
                                        <option value="7" @if (old('pendidikan')==7) selected @endif>D-IV/S-1/Profesi</option>
                                        <option value="8" @if (old('pendidikan')==8) selected @endif>S-2/Spesialis</option>
                                        <option value="9" @if (old('pendidikan')==9) selected @endif>S-3</option>
                                        <option value="10" @if (old('pendidikan')==10) selected @endif>Tidak/Belum Sekolah</option>
                                    </select>
                                    @error('pendidikan')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <select id="pekerjaan" name="pekerjaan" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Pekerjaan</option>
                                        <option value="1" @if (old('pekerjaan')==1) selected @endif>WIRASWASTA</option>
                                        <option value="2" @if (old('pekerjaan')==2) selected @endif>KARYAWAN SWASTA</option>
                                        <option value="3" @if (old('pekerjaan')==3) selected @endif>PEDAGANG</option>
                                        <option value="4" @if (old('pekerjaan')==4) selected @endif>USTADZ / PENDAKWAH</option>
                                        <option value="5" @if (old('pekerjaan')==5) selected @endif>PEGAWAI NEGERI SIPIL</option>
                                        <option value="6" @if (old('pekerjaan')==6) selected @endif>ABRI / POLISI</option>
                                        <option value="7" @if (old('pekerjaan')==7) selected @endif>MENGURUS RUMAH TANGGA</option>
                                        <option value="8" @if (old('pekerjaan')==8) selected @endif>PETANI / PEKEBUN</option>
                                        <option value="9" @if (old('pekerjaan')==9) selected @endif>MAHASISWA/PELAJAR</option>
                                        <option value="10" @if (old('pekerjaan')==10) selected @endif>BURUH / HARIAN LEPAS</option>
                                        <option value="11" @if (old('pekerjaan')==11) selected @endif>BELUM / TIDAK BEKERJA</option>
                                        <option value="12" @if (old('pekerjaan')==12) selected @endif>PENSIUNAN</option>
                                        <option value="13" @if (old('pekerjaan')==13) selected @endif>PETERNAK</option>
                                        <option value="14" @if (old('pekerjaan')==14) selected @endif>BURUH TANI / PERKEBUNAN</option>
                                        <option value="15" @if (old('pekerjaan')==15) selected @endif>ASISTEN RUMAH TANGGA</option>
                                        <option value="16" @if (old('pekerjaan')==16) selected @endif>TUKANG CUKUR</option>
                                        <option value="17" @if (old('pekerjaan')==17) selected @endif>TUKANG LISTRIK</option>
                                        <option value="18" @if (old('pekerjaan')==18) selected @endif>TUKANG BATU</option>
                                        <option value="19" @if (old('pekerjaan')==19) selected @endif>TUKANG KAYU</option>
                                        <option value="20" @if (old('pekerjaan')==20) selected @endif>MEKANIK</option>
                                    </select>
                                    @error('pekerjaan')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
            </div>
        </form>
    </div>
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Data Keluarga</h2>
        </div>
        <div class="flex-1 mt-6 xl:mt-0">
            <div class="mt-1 mb-1">
                <div class="overflow-x-auto">
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Hubungan</th>
                                <th class="whitespace-nowrap">Nama</th>
                                <th class="whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userPend as $index => $pendidikan)
                            <tr>
                                <td>{{ $hubOptions[$pendidikan->status] }}</td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $pendidikan->nama }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $pendidikan->tl }} / {{ date('d-m-Y', strtotime($pendidikan->ttl)) }}</p>
                                    </div>
                                </td>
                                <td class="table-report__action w-56">
                                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-{{ $pendidikan->id }}" data-pendidikan-id="{{ $pendidikan->id }}" class="btn btn-sm btn-primary">
                                        <i data-lucide="edit" class="w-5 h-5"></i>
                                    </a>
                                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview-{{ $pendidikan->id }}" class="btn btn-sm btn-danger">
                                        <i data-lucide="trash" class="w-5 h-5"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($userPend as $index => $pendidikan)
<!-- BEGIN: Modal Edit Content -->
<div id="header-footer-modal-preview-{{ $pendidikan->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Edit Keluarga</h2>
                <a data-tw-dismiss="modal" href="javascript:;">
                    <i data-lucide="x" class="w-8 h-8 text-slate-400"></i>
                </a>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form method="POST" action="{{ route('account-keluargaUpdate', $pendidikan->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="update-profile-form-1" class="form-label">Hubungan</label>
                        <select id="status" name="status" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Hubungan Keluarga</option>
                            <option value="1" @if (old('status', $pendidikan->status) == 1) selected @endif>Orang Tua - Bapak</option>
                            <option value="2" @if (old('status', $pendidikan->status) == 2) selected @endif>Orang Tua - Ibu</option>
                            <option value="3" @if (old('status', $pendidikan->status) == 3) selected @endif>Mertua - Bapak</option>
                            <option value="4" @if (old('status', $pendidikan->status) == 4) selected @endif>Mertua - Ibu</option>
                            <option value="5" @if (old('status', $pendidikan->status) == 5) selected @endif>Suami</option>
                            <option value="6" @if (old('status', $pendidikan->status) == 6) selected @endif>Istri</option>
                            <option value="7" @if (old('status', $pendidikan->status) == 7) selected @endif>Anak</option>
                            <option value="8" @if (old('status', $pendidikan->status) == 8) selected @endif>Sudara Kandung</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="update-profile-form-2" class="form-label">Nama</label>
                        <input id="nama" name="nama" class="form-control" placeholder="Input Nama Lengkap" value="{{ old('nama', $pendidikan->nama) }}">
                        @error('nama')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="update-profile-form-3" class="form-label">No. Hp</label>
                        <input id="telp" name="telp" class="form-control" placeholder="Input Alamat Nomor Handphone" value="{{ old('telp', $pendidikan->telp) }}">
                        @error('telp')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="update-profile-form-4" class="form-label">Tempat Lahir</label>
                        <input id="tl" name="tl" type="text" class="form-control" placeholder="Input Tempat Lahir" value="{{ old('tl', $pendidikan->tl) }}">
                        @error('tl')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="update-profile-form-5" class="form-label">Tanggal Lahir</label>
                        <input id="ttl" name="ttl" type="date" class="form-control" placeholder="Input Tanggal Lahir" value="{{ old('ttl', $pendidikan->ttl ? date('Y-m-d', strtotime(optional($pendidikan)->ttl)) : '') }}">
                        @error('ttl')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12">
                        <label for="pendidikan" class="form-label">pendidikan Pendidikan</label>
                        <select id="pendidikan" name="pendidikan" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Pendidikan</option>
                            <option value="1" @if (old('pendidikan', $pendidikan->pendidikan) == 1) selected @endif>SD/MI</option>
                            <option value="2" @if (old('pendidikan', $pendidikan->pendidikan) == 2) selected @endif>SMP/MTS</option>
                            <option value="3" @if (old('pendidikan', $pendidikan->pendidikan) == 3) selected @endif>SMA/MA/SLTA/SMK/D1</option>
                            <option value="4" @if (old('pendidikan', $pendidikan->pendidikan) == 4) selected @endif>D-I</option>
                            <option value="5" @if (old('pendidikan', $pendidikan->pendidikan) == 5) selected @endif>D-II</option>
                            <option value="6" @if (old('pendidikan', $pendidikan->pendidikan) == 6) selected @endif>D-III</option>
                            <option value="7" @if (old('pendidikan', $pendidikan->pendidikan) == 7) selected @endif>D-IV/S-1/Profesi</option>
                            <option value="8" @if (old('pendidikan', $pendidikan->pendidikan) == 8) selected @endif>S-2/Spesialis</option>
                            <option value="9" @if (old('pendidikan', $pendidikan->pendidikan) == 9) selected @endif>S-3</option>
                            <option value="10" @if (old('pendidikan', $pendidikan->pendidikan) == 10) selected @endif>Tidak/Belum Sekolah</option>
                        </select>
                        @error('pendidikan')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <select id="pekerjaan" name="pekerjaan" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option value="1" @if (old('pekerjaan', $pendidikan->pekerjaan) == 1) selected @endif>WIRASWASTA</option>
                            <option value="2" @if (old('pekerjaan', $pendidikan->pekerjaan) == 2) selected @endif>KARYAWAN SWASTA</option>
                            <option value="3" @if (old('pekerjaan', $pendidikan->pekerjaan) == 3) selected @endif>PEDAGANG</option>
                            <option value="4" @if (old('pekerjaan', $pendidikan->pekerjaan) == 4) selected @endif>USTADZ / PENDAKWAH</option>
                            <option value="5" @if (old('pekerjaan', $pendidikan->pekerjaan) == 5) selected @endif>PEGAWAI NEGERI SIPIL</option>
                            <option value="6" @if (old('pekerjaan', $pendidikan->pekerjaan) == 6) selected @endif>ABRI / POLISI</option>
                            <option value="7" @if (old('pekerjaan', $pendidikan->pekerjaan) == 7) selected @endif>MENGURUS RUMAH TANGGA</option>
                            <option value="8" @if (old('pekerjaan', $pendidikan->pekerjaan) == 8) selected @endif>PETANI / PEKEBUN</option>
                            <option value="9" @if (old('pekerjaan', $pendidikan->pekerjaan) == 9) selected @endif>MAHASISWA/PELAJAR</option>
                            <option value="10" @if (old('pekerjaan', $pendidikan->pekerjaan) == 10) selected @endif>BURUH / HARIAN LEPAS</option>
                            <option value="11" @if (old('pekerjaan', $pendidikan->pekerjaan) == 11) selected @endif>BELUM / TIDAK BEKERJA</option>
                            <option value="12" @if (old('pekerjaan', $pendidikan->pekerjaan) == 12) selected @endif>PENSIUNAN</option>
                            <option value="13" @if (old('pekerjaan', $pendidikan->pekerjaan) == 13) selected @endif>PETERNAK</option>
                            <option value="14" @if (old('pekerjaan', $pendidikan->pekerjaan) == 14) selected @endif>BURUH TANI / PERKEBUNAN</option>
                            <option value="15" @if (old('pekerjaan', $pendidikan->pekerjaan) == 15) selected @endif>ASISTEN RUMAH TANGGA</option>
                            <option value="16" @if (old('pekerjaan', $pendidikan->pekerjaan) == 16) selected @endif>TUKANG CUKUR</option>
                            <option value="17" @if (old('pekerjaan', $pendidikan->pekerjaan) == 17) selected @endif>TUKANG LISTRIK</option>
                            <option value="18" @if (old('pekerjaan', $pendidikan->pekerjaan) == 18) selected @endif>TUKANG BATU</option>
                            <option value="19" @if (old('pekerjaan', $pendidikan->pekerjaan) == 19) selected @endif>TUKANG KAYU</option>
                            <option value="20" @if (old('pekerjaan', $pendidikan->pekerjaan) == 20) selected @endif>MEKANIK</option>
                        </select>
                        @error('pekerjaan')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                    <button type="submit" class="btn btn-primary w-20">Update</button>
                </div>
            </form>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<!-- END: Modal Edit Content -->

<!-- BEGIN: Modal Delete Content -->
<div id="delete-modal-preview-{{ $pendidikan->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Apakah Anda yakin?</div>
                    <div class="text-slate-500 mt-2">Apakah Anda ingin menghapus ini? <br>Data yang dihapus tidak dapat dikembalikan.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                    <form id="delete-form-{{ $pendidikan->id }}" method="POST" action="{{ route('account-pendidikanDelete', $pendidikan->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-24">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Modal Delete Content -->
@endforeach
<script>
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 10000);

    function showSuccessNotification() {
        var successNotification = document.getElementById("success-notification-content");
        successNotification.style.display = "flex";
    }

    function showFailedNotification() {
        var failedNotification = document.getElementById("failed-notification-content");
        failedNotification.style.display = "flex";
    }

</script>
<script>
    document.addEventListener('turbolinks:load', function() {
        setTimeout(function() {
            $('#button-modal-preview').modal('hide');
        }, 5000);
    });

</script>
<script>

    fetch('{{ route('reward-count') }}') 
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalReward').innerText = data.totalReward;
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
        fetch('{{ route('punishment-count') }}') 
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalPunishment').innerText = data.totalPunishment;
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
</script>
@endsection
