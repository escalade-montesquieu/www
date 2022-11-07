<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    public function room() {
        return view('room', [
            'routes' => route::all()
        ]);
    }

    public function create() {
        return view('route.create');
    }




    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'type' => ['required','regex:/route|bloc/'],
            'diff' => ['required','regex:/^(([0-9][abc]\+?)|difficile|moyen|facile)$/'],
            'color' => 'required|string',
            'sectors' => 'required',
        ], [
            'diff.required' => 'Renseignez la difficulté',
            'diff.regex' => 'Le format de la difficulté est invalide',
            'sectors.required' => 'Choisissez au moins un secteur',
        ]);
        if ($validator->fails()) {
            //on retourne l'erreur
            return back()->withInput()->withErrors($validator);
        }

        $route = route::create([
            'type' => $request->get('type'),
            'diff'  => $request->get('diff'),
            'color'  => $request->get('color'),
            'text' => $request->get('text'),
            'sectors' => array_keys(request('sectors'))
        ]);
        return redirect()->route('room')->with('status', 'success')->with('content', 'Salle modifiée');
    }




    public function edit($slug) {
        return view('route.edit', [
            'route' => route::where('id', $slug)->firstOrFail()
        ]);
    }




    public function update(Request $request, $slug) {
        $route = route::where('id', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'type' => ['required','regex:/route|bloc/'],
            'diff' => ['required','regex:/^(([0-9][abc]\+?)|difficile|moyen|facile)$/'],
            'color' => 'required|string',
            'sectors' => 'required',
        ], [
            'diff.required' => 'Renseignez la difficulté',
            'diff.regex' => 'Le format de la difficulté est invalide',
            'sectors.required' => 'Choisissez au moins un secteur',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $route->type = $request->get('type');
        $route->diff  = $request->get('diff');
        $route->color  = $request->get('color');
        $route->sectors = array_keys(request('sectors'));
        $route->save();

        return redirect()->route('room')->with('status', 'success')->with('content', 'Modifications enregistrées');
    }





    public function delete(Request $request, $id)
    {
        $route = route::where('id', $id)->firstOrFail();
        $route->delete();
        return redirect()->route('room')->with('status', 'success')->with('content', 'Voie/bloc supprimé');
    }

}
