<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\languages;
use App\Models\kdpos;

class RegisterController extends Controller
{
    public function register()
    {
        return view('login/register', [
            'layout' => 'login'
        ]);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'username' => 'required|string|unique:users',
    //         'email' => 'required|string|email|unique:users',
    //         'nohp' => 'required|string|max:15',
    //         'password' => 'required|string|confirmed',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'username' => $request->username,
    //         'email' => $request->email,
    //         'nohp' => $request->nohp,
    //         'password' => bcrypt($request->password),
    //         'remember_token' => Str::random(10),
    //         'active' => 1,
    //         'email_verified_at' => now(),
    //     ]);
    //     $user->assignRole('user');

    //     return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'nohp' => 'required|string|max:15',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(10),
            'active' => 1,
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');

        // Mengubah format nomor telepon
        $phoneNumber = $request->nohp;
        if (substr($phoneNumber, 0, 1) == "0") {
            $phoneNumber = "62" . substr($phoneNumber, 1);
        }

        // Menentukan waktu hari
        $hour = date('H');
        $greeting = "Selamat pagi";
        if ($hour >= 10 && $hour < 14) {
            $greeting = "Selamat siang";
        } elseif ($hour >= 14 && $hour < 18) {
            $greeting = "Selamat sore";
        } elseif ($hour >= 18 || $hour < 3) {
            $greeting = "Selamat malam";
        }

        // Mengirim pesan WhatsApp
        $message = $greeting . " " . $request->name . ", pendaftaran akun pada aplikasi data karyawan BMD Syariah telah berhasil. Silahkan melanjutkan login dengan akun yang sudah terdaftar dan silahkan mengisi kelengkapan data.";
        $apiUrl = "https://wa.bmdsyariah.com/send-message?api_key=8ULKFZTqEjfrjgioeFqXAph04QkYAM&sender=62895622243141&number=" . $phoneNumber . "&message=" . urlencode($message);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $apiUrl);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }



    public function import()
    {
        return view('login/import', [
            'layout' => 'login'
        ]);
    }

    public function importCSV(Request $request)
    {
        $file = $request->file('csv_file');

        if ($file) {
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));

            foreach ($data as $row) {
                language::create([
                    'col1' => $row[0],
                    'col2' => $row[1],
                    'name' => $row[2],
                ]);
            }
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        }

        return redirect()->back()->with('error', 'Gagal mengimpor data.');
    }

    public function importkd()
    {
        return view('login/importkd', [
            'layout' => 'login'
        ]);
    }



    public function importKDpos(Request $request)
    {
        $file = $request->file('json_file');

        if ($file) {
            $jsonContent = file_get_contents($file->getRealPath());
            $jsonData = json_decode($jsonContent, true);

            if (is_array($jsonData)) {
                foreach ($jsonData as $row) {
                    try {
                        kdpos::create([
                            'kode_wilayah' => $row['code'],
                            'kode_pos' => $row['postal'],
                            'provinsi' => $row['province'],
                            'kota' => $row['city'],
                            'kecamatan' => $row['district'],
                            'kelurahan' => $row['village'],
                            'latitude' => $row['latitude'],
                            'longitude' => $row['longitude'],
                            'elevasi' => $row['elevation'],
                            'geometry' => $row['geometry'],
                        ]);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }

                return redirect()->back()->with('success', 'Data berhasil diimpor.');
            } else {
                return redirect()->back()->with('error', 'Gagal mengimpor data. Data JSON tidak valid.');
            }
        }

        return redirect()->back()->with('error', 'Gagal mengimpor data. File JSON tidak ditemukan.');
    }
}
