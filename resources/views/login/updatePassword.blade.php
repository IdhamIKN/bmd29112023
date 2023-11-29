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
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Ganti Password</h2>
                <div class="intro-x  mt-1 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                <div id="form-validation" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Validation Form -->
                        <form method="POST" action="{{ route('password.update') }}" >
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <input type="hidden" name="email" value="{{ request()->route('email') }}">
                            <div class="intro-x mt-6">
                                <div class="input-form">
                                    <label for="change-password-form-2" class="form-label">New Password</label>
                                    <input data-tw-merge id="new_password" type="password" name="new_password" class="intro-x   form-control py-3 px-4 block" placeholder="Password baru" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                            </div>
                            <div class="intro-x mt-6">
                                <div class="input-form">
                                    <label for="change-password-form-2" class="form-label">Konfirmasi Password</label>
                                    <input data-tw-merge id="new_password_confirmation" type="password" name="new_password_confirmation" class="intro-x   form-control py-3 px-4 block" placeholder="Konfirmasi Password" required="required" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 form-control form-control" />
                                </div>
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Kirim</button>
                                <p class="intro-x text-slate-500 block  mt-1 text-xs sm:text-sm">Kembali ? <a href="{{ route('login') }}" class="text-primary dark:text-slate-200 ml-1">Klik di sini</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- END: Register Form -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    // Fungsi untuk mengubah format nomor telepon
    document.getElementById("validation-form-4").addEventListener("input", function() {
        this.value = this.value.replace(/\D/g, "");

        if (this.value.startsWith("08")) {
            this.value = "+62" + this.value.slice(2);
        }
        if (this.value.length > 3) {
            this.value = this.value.replace(/(\d{3})(\d{4})(\d{4})/, "$1$2$3");
        }
    });

    // Fungsi untuk menampilkan notifikasi
    function onSubmit(pristine) {
        let valid = pristine.validate();

        if (valid) {
            Toastify({
                node: $("#success-notification-content")
                    .clone()
                    .removeClass("hidden")[0]
                , duration: 3000
                , newWindow: true
                , close: true
                , gravity: "top"
                , position: "right"
                , stopOnFocus: true
            , }).showToast();
        } else {
            Toastify({
                node: $("#failed-notification-content")
                    .clone()
                    .removeClass("hidden")[0]
                , duration: 3000
                , newWindow: true
                , close: true
                , gravity: "top"
                , position: "right"
                , stopOnFocus: true
            , }).showToast();
        }
    }

    // Inisialisasi validasi untuk setiap formulir dengan class "validate-form"
    $(".validate-form").each(function() {
        let pristine = new Pristine(this, {
            classTo: "input-form"
            , errorClass: "has-error"
            , errorTextParent: "input-form"
            , errorTextClass: "text-danger  mt-1"
        , });

        // Validasi tambahan untuk URL format jika diperlukan
        pristine.addValidator(
            $(this).find('input[type="url"]')[0]
            , function(value) {
                let expression =
                    /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&amp;//=]*)?/gi;
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            }
            , "This field is URL format only"
            , 2
            , false
        );

        // Menangani submit formulir
        $(this).on("submit", function(e) {
            e.preventDefault();
            onSubmit(pristine);
        });
    });
</script>

@endsection
