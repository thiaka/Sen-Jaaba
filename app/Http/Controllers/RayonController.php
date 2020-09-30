<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Rayon;
use App\Models\Categorie;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $rayons = Rayon::paginate();
        $categories = Categorie::all();
        return view('admin.rayon.index', compact('rayons', 'categories', 'auth'));
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $auth = auth()->user();
        $search_query = $request->search_query;
        $rayons = Rayon::where('libelle', 'like', '%'.$search_query.'%')->paginate(5);
        $categories = Categorie::all();
        return view('admin.rayon.result', compact('rayons', 'categories', 'search_query', 'auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = Rayons::join('categories_rayons', 'rayons.id', 'categories_rayons.rayons_id')
        //                 ->join('categories', 'categories_rayons.categories_id', 'categories.id')
        //                 ->where('categories_rayons.categories_id', 3)->get();
        // dd($data);
        $this->validate($request, [
            'libelle' => 'required|unique:rayons,libelle',
            'quantite_stock' => 'required',
        ]);

        $rayons = Rayon::create([
            'libelle' => $request->libelle,
            'quantite_stock' => $request->quantite_stock,
        ]);

        $rayons->categories()->attach($request->categories);

        Session::flash('success', 'Un nouveau rayon a été crée avec succès');
        return redirect()->route('rayon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rayons $rayon)
    {
        // dd($request->all());
        $this->validate($request, [
            'libelle' => 'required|unique:rayons,libelle,'.$rayon->id,
            'quantite_stock' => 'required',
        ]);

        $rayon->libelle = $request->libelle;
        $rayon->quantite_stock = $request->quantite_stock;

        $rayon->categories()->sync($request->categories);

        $rayon->save();

        Session::flash('success', 'Le rayon a été modifié avec succès');
        return redirect()->route('rayon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rayon = Rayon::where('id',$id)->first();
        if ($rayon != null) {
            $rayon->delete();
            Session::flash('success', 'Le Rayon a été supprimé avec succès');
            return redirect()->route('rayon.index');
        }
    }
}
