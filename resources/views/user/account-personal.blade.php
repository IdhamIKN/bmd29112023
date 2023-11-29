@extends('user.master.master-account')

@section('account-content')

<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Personal Information</h2>
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
        <form method="POST" action="{{ route('accountStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row ">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div class="mt-3 mb-3" hidden>
                                    <label for="update-profile-form-1" class="form-label">id_user</label>
                                    <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ Auth::id() }}">
                                </div>
                                <div class="mt-3 mb-3">
                                    <label for="update-profile-form-1" class="form-label">Nomor induk Karyawan</label>
                                    <input id="update-profile-form-1" name="nik" type="number" class="form-control" placeholder="Input Nomor Induk Karyawan" value="{{ $userPerson->nik ?? old('nik') }}">
                                    @error('nik')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3 mb-3">
                                    <label for="update-profile-form-2" class="form-label">Nama Lengkap</label>
                                    <input id="update-profile-form-2" name="name" type="text" class="form-control" placeholder="Input Nama Lengkap" value="{{ $userPerson->name ?? old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3 mb-3">
                                    <label for="update-profile-form-3" class="form-label">NIK (KTP)</label>
                                    <input id="update-profile-form-3" name="ktp" type="number" class="form-control" placeholder="Input Nomor Induk Kependudukan" value="{{ $userPerson->ktp ?? old('ktp') }}">
                                    @error('ktp')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2 mb-2">
                                    <label for="update-profile-form-4" class="form-label">Divisi</label>
                                    <select id="update-profile-form-9" name="divisi" data-search="true" class="tom-select w-full">
                                        <option value="1" {{ optional($userPerson)->divisi == 1 ? 'selected' : '' }}>Pusat</option>
                                        <option value="2" {{ optional($userPerson)->divisi == 2 ? 'selected' : '' }}>Simpan Pinjam</option>
                                        <option value="3" {{ optional($userPerson)->divisi == 3 ? 'selected' : '' }}>IT & Support System</option>
                                        <option value="4" {{ optional($userPerson)->divisi == 4 ? 'selected' : '' }}>BMD Garage</option>
                                        <option value="5" {{ optional($userPerson)->divisi == 5 ? 'selected' : '' }}>DC</option>
                                        <option value="6" {{ optional($userPerson)->divisi == 6 ? 'selected' : '' }}>BMD Mart</option>
                                        <option value="7" {{ optional($userPerson)->divisi == 7 ? 'selected' : '' }}>AMDK</option>
                                        <option value="8" {{ optional($userPerson)->divisi == 8 ? 'selected' : '' }}>BMD Car Wash</option>
                                        <option value="9" {{ optional($userPerson)->divisi == 9 ? 'selected' : '' }}>BMD Jadda</option>
                                    </select>
                                    @error('divisi')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-2 mb-2">
                                    <label for="update-profile-form-4" class="form-label">Penempatan</label>
                                    <input id="penempatan" name="penempatan" type="text" class="form-control" placeholder="Input Penempatan Sekarang" value="{{ $userPerson->penempatan ?? old('penempatan') }}">
                                    @error('penempatan')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                <img class="rounded-md" id="profile-image" alt="upload-user-profil" src="{{ $userPerson ? (asset('storage/' . $userPerson->foto) ?? asset('build/assets/images/user.png')) : asset('build/assets/images/user.png') }}">
                                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </div>
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <label for="foto" class="btn btn-primary w-full">Pilih Photo</label>
                                <input type="file" id="foto" name="foto" class="w-full h-full top-0 left-0 absolute opacity-0" onchange="showSelectedImage(this)">
                                @error('foto')
                                <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-7" class="form-label">Jenis Kelamin</label>
                            <select id="update-profile-form-7" name="jk" data-search="true" class="tom-select w-full">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="1" {{ optional($userPerson)->jk == 1 ? 'selected' : '' }}>Laki-laki</option>
                                <option value="2" {{ optional($userPerson)->jk == 2 ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-5" class="form-label">Tempat Lahir</label>
                            <input id="update-profile-form-5" name="tl" type="text" class="form-control" placeholder="Input Tempat Lahir" value="{{ $userPerson->tl ?? old('tl') }}">
                            @error('tl')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-6" class="form-label">Kewarganegaraan</label>
                            <input id="update-profile-form-6" name="warga" type="text" class="form-control" placeholder="Input Kewarganegaraan" value="{{ $userPerson->warga ?? old('warga') }}">
                            @error('warga')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-7" class="form-label">Golongan Darah</label>
                            <select id="update-profile-form-7" name="goldar" data-search="true" class="tom-select w-full">
                                <option value="" disabled selected>Pilih Golongan Darah</option>
                                <option value="1" {{ optional($userPerson)->goldar == 1 ? 'selected' : '' }}>A</option>
                                <option value="2" {{ optional($userPerson)->goldar == 2 ? 'selected' : '' }}>B</option>
                                <option value="3" {{ optional($userPerson)->goldar == 3 ? 'selected' : '' }}>AB</option>
                                <option value="4" {{ optional($userPerson)->goldar == 4 ? 'selected' : '' }}>O</option>
                            </select>
                            @error('goldar')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-8" class="form-label">Tanggal Lahir</label>
                            <input id="update-profile-form-8" name="ttl" type="date" class="form-control" placeholder="Input Tanggal Lahir" value="{{ optional($userPerson)->ttl ? date('Y-m-d', strtotime(optional($userPerson)->ttl)) : '' }}">
                            @error('ttl')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-9" class="form-label">Agama</label>
                            <select id="update-profile-form-9" name="agama" data-search="true" class="tom-select w-full">
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="1" {{ optional($userPerson)->agama == 1 ? 'selected' : '' }}>Islam</option>
                                <option value="2" {{ optional($userPerson)->agama == 2 ? 'selected' : '' }}>Kristen</option>
                                <option value="3" {{ optional($userPerson)->agama == 3 ? 'selected' : '' }}>Katolik</option>
                                <option value="4" {{ optional($userPerson)->agama == 4 ? 'selected' : '' }}>Hindu</option>
                                <option value="5" {{ optional($userPerson)->agama == 5 ? 'selected' : '' }}>Budha</option>
                                <option value="6" {{ optional($userPerson)->agama == 6 ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-2 mb-2">
                            <label for="update-profile-form-10" class="form-label">Status Perkawinan</label>
                            <select id="update-profile-form-10" name="stper" data-search="true" class="tom-select w-full">
                                <option value="" disabled selected>Pilih Status Perkawinan</option>
                                <option value="1" {{ optional($userPerson)->stper == 1 ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="2" {{ optional($userPerson)->stper == 2 ? 'selected' : '' }}>Kawin Belum Tercatat</option>
                                <option value="3" {{ optional($userPerson)->stper == 3 ? 'selected' : '' }}>Kawin Tercatat</option>
                                <option value="4" {{ optional($userPerson)->stper == 4 ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="5" {{ optional($userPerson)->stper == 5 ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('stper')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Simpan</button>
            </div>
        </form>
    </div>
    <!-- END: Display Information -->
</div>
<script>
    function showSelectedImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-image').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 10000);

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
