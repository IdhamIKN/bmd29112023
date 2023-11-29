<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    public function showResetForm(Request $request, $token, $email)
    {
        return view('login/updatepassword', [
            'layout' => 'login'
        ])->with(
            ['token' => $token, 'email' => $email]
        );
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        $phoneNumber = $user->nohp;
        if (substr($phoneNumber, 0, 1) == "0") {
            $phoneNumber = "62" . substr($phoneNumber, 1);
        }
        $message = "Password Anda telah berhasil diubah.";
        $apiUrl = "https://wa.bmdsyariah.com/send-message?api_key=8ULKFZTqEjfrjgioeFqXAph04QkYAM&sender=62895622243141&number=" . $phoneNumber . "&message=" . urlencode($message);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $apiUrl);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $email = $request->email;
        $token = $request->token;
        $password = $request->new_password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $broker = app('auth.password.broker');

        if ($broker->tokenExists($user, $token)) {
            $this->resetPassword($user, $password);

            return redirect()->route('login')->with('status', 'Password Anda telah berhasil diubah.');
        } else {
            return back()->withErrors(['token' => 'Token tidak valid.']);
        }
    }
    // public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'new_password' => 'required|string|confirmed',
    //     ]);
    //     // dd($request);

    //     $user = Auth::user();

    //     $email = $request->email;
    //     $token = $request->token;
    //     $password = $request->new_password;
    //     // dd($password);

    //     $user->password = Hash::make($request->new_password);

    //     $user->save();

    //     $phoneNumber = $user->nohp;
    //     if (substr($phoneNumber, 0, 1) == "0") {
    //         $phoneNumber = "62" . substr($phoneNumber, 1);
    //     }
    //     $message = "Password Anda telah berhasil diubah.";
    //     $apiUrl = "https://wa.bmdsyariah.com/send-message?api_key=8ULKFZTqEjfrjgioeFqXAph04QkYAM&sender=62895622243141&number=" . $phoneNumber . "&message=" . urlencode($message);

    //     $client = new \GuzzleHttp\Client();
    //     $response = $client->request('GET', $apiUrl);

    //     return redirect()->back()->with('success', 'Password berhasil diubah dan notifikasi WhatsApp telah dikirim!');
    // }




    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
