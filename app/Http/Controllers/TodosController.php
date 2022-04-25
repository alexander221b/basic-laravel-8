<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Agregamos el modelo con los datos del negocio
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3'
        ]);
        $todo = new Todo();
        $todo->title =  $request->title;
        $todo->category_id =  $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id){
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $category){
        $todo = Todo::find($category);
        $todo->title = $request->title;

        //dd($todo);
        $todo->save();
        //return view('todos.index', ['succes' => 'Tarea actualizada']);
        return redirect()->route('todos')->with('success', 'Tarea Actualizada');
    }

    public function destroy($category){
        $todo = Todo::find($category);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Tarea eliminada');
    }
}
