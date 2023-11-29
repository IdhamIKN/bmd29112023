@extends('user.master.master-account')

@section('account-content')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Alamat Information</h2>
        </div>
        <form method="POST" action="{{ route('account-alamatStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="mt-3 mb-3" hidden>
                            <label for="update-profile-form-1" class="form-label">id_user</label>
                            <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ Auth::id() }}">
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-2" class="form-label">Jenis</label>
                                    <select id="update-profile-form-2" name="jenis" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        <option value="1" {{ optional($userAddress)->jenis == 1 ? 'selected' : '' }}>Alamat Sesuai KTP</option>
                                        <option value="2" {{ optional($userAddress)->jenis == 2 ? 'selected' : '' }}>Alamat Domisili Sekarang</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input id="provinsi" name="provinsi" type="text" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kota" class="form-label">Kota / Kabupaten</label>
                                    <input id="kota" name="kota" type="text" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <input id="kecamatan" name="kecamatan" type="text" class="form-control">
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                                    <input id="desa" name="desa" type="text" class="form-control">
                                </div>
                            </div>

                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select id="provinsi" name="provinsi" class="form-control"></select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kota" class="form-label">Kota / Kabupaten</label>
                                    <select id="kota" name="kota" class="form-control"></select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" name="kecamatan" class="form-control"></select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                                    <select id="desa" name="desa" class="form-control"></select>
                                </div>
                            </div>

                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-6" class="form-label">Kode Pos</label>
                                    <select id="update-profile-form-6" name="kodepos" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Kode Pos</option>
                                        @foreach ($alamat as $item)
                                        <option value="{{ $item->postal }}">{{ $item->postal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-2">
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-7" class="form-label">Alamat Lengkap</label>
                                    <textarea id="update-profile-form-7" name="alamat" class="form-control" placeholder="Input Alamat Lengkap">{{ $userAddress->alamat ?? old('alamat') }}</textarea>
                                </div>
                            </div>
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
                document.getElementById('desa').value = data.desa;
            });

            window.onload = function() {
    fetch('/getVillage?kodepos=' + kodepos)
        .then(response => response.json())
        .then(data => {
            console.log('Data server:', data);
            let provinsiSelect = document.getElementById('provinsi');
            let kotaSelect = document.getElementById('kota');
            let kecamatanSelect = document.getElementById('kecamatan');
            let desaSelect = document.getElementById('desa');

            // Menghapus opsi sebelumnya
            provinsiSelect.innerHTML = '';
            kotaSelect.innerHTML = '';
            kecamatanSelect.innerHTML = '';
            desaSelect.innerHTML = '';

            data.forEach((item, index) => {
                console.log(`Data ${index + 1}:`, item);
                // Anda bisa memproses setiap item di sini, misalnya:
                provinsiSelect.options.add(new Option(item.province, item.province));
                kotaSelect.options.add(new Option(item.city, item.city));
                kecamatanSelect.options.add(new Option(item.district, item.district));
                desaSelect.options.add(new Option(item.village, item.village));
            });
        });
}

    });

</script>

@endsection
