<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        // Valideer het formulier
        // Elk veld is verplicht
        $request->validate([
            'email'=>'required',
            'password' => 'required'
        ]);
        // Schrijf de aanmeld logica om in te loggen.
        if (Auth::attempt(['email'=> $request->email, 'password'=>$request->password])) {
            // Als je ingelogd bent stuur je de bezoeker door naar de intented "profile" route (zie hieronder)
            return redirect()->intended(route('profile'));
        }
        return back()->withErrors(['email'=>'We can\'t log you in with these credentials.']);



        // Als je gegevens fout zijn stuur je terug naar het formulier met
        // een melding voor het email veld dat de gegevens niet correct zijn.
    }

    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        // Valideer het formulier.
        // Elk veld is verplicht / Wachtwoord en confirmatie moeten overeen komen / Email adres moet uniek zijn
        $request->validate([
            'name' => 'required',
            'email'=>'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        // Bewaar een nieuwe gebruiker in de databank met een beveiligd wachtwoord.
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login');

        // BONUS: Verstuur een email naar de gebruiker waarin staat dat er een nieuwe account geregistreerd is voor de gebruiker.
    }

    public function logout()
    {
        // Gebruiker moet uitloggen
        Auth::logout();
        return back();
    }
}