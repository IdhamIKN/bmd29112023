@extends('../layout/' . $layout)

@section('subhead')
<title>Permission Data List - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">Permission Data List Layout</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('permission.create') }}" class="btn btn-primary shadow-md mr-2">Add New Permission</a>
        <div class="flex w-full sm:w-auto">
            <form action="{{ route('searchpermission') }}" method="GET">
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
            @if($permissions->count() > 0)
                Showing {{ $permissions->firstItem() }} to {{ $permissions->lastItem() }} of {{ $permissions->total() }} entries
            @else
                Tidak ada entri untuk ditampilkan.
            @endif
        </div>


        <div class="w-full xl:w-auto flex flex-wrap xl:flex-nowrap items-center gap-y-3 mt-3 xl:mt-0">
            <select class="w-20 form-select box mt-3 sm:mt-0" onchange="changePerPage(this)">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>10</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>20</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>30</option>
                <option value="30" {{ $perPage == 30 ? 'selected' : '' }}>50</option>
            </select>
        </div>
    </div>
</div>
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
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
        <tbody>
            @foreach (array_slice($fakers, 0, 9) as $faker)
            @endforeach
        </tbody>
    </table>
</div>
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report -mt-2" id="user-table">
        <thead>
            <tr>
                <th class="whitespace-nowrap">IMAGES</th>
                <th class="whitespace-nowrap">Permission Name</th>
                <th class="whitespace-nowrap">Roles</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
            <tr class="intro-x">
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="Midone - HTML Admin Template" class="tooltip rounded-full" src="{{ asset('build/assets/images/' . $faker['images'][0]) }}" title="Uploaded at {{ $faker['dates'][0] }}">
                        </div>
                    </div>
                </td>
                <td>
                    <a href="#" class="font-medium whitespace-nowrap">{{ $permission->name }}</a>
                </td>
                <td>
                    <a href="#" class="font-medium whitespace-nowrap">{{ $permission->roles->implode('name', ', ') }}</a>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="{{ route('permission.edit', $permission) }}">
                            <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                        <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
    <nav class="w-full sm:w-auto sm:mr-auto">
        @if($permissions->count() > 0)
            <ul class="pagination">
                <!-- First Page Link -->
                <li class="page-item"><a class="page-link" href="{{ $permissions->url(1) }}"><i class="w-4 h-4" data-lucide="chevrons-left"></i></a></li>

                <!-- Previous Page Link -->
                @if ($permissions->onFirstPage())
                    <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-left"></i></span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $permissions->previousPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-left"></i></a></li>
                @endif

                <!-- Pagination Elements -->
                @foreach ($permissions->getUrlRange(1, $permissions->lastPage()) as $page => $url)
                    <!-- "Three Dots" Separator -->
                    @if ($permissions->currentPage() < $page - 2 || $permissions->currentPage() > $page + 2)
                        @if ($permissions->currentPage() < $page - 2 && $page == $permissions->currentPage() + 3)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                        @if ($permissions->currentPage() > $page + 2 && $page == $permissions->currentPage() - 3)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                        @endif
                    @else
                        <!-- Array Of Links -->
                        <li class="page-item{{ $page == $permissions->currentPage() ? ' active' : '' }}"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($permissions->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $permissions->nextPageUrl() }}"><i class="w-4 h-4" data-lucide="chevron-right"></i></a></li>
                @else
                    <li class="page-item disabled"><span class="page-link"><i class="w-4 h-4" data-lucide="chevron-right"></i></span></li>
                @endif

                <!-- Last Page Link -->
                <li class="page-item"><a class="page-link" href="{{ $permissions->url($permissions->lastPage()) }}"><i class="w-4 h-4" data-lucide="chevrons-right"></i></a></li>
            </ul>
        @endif
    </nav>
</div>


</div>

<div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="delete-form" action="{{ route('permission.destroy', $permission) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-slate-500 mt-2">Do you really want to delete these records? <br>This process cannot be undone.</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-danger w-24">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function changePerPage(select) {
        var selectedOption = select.options[select.selectedIndex];
        var itemsPerPage = selectedOption.value;
        console.log('Selected items per page: ' + itemsPerPage);

        fetch('/sika/public/index.php/permissionupdate-items-per-page', {
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
