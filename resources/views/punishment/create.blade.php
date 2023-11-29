@extends('../layout/' . $layout)

@section('subhead')
<title>Add New Punishment - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Add New Punishment</h2>
</div>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Reward Info -->
    <div class="col-span-12 lg:col-span-8">
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
        <form method="POST" action="{{ route('punishment-store') }}" enctype="multipart/form-data">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label class="form-label">Pemberi</label>
                    <div class="dropdown">
                        <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-darkmode-800 dark:border-darkmode-800 flex items-center justify-start" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <div class="w-6 h-6 image-fit mr-3">
                                @if (!empty($userPerson) && !empty($userPerson->foto))
                                <img class="rounded" alt="user-profile" src="{{ asset('storage/' . $userPerson->foto) }}">
                                @else
                                <img class="rounded" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                                @endif
                                {{-- <img alt="user-profil" class="rounded-full" src="{{ asset('build/assets/images/user.png') }}"> --}}
                            </div>
                            <div class="truncate">{{ auth()->user()->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-3" hidden>
                    <input type="text" class="form-control" name="pemberi" id="pemberi" value="{{ auth()->user()->id }}">
                </div>
                <div class="mt-3">
                    <label for="post-form-2" class="form-label">Tanggal</label>
                    <input type="date" class=" form-control" name="tanggal" id="tanggal" data-single-mode="true">
                    @error('tanggal')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="update-profile-form-7" class="form-label">Punishment</label>
                    <input id="update-profile-form-7" name="punishment" class="form-control" placeholder="Masukan jenis/nama Punishment">
                    @error('punishment')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Karyawan</label>
                    <select data-placeholder="Pilih satu atau beberapa Karyawan" name="karyawan[]" class="tom-select w-full" id="post-form-3" multiple>
                        @foreach ($user as $userInfo)
                        <option value="{{ $userInfo->id }}">{{ $userInfo->nik }} - {{ $userInfo->name }}</option>
                        @endforeach
                    </select>
                    @error('karyawan')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="update-profile-form-7" class="form-label">Keterangan</label>
                    <textarea id="update-profile-form-7" name="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="Input keterangan atau detail reward"></textarea>
                    @error('ket')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
            </div>
        </form>
    </div>
    <!-- END: Reward Info -->
</div>
@endsection

@section('script')
@vite('resources/js/ckeditor-classic.js')
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
@endsection
