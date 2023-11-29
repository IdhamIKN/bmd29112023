@extends('../layout/' . $layout)

@section('head')
<title>Register - Employee - BMD Syariah</title>
@endsection

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Register Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="/" class="-intro-x flex items-center pt-5">
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
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign Up</h2>
                <div class="intro-x  mt-1 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                <div id="form-validation" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Validation Form -->
                        <form method="POST" action="{{ route('storeregister') }}" >
                            {{-- <form method="POST" action="{{ route('storeregister') }}" class="validate-form"> --}}
                            @csrf
                            <div class="intro-x mt-6">
                                <div class="input-form">
                                    <input data-tw-merge id="name" type="text" name="name" class="intro-x   form-control py-3 px-4 block" placeholder="Nama Lengkap" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                                <div class="input-form">
                                    <input data-tw-merge id="username" type="text" name="username" class="intro-x   form-control py-3 px-4 block  mt-1" placeholder="Username" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                                <div class="input-form">
                                    <input data-tw-merge id="email" type="email" name="email" class="intro-x   form-control py-3 px-4 block  mt-1" placeholder="Email" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                                <div class="input-form">
                                    <input data-tw-merge id="nohp" type="text" name="nohp" class="intro-x   form-control py-3 px-4 block  mt-1" placeholder="No. Telepon" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                                <div class="input-form">
                                    <input data-tw-merge id="password" type="password" name="password" class="intro-x   form-control py-3 px-4 block  mt-1" placeholder="Password" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                                <div class="input-form">
                                    <input data-tw-merge id="password_confirmation" type="password" name="password_confirmation" class="intro-x   form-control py-3 px-4 block  mt-1" placeholder="Password Confirmation" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                            </div>
                            <div class="intro-x flex items-center text-slate-600 dark:text-slate-500  mt-1 text-xs sm:text-sm">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                                <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                                <p class="intro-x text-slate-500 block  mt-1 text-xs sm:text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary dark:text-slate-200 ml-1">Masuk di sini</a></p>
                            </div>
                            <!-- END: Validation Form -->
                            <!-- BEGIN: Success Notification Content -->
                            <div id="success-notification-content" class="toastify-content hidden flex">
                                <i class="text-success" data-lucide="check-circle"></i>
                                <div class="ml-4 mr-4">
                                    <div class="font-medium">Registration success!</div>
                                    <div class="text-slate-500 mt-1">
                                        Silahkan Login ke Akun yang sudah terdaftar!
                                    </div>
                                </div>
                            </div>
                            <!-- END: Success Notification Content -->
                            <!-- BEGIN: Failed Notification Content -->
                            <div id="failed-notification-content" class="toastify-content hidden flex">
                                <i class="text-danger" data-lucide="x-circle"></i>
                                <div class="ml-4 mr-4">
                                    <div class="font-medium">Registration failed!</div>
                                    <div class="text-slate-500 mt-1">
                                        Please check the fileld form.
                                    </div>
                                </div>
                            </div>
                            <!-- END: Failed Notification Content -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
