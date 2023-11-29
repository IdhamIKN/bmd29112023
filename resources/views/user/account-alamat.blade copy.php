@extends('user.master.master-account')

@section('account-content')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Alamat Information</h2>
        </div>
        <form method="POST" action="{{ route('account-alamat') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <p class="font-medium text-base mr-auto">Alamat Sesuai KTP</p>
                        <div class="mt-3 mb-3" hidden>
                            <label for="update-profile-form-1" class="form-label">id_user</label>
                            <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ Auth::id() }}">
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-2" class="form-label">Jenis</label>
                                    <select id="update-profile-form-3" name="jenis" data-search="true"city class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Jenis</option>
                                        <option value="1" {{ optional($userAddress)->jenis == 1 ? 'selected' : '' }}>Alamat Sesuai KTP</option>
                                        <option value="2" {{ optional($userAddress)->jenis == 2 ? 'selected' : '' }}>Alamat Domisili Sekarang</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                @php
                                $provinces = new App\Http\Controllers\DependantDropdownController;
                                $provinces = $provinces->provinces();
                                @endphp
                                <div class="mt-1 mb-1">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <select id="provinsi" name="provinsi" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Jenis</option>
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
                                        <option value="" disabled selected>Pilih Kota / Kabupaten</option>
                                        @foreach ($city as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" name="kec" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                        @foreach ($district as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                                    <select id="desa" name="desa" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Desa / Kelurahan</option>
                                        @foreach ($village as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-6" class="form-label">Kode Pos</label>
                                    <select id="update-profile-form-6" name="kodepos" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Jenis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-7" class="form-label">Alamat Lengkap</label>
                                    <textarea id="update-profile-form-7" name="alamat" class="form-control" value="{{ $userAddress->alamat ?? old('alamat') }}" placeholder="Input Alamat Lengkap"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-20 mt-3">Save</button>
            </div>
        </form>
    </div>
    <!-- END: Display Information -->
</div>


@endsection
