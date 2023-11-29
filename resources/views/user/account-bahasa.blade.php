@extends('user.master.master-account')

@section('account-content')
<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Information -->
    <div class="intro-y box lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Data Kemampuan Bahasa</h2>
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
        <form method="POST" action="{{ route('account-bahasaStore') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="mt-3 mb-3" hidden>
                            <label for="update-profile-form-1" class="form-label">id_user</label>
                            <input id="update-profile-form-1" name="id_user" type="number" class="form-control" value="{{ Auth::id() }}">
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div class="col-span-2">
                                <div class="mt-1 mb-1">
                                    <label for="update-profile-form-1" class="form-label">Bahasa</label>
                                    <select id="update-profile-form-1" name="bahasa" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih Bahasa</option>
                                        @foreach($languages as $language)
                                        <option value="{{ $language->name }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bahasa')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="lisan" class="form-label">Lisan</label>
                                    <select id="lisan" name="lisan" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih salah satu</option>
                                        <option value="1">Kurang</option>
                                        <option value="2">Sedang</option>
                                        <option value="3">Mahir</option>
                                    </select>
                                    @error('lisan')
                                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="mt-1 mb-1">
                                    <label for="tulisan" class="form-label">Tulisan</label>
                                    <select id="tulisan" name="tulisan" data-search="true" class="tom-select w-full">
                                        <option value="" disabled selected>Pilih salah satu</option>
                                        <option value="1">Kurang</option>
                                        <option value="2">Sedang</option>
                                        <option value="3">Mahir</option>
                                    </select>
                                    @error('tulisan')
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
            <h2 class="font-medium text-base mr-auto">Data Kemampuan Bahasa</h2>
        </div>
        <div class="flex-1 mt-6 xl:mt-0">
            <div class="mt-1 mb-1">
                <div class="overflow-x-auto">
                    <table class="table table-report -mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">Bahasa</th>
                                <th class="whitespace-nowrap">Lisan</th>
                                <th class="whitespace-nowrap">Tulisan</th>
                                <th class="whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userPend as $index => $pendidikan)
                            <tr>
                                <td>{{ $pendidikan->bahasa }}</td>
                                <td>{{ $tingkatOptions[$pendidikan->lisan] }}</td>
                                <td>{{ $tingkatOptions[$pendidikan->tulisan] }}</td>
                                <td class="table-report__action w-56">
                                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview" data-pendidikan-id="{{ $pendidikan->id }}" class="btn btn-sm btn-primary">
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
<div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Edit Kemampuan Bahasa</h2>
                <a data-tw-dismiss="modal" href="javascript:;">
                    <i data-lucide="x" class="w-8 h-8 text-slate-400"></i>
                </a>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <form method="POST" action="{{ route('account-bahasaUpdate', $pendidikan->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="update-profile-form-1" class="form-label">Bahasa</label>
                        {{-- <select id="bahasa" name="bahasa" data-search="true" class="tom-select w-full">
                            @if ($pendidikan->bahasa)
                                <option value="{{ $pendidikan->bahasa }}" selected>{{ $pendidikan->bahasa }}</option>
                            @else
                                <option value="" disabled selected>Pilih Bahasa</option>
                                @foreach($languages as $language)
                                <option value="{{ $language->name }}">{{ $language->name }}</option>
                                @endforeach
                            @endif
                        </select> --}}
                        <select id="update-profile-form-1" name="bahasa" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Bahasa</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->name }}" @if (old('bahasa', $pendidikan->bahasa) == $language->name || $language->name == $pendidikan->bahasa) selected @endif>{{ $language->name }}</option>
                            @endforeach
                        </select>
                        @error('bahasa')
                            <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="lisan" class="form-label">Lisan</label>
                        <select id="lisan" name="lisan" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1" @if (old('lisan', $pendidikan->lisan) == 1) selected @endif>Kurang</option>
                            <option value="2" @if (old('lisan', $pendidikan->lisan) == 2) selected @endif>Sedang</option>
                            <option value="3" @if (old('lisan', $pendidikan->lisan) == 3) selected @endif>Mahir</option>
                        </select>
                        @error('lisan')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="tulisan" class="form-label">Tulisan</label>
                        <select id="tulisan" name="tulisan" data-search="true" class="tom-select w-full">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="1" @if (old('tulisan', $pendidikan->tulisan) == 1) selected @endif>Kurang</option>
                            <option value="2" @if (old('tulisan', $pendidikan->tulisan) == 2) selected @endif>Sedang</option>
                            <option value="3" @if (old('tulisan', $pendidikan->tulisan) == 3) selected @endif>Mahir</option>
                        </select>
                        @error('tulisan')
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
                    <form id="delete-form-{{ $pendidikan->id }}" method="POST" action="{{ route('account-bahasaDelete', $pendidikan->id) }}" style="display: inline;">
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
