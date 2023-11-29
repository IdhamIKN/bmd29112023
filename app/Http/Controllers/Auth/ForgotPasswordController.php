<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function forgotpassword()
    {
        // return view('auth/passwords/email', [
        //     'layout' => 'login'
        // ]);
        return view('login/forgotpassword', [
            'layout' => 'login'
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }
        $token = app('auth.password.broker')->createToken($user);

        $url = url(config('app.url').route('password.reset', ['token' => $token, 'email' => $user->email], false));

        $phoneNumber = $user->nohp;
        if (substr($phoneNumber, 0, 1) == "0") {
            $phoneNumber = "62" . substr($phoneNumber, 1);
        }
        $message = "Silakan klik link berikut untuk mereset password Anda: " . $url;
        $apiUrl = "https://wa.bmdsyariah.com/send-message?api_key=8ULKFZTqEjfrjgioeFqXAph04QkYAM&sender=62895622243141&number=" . $phoneNumber . "&message=" . urlencode($message);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $apiUrl);

        // return $response == Password::RESET_LINK_SENT
        //             ? $this->sendResetLinkResponse($request, $response)
        //             : $this->sendResetLinkFailedResponse($request, $response);
        return redirect()->route('login')->with('status', 'Link reset password telah dikirim melalui WhatsApp.');
    }

}
