@extends('../layout/' . $layout)

@section('subhead')
<title>Data Punishment Karyawan - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">Data Punishment Karyawan</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
        <div class="flex w-full sm:w-auto">
            <div class="w-48 relative text-slate-500">
                @can('punishment-edit')
                <form action="{{ route('searchpunishment') }}" method="GET">
                    <div class="w-48 relative text-slate-500">
                        <input type="text" name="query" class="form-control w-48 box pr-10" placeholder="Search by name...">
                        <button type="submit" style="right: 0; top: 50%; transform: translateY(-50%);" class="w-4 h-4 absolute my-auto inset-y-0 mr-3">
                            <i class="w-4 h-4" data-lucide="search"></i>
                        </button>
                    </div>
                </form>
                @else
                @endcan
            </div>
        </div>
        <div class="hidden xl:block mx-auto text-slate-500">
            @if($punishment->count() > 0)
                Showing {{ $punishment->firstItem() }} to {{ $punishment->lastItem() }} of {{ $punishment->total() }} entries
             @else
                Tidak ada entri untuk ditampilkan.
            @endif
        </div>

        <div class="w-full xl:w-auto flex flex-wrap xl:flex-nowrap items-center gap-y-3 mt-3 xl:mt-0">
            <select class="w-20 form-select box mt-3 sm:mt-0" onchange="changePerPage(this)">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>30</option>
            </select>
        </div>
        {{-- <div class="w-full xl:w-auto flex flex-wrap xl:flex-nowrap items-center gap-y-3 mt-3 xl:mt-0">
            <button class="btn btn-primary shadow-md mr-2">
                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
            </button>
            <button class="btn btn-primary shadow-md mr-2">
                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
            </button>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="arrow-left-right" class="w-4 h-4 mr-2"></i> Change Status
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="bookmark" class="w-4 h-4 mr-2"></i> Bookmark
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
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
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">
                        <input class="form-check-input" type="checkbox">
                    </th>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="text-center whitespace-nowrap">PUNISHMENT</th>
                    <th class="text-center whitespace-nowrap">TANGGAL</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @if ($punishment)
                @foreach ($punishment as $index => $r)
                <tr class="intro-x">
                    <td class="w-10">
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td class="!py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 image-fit zoom-in">
                                <i data-lucide="file-text" class="w-10 h-10 image-fit zoom-in rounded-lg border-1 border-white shadow-md tooltip"></i>
                            </div>
                            <div class="font-medium whitespace-nowrap ml-4">
                                <h6 class="mb-0 text-sm">{{ $userMap[$r->karyawan]->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $userMap[$r->karyawan]->penempatan }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="text-center whitespace-nowrap">{{ $r->punishment }}</td>
                    <td class="text-center whitespace-nowrap">{{ date('d-m-Y', strtotime($r->tanggal)) }}</td>
                    <td class="table-report__action w-56 text-center whitespace-nowrap">
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#header-footer-modal-preview-{{ $r->id }}" data-pendidikan-id="{{ $r->id }}" class="btn btn-sm btn-primary">
                            @can('punishment-edit', $r)
                            <i data-lucide="edit" class="w-5 h-5"></i>
                            @else
                            <i data-lucide="eye" class="w-5 h-5"></i>
                            @endcan
                        </a>
                        @can('punishment-delete', $r)
                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-modal-preview-{{ $r->id }}" class="btn btn-sm btn-danger">
                            <i data-lucide="trash" class="w-5 h-5"></i>
                        </a>
                        @endcan
                    </td>
                </tr>
                @endforeach

                @else
                <p></p>
                @endif
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            @if($punishment->count() > 0)
                <ul class="pagination">
                    @if ($punishment->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                            </span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $punishment->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $punishment->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $punishment->lastPage(); $i++)
                        <li class="page-item{{ $i == $punishment->currentPage() ? ' active' : '' }}">
                            <a class="page-link" href="{{ $punishment->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($punishment->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $punishment->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $punishment->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link" aria-hidden="true">
                                <i class="w-4 h-4" data-lucide="chevrons-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            @else
            @endif
        </nav>
    </div> --}}
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            @if($punishment->count() > 0)
                <ul class="pagination">
                    <!-- First Page Link -->
                    <li class="page-item"><a class="page-link" href="{{ $punishment->url(1) }}"><i class="w-4 h-4" data-lucide="chevrons-left"></i></a></li>
    
                    <!-- Previous Page Link -->
                    @if ($punishment->onFirstPage())
                        <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-left"></i></span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $punishment->previousPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-left"></i></a></li>
                    @endif
    
                    <!-- Pagination Elements -->
                    @foreach ($punishment->getUrlRange(1, $punishment->lastPage()) as $page => $url)
                        <!-- "Three Dots" Separator -->
                        @if ($punishment->currentPage() < $page - 2 || $punishment->currentPage() > $page + 2)
                            @if ($punishment->currentPage() < $page - 2 && $page == $punishment->currentPage() + 3)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            @if ($punishment->currentPage() > $page + 2 && $page == $punishment->currentPage() - 3)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @else
                            <!-- Array Of Links -->
                            <li class="page-item{{ $page == $punishment->currentPage() ? ' active' : '' }}"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
    
                    <!-- Next Page Link -->
                    @if ($punishment->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $punishment->nextPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-right"></i></a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-right"></i></span></li>
                    @endif
    
                    <!-- Last Page Link -->
                    <li class="page-item"><a class="page-link" href="{{ $punishment->url($punishment->lastPage()) }}"><i class="w-4 h-4" data-lucide="chevrons-right"></i></a></li>
                </ul>
            @endif
        </nav>
    </div>
    <!-- END: Pagination -->
</div>
<!-- END: Data List -->

@if ($punishment)
@foreach ($punishment as $index => $pendidikan)
<!-- BEGIN: Modal Edit Content -->
<div id="header-footer-modal-preview-{{ $pendidikan->id }}" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    @can('punishment-edit', $pendidikan)
                    Edit Punishment
                    @else
                    View Punishment
                    @endcan
                </h2>
                <a data-tw-dismiss="modal" href="javascript:;">
                    <i data-lucide="x" class="w-8 h-8 text-slate-400"></i>
                </a>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            @can('punishment-edit', $pendidikan)
            <form method="POST" action="{{ route('punishment-update', $pendidikan->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="intro-y box p-5">
                    <div>
                        <label class="form-label">Pemberi</label>
                        <div class="dropdown">
                            <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-darkmode-800 dark:border-darkmode-800 flex items-center justify-start" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                                {{-- <div class="w-6 h-6 image-fit mr-3">
                                    <img class="rounded" alt="Midone - HTML Admin Template" src="{{ asset('storage/' . auth()->user()->foto) }}">
                                </div> --}}
                                <div class="truncate">{{ $userget[$pendidikan->pemberi]->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="post-form-2" class="form-label">Tanggal</label>
                        <input type="date" class=" form-control" name="tanggal" id="tanggal" data-single-mode="true" value="{{ old('tanggal', $pendidikan->tanggal ? date('Y-m-d', strtotime(optional($pendidikan)->tanggal)) : '') }}">
                        @error('tanggal')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="update-profile-form-7" class="form-label">Punishment</label>
                        <input id="update-profile-form-7" name="punishment" class="form-control" placeholder="Masukan jenis/nama Punishment" value="{{ old('punishment', $pendidikan->punishment) }}">
                        @error('punishment')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="post-form-3" class="form-label">Karyawan</label>
                        <input id="update-profile-form-7" disabled name="karyawan" class="form-control" value="{{ old('karyawan', $userMap[$pendidikan->karyawan]->name) }}">
                        @error('karyawan')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="update-profile-form-7" class="form-label">Keterangan</label>
                        <textarea id="update-profile-form-7" name="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="Input keterangan atau detail punishment">{{ old('ket', optional($pendidikan)->ket) }}</textarea>
                        @error('ket')
                        <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                </div>
            </form>
            @else
            <div class="intro-y box p-5">
                <div>
                    <label class="form-label">Pemberi</label>
                    <div class="dropdown">
                        <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-darkmode-800 dark:border-darkmode-800 flex items-center justify-start" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            {{-- <div class="w-6 h-6 image-fit mr-3">
                                <img class="rounded" alt="Midone - HTML Admin Template" src="{{ asset('storage/' . auth()->user()->foto) }}">
                            </div> --}}
                            <div class="truncate">{{ $userget[$pendidikan->pemberi]->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="post-form-2" class="form-label">Tanggal</label>
                    <input type="date" class=" form-control" disabled name="tanggal" id="tanggal" data-single-mode="true" value="{{ old('tanggal', $pendidikan->tanggal ? date('Y-m-d', strtotime(optional($pendidikan)->tanggal)) : '') }}">
                    @error('tanggal')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="update-profile-form-7" class="form-label">Punishment</label>
                    <input id="update-profile-form-7" disabled name="punishment" class="form-control" placeholder="Masukan jenis/nama Punishment" value="{{ old('punishment', $pendidikan->punishment) }}">
                    @error('punishment')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Karyawan</label>
                    <input id="update-profile-form-7" disabled disabled name="karyawan" class="form-control" value="{{ old('karyawan', $userMap[$pendidikan->karyawan]->name) }}">
                    @error('karyawan')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="update-profile-form-7" class="form-label">Keterangan</label>
                    <textarea id="update-profile-form-7" disabled name="ket" class="form-control @error('ket') is-invalid @enderror" placeholder="Input keterangan atau detail punishment">{{ old('ket', optional($pendidikan)->ket) }}</textarea>
                    @error('ket')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @endcan
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
                    <form id="delete-form-{{ $pendidikan->id }}" method="POST" action="{{ route('punishment-delete', $pendidikan->id) }}" style="display: inline;">
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
@else
<p></p>
@endif
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
    function changePerPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var itemsPerPage = selectedOption.value;
        console.log('Selected items per page: ' + itemsPerPage);

        fetch('/sika/public/index.php/punishment/update-items-per-page', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ per_page: itemsPerPage })
        }).then(function(response) {
            if (response.ok) {
                window.location.reload();
            } else {
                console.error('Failed to update items per page');
            }
        });
    }
</script>
@endsection
