@extends('../layout/' . $layout)

@section('head')
<title>Register - Employee - BMD Syariah</title>
@endsection

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Register Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="" class="-intro-x flex items-center pt-5">
                <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                <span class="text-white text-lg ml-3">
                    Employee Data
                </span>
            </a>
            <div class="my-auto">
                <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-10" src="{{ asset('build/assets/images/illustration.svg') }}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign up to your account.</div>
                <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
            </div>
        </div>
        <!-- END: Register Info -->
        <!-- BEGIN: Register Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Import File</h2>
                <br>
                <form action="{{ route('importKDpos') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (session('success'))
                    <div class="text-green-500">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                    <div class="text-red-500">{{ session('error') }}</div>
                    @endif
                    {{-- <input type="file" name="csv_file"> --}}
                    <div>
                        <div class="mt-1 mb-1">
                            {{-- <label for="update-profile-form-6" class="form-label">Import File</label> --}}
                            <input type="file" id="update-profile-form-3" name="csv_file" class="form-control" placeholder="Input File">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20 mt-3">Import</button>
                </form>

                {{-- <form method="POST" action="{{ route('storeregister') }}">
                @csrf
                <label for="name">Nama Lengkap:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="nohp">No. Telepon:</label><br>
                <input type="text" id="nohp" name="nohp" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label for="password_confirmation">Konfirmasi Password:</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

                <input type="submit" value="Register">
                </form> --}}
            </div>

        </div>

    </div>
</div>

@endsection

