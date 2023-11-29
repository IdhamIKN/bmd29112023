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
                                @php
                                $provincesController = new App\Http\Controllers\DependantDropdownController;
                                $provincesData = $provincesController->provinces();
                                $provinces = json_decode($provincesData->getContent());
                                @endphp
                                <div class="mt-1 mb-1">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select id="provinsi" name="provinsi" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kota" class="form-label">Kota / Kabupaten</label>
                                    <select id="kota" name="kota" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" name="kecamatan" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                                    <select id="desa" name="desa" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Desa</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-6" class="form-label">Kode Pos</label>
                                    <select id="update-profile-form-6" name="kodepos" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Kode Pos</option>
                                        @foreach ($alamat as $item)
                                            <option value="{{ $item->code }}">{{ $item->postal }}</option>
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
    function onChangeSelect(url, id, name) {
        console.log(`Fetching: ${url}?id=${id}`);

        fetch(url + '?id=' + id, {
                method: 'GET'
                , headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                const kotaSelect = document.getElementById(name);

                kotaSelect.innerHTML = '';

                for (const key in data) {
                    if (data.hasOwnProperty(key)) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = data[key];
                        kotaSelect.appendChild(option);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const kecamatanSelect = document.getElementById('kecamatan');

        provinsiSelect.addEventListener('change', function() {
            onChangeSelect('{{ route("cities") }}', provinsiSelect.value, 'kota');
        });

        kotaSelect.addEventListener('change', function() {
            onChangeSelect('{{ route("districts") }}', kotaSelect.value, 'kecamatan');
        });

        kecamatanSelect.addEventListener('change', function() {
            onChangeSelect('{{ route("villages") }}', kecamatanSelect.value, 'desa');
        });
    });

</script>



@endsection
