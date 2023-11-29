<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\info_user;


class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:permission-index|permission-create|permission-edit|permission-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $permissions = Permission::with('roles:name')->paginate($perPage);
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
    
        return view('permission.index', compact('permissions','userfoto', 'perPage'));
    }
    

    public function search(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $query = $request->input('query');
        $permissions = Permission::where('roles:name', 'LIKE', "%{$query}%")->paginate($perPage);

        return view('permission.index', compact('permissions', 'perPage'));
    }

    public function updateItemsPerPage(Request $request)
    {
        $perPage = $request->input('per_page');
        $request->session()->put('per_page', $perPage);
        \Log::info('Updated per_page in session: ' . $perPage);
        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $role = Role::all();
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('permission.create', compact('roles','userfoto', 'role'));
    }

    // public function store(Request $request) {
    //     $data = $request->validate([
    //         'name' => ['required', 'string', 'unique:permissions'],
    //         'roles' => ['array'],
    //     ]);

    //     $permission = Permission::create($data);

    //     $permission->syncRoles($request->input('roles'));

    //     return redirect()->route('permission.index')->with('success', 'Permission telah berhasil dibuat.');;
    // }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:permissions'],
            'roles' => ['array'],
        ]);

        $permission = Permission::create($data);

        if (in_array('select-all', $request->input('roles'))) {
            $roles = Role::pluck('id')->all();
        } else {
            $roles = $request->input('roles', []);
        }

        $permission->syncRoles($roles);

        return redirect()->route('permission.index')->with('success', 'Permission telah berhasil dibuat.');
    }


    public function edit(Permission $permission)
    {
        $roles = Role::pluck('name', 'id');
        $role = Role::all();
        return view('permission.edit', compact('permission', 'roles', 'role'));
    }

    public function update(Request $request, Permission $permission)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:permissions,id,' . $permission->id],
            'roles' => ['array'],
        ]);

        $permission->update($data);

        if (in_array('select-all', $request->input('roles'))) {
            $roles = Role::pluck('id')->all();
        } else {
            $roles = $request->input('roles', []);
        }

        $permission->syncRoles($roles);

        return redirect()->route('permission.index')->with('success', 'Permission telah berhasil diperbarui.');
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permission.index')->with('success', 'Permission telah berhasil dihapus.');;
    }
}
