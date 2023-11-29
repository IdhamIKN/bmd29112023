@extends('user.master.master')

@section('profil-content')
<!-- END: Profile Info -->
<div class="tab-content mt-5">
    <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 lg:col-span-10">
                <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                    <form method="POST" action="{{ route('update.password') }}">
                        @csrf
                        <!-- BEGIN: Change Password -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="font-medium text-base mr-auto">Change Password</h2>
                            </div>
                            <div class="p-5">
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
                                    <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach

                                        @if (session('error'))
                                        <li>{{ session('error') }}</li>
                                        @endif
                                    </ul>
                                    <button data-tw-dismiss="alert" type="button" aria-label="Close" class="text-slate-800 py-2 px-3 absolute right-0 my-auto mr-2 btn-close">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                                @endif

                                <div>
                                    <label for="change-password-form-1" class="form-label">Old Password</label>
                                    <input id="change-password-form-1" name="old_password" type="password" class="form-control" placeholder="Input text">
                                    @error('old_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <label for="change-password-form-2" class="form-label">New Password</label>
                                    <input id="change-password-form-2" name="new_password" type="password" class="form-control" placeholder="New Password">

                                    @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <label for="change-password-form-3" class="form-label">Confirm New Password</label>
                                    <input id="change-password-form-3" name="new_password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">

                                    @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Change Password</button>
                            </div>
                        </div>
                        <!-- END: Change Password -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
