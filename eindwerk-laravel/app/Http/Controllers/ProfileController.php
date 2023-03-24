<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ChangedMail;
use Illuminate\Http\Request;
use App\Mail\ChangedPassword;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index()
    {
        // Pas de views aan zodat je de juiste item counts kunt tonen in de knoppen op de profiel pagina.
        return view('profile.index');
    }

    public function edit()
    {
        // Vul het email adres van de ingelogde gebruiker in het formulier in
        $user = User::where('id', Auth::id())->first();
        return view('profile.edit', [
            'email' => $user->email
        ]);
    }

    public function updateEmail(Request $request)
    {
        // Valideer het formulier, zorg dat het terug ingevuld wordt, en toon de foutmeldingen

        // Emailadres is verplicht en moet uniek zijn (behalve voor het huidge id van de gebruiker).
        // https://laravel.com/docs/9.x/validation#rule-unique -> Forcing A Unique Rule To Ignore A Given ID
        // Update de gegevens van de ingelogde gebruiker
        $user=Auth::user();
        $request->validate([
                'email'=>['required', 'email',Rule::unique('users')->ignore(Auth::id())]
        ]);

        Mail::to($user->email)->send(new ChangedMail($request));

        $user->email = $request->email;
        $user->save();

        // BONUS: Stuur een e-mail naar de gebruiker met de melding dat zijn e-mailadres gewijzigd is.



        return redirect()->route('profile.edit');
    }

    public function updatePassword(Request $request)
    {
        // Valideer het formulier, zorg dat het terug ingevuld wordt, en toon de foutmeldingen
        // Wachtwoord is verplicht en moet confirmed zijn.
        // Update de gegevens van de ingelogde gebruiker met het nieuwe "hashed" password

        $request->validate([
            'password'=>'required|confirmed'
        ]);
        $user=Auth::user();
        $user->password= Hash::make($request->password);
        $user->save();
        Mail::to($user->email)->send(new ChangedPassword());

        // BONUS: Stuur een e-mail naar de gebruiker met de melding dat zijn wachtwoord gewijzigd is.

        return redirect()->route('profile.edit');
    }
}
