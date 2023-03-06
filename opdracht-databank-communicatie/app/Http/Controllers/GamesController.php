<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Publisher;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', ['games'=>$games]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game= new Game();
        $publishers= Publisher::all();
        return view('games.create', ['game'=>$game, 'publishers'=>$publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'publisher_id'=>'required',

        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->publisher_id = $request->publisher_id;
        $game->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Game $game)
    {
        $games = Game::where('publisher_id', $game->publisher_id)->get();
        return view('games.show', ['game'=>$game,'games'=>$games]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        $publishers= Publisher::all();
        return view('games.edit', ['game'=>$game, 'publishers'=>$publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name'=>'required',
            'publisher_id'=>'required'
        ]);

        $game->name = $request->name;
        $game->publisher_id = $request->publisher_id;
        $game->save();

        return redirect('/');
    }

    /**
     * Show the form for deleting
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Game $game)
    {
        return view('games.delete', ['game'=>$game]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect('/');
    }

    public function markcompleted(Game $game)
    {
        $game->completed = true;
        $game->save();
        return redirect(url()->previous());
    }
}
