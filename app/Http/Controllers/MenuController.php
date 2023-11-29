<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class MenuController extends Controller
{
    public function sideMenu()
    {
        // Definisikan konfigurasi menu berdasarkan peran pengguna di sini
        $user = auth()->user();
        if ($user->hasRole('superadmin')) {
            $side_menu = [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'route_name' => 'dashboard',
                    'params' => [],
                    'admin_visible' => true,
                    'user_visible' => true,
                ],
            ];
        } elseif ($user->hasRole('admin')) {
            $side_menu = [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'route_name' => 'dashboard',
                    'params' => [],
                    'admin_visible' => true,
                    'user_visible' => true,
                ],

            ];
        } elseif ($user->hasRole('user')) {
            $side_menu = [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'route_name' => 'dashboard',
                    'params' => [],
                    'admin_visible' => true,
                    'user_visible' => true,
                ],

            ];
        } else {

            return view('error-page');
        }

        return view('menu', compact('side_menu'));
    }
}
