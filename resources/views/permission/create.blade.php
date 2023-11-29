@extends('../layout/' . $layout)

@section('subhead')
<title>Form Tambah Permission - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Form tambah Permission</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <form action="{{ route('permission.store') }}" method="POST">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Permission Name</label>
                    <input id="crud-form-1" name="name" id="name" type="text" class="form-control w-full" placeholder="Input Permission Name">
                </div>
                {{-- <div class="mt-3">
                    @if ($roles->count())
                    <label for="crud-form-2" class="form-label">Roles</label>
                    <br>

                    @foreach ($roles as $id => $name)
                    <input type="checkbox" name="roles[]" id="role-{{ $id }}" value="{{ $id }}" @checked(in_array($id, old('roles', [])))>
                    <label class="text-sm font-medium text-gray-700" for="role-{{ $id }}">{{ $name }}</label>
                    <br/>
                    @endforeach
                    <br/>
                    @endif
                </div> --}}
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Roles</label>
                    <select data-placeholder="Pilih satu atau Permission" name="roles[]" class="tom-select w-full" id="post-form-3" multiple>
                        <option value="select-all">Select All</option>
                        @foreach ($role as $id => $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                    @error('roles')
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
    document.getElementById('select-all').addEventListener('click', function() {
        var selectAllOption = this;
        var select = document.getElementById('crud-form-2');
        var selectedPermissionsList = document.getElementById('selected-permissions');

        if (selectAllOption.selected) {
            for (var i = 0; i < select.options.length; i++) {
                select.options[i].selected = true;
                var selectedPermission = select.options[i].text;
                var listItem = document.createElement('li');
                listItem.textContent = selectedPermission;
                selectedPermissionsList.appendChild(listItem);
            }
        } else {
            for (var i = 0; i < select.options.length; i++) {
                select.options[i].selected = false;
                selectedPermissionsList.innerHTML = '';
            }
        }
    });

</script>
@endsection

@section('script')
@vite('resources/js/ckeditor-classic.js')
@endsection
