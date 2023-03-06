<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\FormNotification;
use App\Mail\ReviewConfirmation;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function review()
    {
        return view('reviews.review');
    }
    public function verzenden(Request $request)
    {
        $request->validate([
            'naam' => 'required',
            'email' => 'required|email',
            'bericht' => 'required|min:50|max:140',
            'score' => 'required',
            'voorwaarden' => 'accepted'
        ]);

        Mail::to($request->email)->send(new ReviewConfirmation());
        Mail::to('sopfg@hotmail.com')->send(new FormNotification([
            'naam' => $request->naam,
            'email' => $request->email,
            'bericht' => $request->bericht,
            'score' => $request->score
        ]));

        return back();
    }
}
