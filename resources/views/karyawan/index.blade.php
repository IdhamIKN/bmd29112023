@extends('../layout/' . $layout)

@section('subhead')
<title>Data Karyawan - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">Data Karyawan</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
        <div class="flex w-full sm:w-auto">
            <form action="{{ route('searchkaryawan') }}" method="GET">
                <div class="w-48 relative text-slate-500">
                    <input type="text" name="query" class="form-control w-48 box pr-10" placeholder="Search by name...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </form>
        </div>
        {{-- <div class="hidden xl:block mx-auto text-slate-500">
            Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} of {{ $user->total() }} entries
        </div> --}}
        <div class="hidden xl:block mx-auto text-slate-500">
            @if($user->count() > 0)
                Showing {{ $user->firstItem() }} to {{ $user->lastItem() }} of {{ $user->total() }} entries
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
            {{-- <button class="btn btn-primary shadow-md mr-2">
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
            </div> --}}
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">
                        <input class="form-check-input" type="checkbox">
                    </th>
                    <th class="whitespace-nowrap">NAME</th>
                    <th class="whitespace-nowrap">GENDER</th>
                    <th class="whitespace-nowrap">DIVISI</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $index => $u)
                <tr class="intro-x">
                    <td class="w-10">
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td class="!py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 image-fit zoom-in">
                                {{-- <img alt="" class="rounded-lg border-1 border-white shadow-md tooltip" src="{{ asset('storage/' . $u->foto) }}"> --}}
                                @if (!empty($u) && !empty($u->foto))
                                <img class="rounded-md" alt="user-profile" src="{{ asset('storage/' . $u->foto) }}">
                                @else
                                <img class="rounded-md" alt="user-profile" src="{{ asset('build/assets/images/user.png') }}">
                                @endif
                            </div>
                            <div class="font-medium whitespace-nowrap ml-4">
                                <h6 class="mb-0 text-sm">{{ $u->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $u->nik }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap">
                        <a class="flex items-center underline decoration-dotted" href="javascript:;">{{ $jkOptions[$u->jk] }}</a>
                    </td>
                    <td class="whitespace-nowrap">
                        <h6 class="mb-0 text-sm">{{ $divisiOptions[$u->divisi] }}</h6>
                        <p class="text-xs text-secondary mb-0">{{ $u->penempatan }}</p>
                        {{-- <a class="flex items-center underline decoration-dotted" href="javascript:;">{{ $divisiOptions[$u->divisi] }}</a> --}}
                    </td>

                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            @can('karyawan-show', $u)
                                <a class="flex items-center text-primary whitespace-nowrap" href="{{ route('showeuser', ['id' => $u->id_user]) }}">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Details
                                </a>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    {{-- <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            @if($user->count() > 0)
                <ul class="pagination">
                    @if ($user->onFirstPage())
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
                            <a class="page-link" href="{{ $user->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevrons-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $user->previousPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $user->lastPage(); $i++)
                        <li class="page-item{{ $i == $user->currentPage() ? ' active' : '' }}">
                            <a class="page-link" href="{{ $user->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($user->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $user->nextPageUrl() }}">
                                <i class="w-4 h-4" data-lucide="chevron-right"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $user->nextPageUrl() }}">
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
            @if($user->count() > 0)
                <ul class="pagination">
                    <!-- First Page Link -->
                    <li class="page-item"><a class="page-link" href="{{ $user->url(1) }}"><i class="w-4 h-4" data-lucide="chevrons-left"></i></a></li>
    
                    <!-- Previous Page Link -->
                    @if ($user->onFirstPage())
                        <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-left"></i></span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $user->previousPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-left"></i></a></li>
                    @endif
    
                    <!-- Pagination Elements -->
                    @foreach ($user->getUrlRange(1, $user->lastPage()) as $page => $url)
                        <!-- "Three Dots" Separator -->
                        @if ($user->currentPage() < $page - 2 || $user->currentPage() > $page + 2)
                            @if ($user->currentPage() < $page - 2 && $page == $user->currentPage() + 3)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            @if ($user->currentPage() > $page + 2 && $page == $user->currentPage() - 3)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @else
                            <!-- Array Of Links -->
                            <li class="page-item{{ $page == $user->currentPage() ? ' active' : '' }}"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
    
                    <!-- Next Page Link -->
                    @if ($user->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $user->nextPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-right"></i></a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-right"></i></span></li>
                    @endif
    
                    <!-- Last Page Link -->
                    <li class="page-item"><a class="page-link" href="{{ $user->url($user->lastPage()) }}"><i class="w-4 h-4" data-lucide="chevrons-right"></i></a></li>
                </ul>
            @endif
        </nav>
    </div>
    <!-- END: Pagination -->
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="button" class="btn btn-danger w-24">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->

{{-- <script>
    function changePerPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var itemsPerPage = selectedOption.value;
        window.location.href = window.location.pathname + '?per_page=' + itemsPerPage;
    }
</script> --}}
{{-- <script>
    function changePerPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var itemsPerPage = selectedOption.value;

        // Send an AJAX request to update the session
        fetch('/update-items-per-page', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ per_page: itemsPerPage })
        }).then(function(response) {
            if (response.ok) {
                // Reload the page to apply the new items per page
                window.location.reload();
            } else {
                console.error('Failed to update items per page');
            }
        });
    }
</script> --}}
<script>
    function changePerPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var itemsPerPage = selectedOption.value;
        console.log('Selected items per page: ' + itemsPerPage);

        fetch('/sika/public/index.php/karyawan/update-items-per-page', {
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
