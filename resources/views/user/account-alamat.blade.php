@extends('user.master.master-account')

@section('account-content')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Alamat Information</h2>
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
        <form method="POST" action="{{ route('account-alamatStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="mt-3 mb-3" hidden>
                            <label for="update-profile-form-1" class="form-label">id_user</label>
                            <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ old('id_user', Auth::id()) }}">
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-2" class="form-label">Jenis</label>
                                    <select id="update-profile-form-2" name="jenis" data-search="true" class="tom-select w-full @error('jenis') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        <option value="1" {{ optional($userAddress)->jenis == 1 ? 'selected' : '' }}>Alamat Sesuai KTP</option>
                                        <option value="2" {{ optional($userAddress)->jenis == 2 ? 'selected' : '' }}>Alamat Domisili Sekarang</option>
                                    </select>
                                    @error('jenis')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-6" class="form-label">Kode Pos</label>
                                    <select id="update-profile-form-6" name="kodepos" data-search="true" class="tom-select w-full @error('kodepos') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih Kode Pos</option>
                                        @foreach ($alamat as $item)
                                        <option value="{{ $item->postal }}" {{ old('kodepos', optional($userAddress)->kodepos) == $item->postal ? 'selected' : '' }}>{{ $item->postal }}</option>
                                        @endforeach
                                    </select>
                                    @error('kodepos')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <div class="mt-1 mb-1">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input id="provinsi" name="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" value="{{ old('provinsi', optional($userAddress)->provinsi) }}">
                                        @error('provinsi')
                                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @error('mulai')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-1 mb-1">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input id="kecamatan" name="kecamatan" type="text" class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan', optional($userAddress)->kecamatan) }}">
                                    @error('kecamatan')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="kota" class="form-label">Kota / Kabupaten</label>
                                    <input id="kota" name="kota" type="text" class="form-control @error('kota') is-invalid @enderror" value="{{ old('kota', optional($userAddress)->kota) }}">
                                    @error('kota')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                                    <input id="desa" name="desa" type="text" class="form-control @error('desa') is-invalid @enderror" value="{{ old('desa', optional($userAddress)->desa) }}">
                                    @error('desa')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 mb-1">
                            <label for="update-profile-form-7" class="form-label">Alamat Lengkap</label>
                            <textarea id="update-profile-form-7" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Input Alamat Lengkap">{{ old('alamat', optional($userAddress)->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
            </div>
        </form>
    </div>
    <!-- END: Display Information -->
</div>
<script>
    document.getElementById('update-profile-form-6').addEventListener('change', function() {
        var kodepos = this.value;

        fetch('/getAlamat?kodepos=' + kodepos)
            .then(response => response.json())
            .then(data => {
                console.log('Data server:', data);
                document.getElementById('provinsi').value = data.provinsi;
                document.getElementById('kota').value = data.kota;
                document.getElementById('kecamatan').value = data.kecamatan;
                // document.getElementById('desa').value = data.desa;
            });
    });

</script>
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
