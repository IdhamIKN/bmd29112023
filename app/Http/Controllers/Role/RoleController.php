<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\info_user;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-index|role-create|role-edit|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $permissions = Permission::all();
        $roles = Role::withCount('permissions')->paginate($perPage);
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('role.index', compact('roles','userfoto', 'permissions', 'perPage'));
    }
    
    public function search(Request $request)
    {
        $perPage = (int) $request->session()->get('per_page', 10);
        \Log::info('Retrieved per_page from session: ' . $perPage);
        $query = $request->input('query');
        $permissions = Permission::all();
        $roles = Role::where('name', 'LIKE', "%{$query}%")->paginate($perPage);
    
        return view('role.index', compact('roles','permissions', 'perPage'));
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
        $permissions = Permission::pluck('name', 'id');
        $izin = Permission::all();
        $fotoId = auth()->user()->id;
        $userfoto = info_user::where('id_user', $fotoId)->first();
        return view('role.role-form', compact('permissions','userfoto', 'izin'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'unique:roles'],
    //         'permissions' => ['array'],
    //     ]);
    //     $role = Role::create(['name' => $request->input('name')]);

    //     $role->givePermissionTo($request->input('permissions'));

    //     return redirect()->route('roles.index')->with('success', 'Role telah berhasil dibuat.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles'],
            'permissions' => ['array'],
        ]);

        if (in_array('select-all', $request->input('permissions'))) {
            $permissions = Permission::pluck('id')->all();
        } else {
            $permissions = $request->input('permissions', []);
        }

        $role = Role::create(['name' => $request->input('name')]);

        if (!empty($permissions)) {
            $role->givePermissionTo($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role telah berhasil dibuat.');
    }


    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $izin = Permission::all();
        $permissions = Permission::pluck('name', 'id');

        return view('role.role-edit', compact('role', 'permissions', 'izin'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id],
            'permissions' => ['array'],
        ]);
        $role->update(['name' => $request->input('name')]);

        if (in_array('select-all', $request->input('permissions'))) {
            $permissions = Permission::pluck('id')->all();
        } else {
            $permissions = $request->input('permissions', []);
        }

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role telah berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role telah berhasil dihapus.');
    }
}
