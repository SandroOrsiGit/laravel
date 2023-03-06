<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index() {
        $todos = Todo::uncompleted()->get();
        $completedTodos = Todo::completed()->get();

        return view('todos.index', [
            'todos' => $todos,
            'completedTodos' => $completedTodos
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'content' => 'required'
        ]);

        $todo = new Todo();
        $todo->content = $request->content;
        $todo->save();

        return redirect()->back();
    }

    public function toggle(Todo $todo) {
        $todo->completed = !$todo->completed;
        $todo->save();

        return redirect()->back();
    }

    public function destroy(Todo $todo) {
        $todo->delete();
        return redirect()->back();
    }
}
