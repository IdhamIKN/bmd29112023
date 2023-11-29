@extends('../layout/' . $layout)

@section('subhead')
<title>Form Tambah Role - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form tambah Role</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Role Name</label>
                    <input id="crud-form-1" name="name" id="name" type="text" class="form-control w-full" placeholder="Input Role Name">
                    @error('name')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Permission</label>
                    <br>
                    @foreach ($permissions as $id => $name)
                    <input type="checkbox" name="permissions[]" id="permission-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('permissions', [])))>
                    <label class="text-sm font-medium text-gray-700" for="permission-{{ $id }}">{{ $name }}</label>
                    <br />
                    @endforeach
                </div> --}}
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Permission</label>
                    <select data-placeholder="Pilih satu atau Permission" name="permissions[]" class="tom-select w-full" id="post-form-3" multiple>
                        <option value="select-all">Select All</option>
                        @foreach ($izin as $id => $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @error('permission')
                    <div class="invalid-feedback" style="color: red;">*{{ $message }}</div>
                    @enderror
                </div>


                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </form>
        <!-- END: Form Layout -->
    </div>
</div>

<script>
    // Fungsi untuk menangani perubahan pemilihan "Select All"
    function selectAllOptions(select) {
        var options = select.options;
        for (var i = 0; i < options.length; i++) {
            options[i].selected = true;
        }
    }

    // Menambahkan event listener ke elemen select
    var selectElement = document.getElementById("post-form-3");
    selectElement.addEventListener("change", function () {
        if (selectElement.value === "select-all") {
            selectAllOptions(selectElement);
        }
    });
</script>
@endsection

@section('script')
@vite('resources/js/ckeditor-classic.js')
@endsection
