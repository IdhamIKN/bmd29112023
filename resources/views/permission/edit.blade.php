@extends('../layout/' . $layout)

@section('subhead')
<title>Form Edit Role - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form Edit Role</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <form action="{{ route('permission.update', $permission) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Permission Name</label>
                    <input id="crud-form-1" name="name" id="name" value="{{ $permission->name ?? old('name') }}" type="text" class="form-control w-full" placeholder="Input Role Name">
                </div>
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Roles</label>
                    <select data-placeholder="Pilih satu atau lebih Role" name="roles[]" class="tom-select w-full" id="post-form-3" multiple>
                        <option value="select-all" @if(in_array('select-all', old('roles', []))) selected @endif>Select All</option>
                        @foreach ($roles as $id => $name)
                            <option value="{{ $id }}" @if(in_array($id, old('roles', [])) || $permission->roles->contains($id)) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
                    <div class="invalid-feedback" style="color: red;">{{ $message }}</div>
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
