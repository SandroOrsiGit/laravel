<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    public function checkout()
    {
        return view('orders.checkout');
    }

    public function store(Request $request)
    {
        // Valideer het formulier zodat alle velden verplicht zijn.
        // Vul het formulier terug in, en toon de foutmeldingen.

        $request->validate([
            'voornaam'=>'required',
            'naam'=>'required',
            'straat'=>'required',
            'huisnummer'=>'required',
            'postcode'=>'required',
            'woonplaats'=>'required',
        ]);

        // Maak een nieuw "order" met de gegevens uit het formulier in de databank
        // Zorg ervoor dat hett order gekoppeld is aan de ingelogde gebruiker.

        $order = new Order();
        $order->voornaam = $request->voornaam;
        $order->achternaam = $request->naam;
        $order->straat = $request->straat;
        $order->huisnummer = $request->huisnummer;
        $order->postcode = $request->postcode;
        $order->woonplaats = $request->woonplaats;
        $order->user_id = Auth::id();
        $order->save();


        // Zoek alle producten op die gekoppeld zijn aan de ingelogde gebruiker (shopping cart)
        // Overloop alle gekoppelde producten van een user (shopping cart)
        // Attach het product, met bijhorende quantity en size, aan het order
        // https://laravel.com/docs/9.x/eloquent-relationships#retrieving-intermediate-table-columns
        // Detach tegelijk het product van de ingelogde gebruiker zodat de shopping cart terug leeg wordt

        $products = Auth::user()->cart()->get();
        foreach ($products as $product) {
            $order->products()->attach($product, ['quantity'=>$product->pivot->quantity, 'size'=>$product->pivot->size]);
            Auth::user()->cart()->detach($product);
        }

        // BONUS: Als er een discount code in de sessie zit koppel je deze aan het discount_code_id in het order model
        // Verwijder nadien ook de discount code uit de sessie


        // BONUS: Stuur een e-mail naar de gebruiker met de melding dat zijn bestelling gelukt is,
        // samen met een knop of link naar de show pagina van het order

        //Mail::to(Auth::user()->email)->send(new OrderPlaced('http://eindwerk-laravel.test/orders/'.$order->id));


        // Redirect naar de show pagina van het order en pas de functie daar aan
        return redirect()->route('orders.show', ['order'=>$order]);
    }

    public function index()
    {
        // Zoek alle orders van de ingelogde gebruiker op. Vervang de "range" hieronder met de juiste code
        $orders = Auth::user()->orders()->get();

        // Pas de views aan zodat de juiste info van een order getoond word in de "order" include file
        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {// Beveilig het order met een GATE zodat je enkel jouw eigen orders kunt bekijken.
        if (!Gate::allows('view-order', $order)) {
            abort(403);
        }
        // In de URL wordt het id van een order verstuurd. Zoek het order uit de url op.
        // Zoek de bijbehorende producten van het order hieronder op.
        $products = $order->products()->get();


        // Geef de juiste data door aan de view
        // Pas de "order-item" include file aan zodat de gegevens van het order juist getoond worden in de website
        return view('orders.show', [
            'order' => $order,
            'products' => $products
        ]);
    }
}
