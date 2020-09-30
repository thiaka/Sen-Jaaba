<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        $categories = Categorie::paginate(5);
        return view('admin.categorie.index', compact('categories', 'auth'));
    }

    public function indexResp()
    {
        $auth = auth()->user();
        $categories = Categorie::paginate(5);
        return view('resp.categorie.index', compact('categories', 'auth'));
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
        $categories = Categorie::where('nom', 'like', '%'.$search_query.'%')->paginate(5);
        return view('admin.categorie.result', compact('categories', 'search_query', 'auth'));
    }
    public function c_search(Request $request)
    {
        $auth = auth()->user();
        $search_query = $request->search_query;
        $categories = Categorie::where('nom', 'like', '%'.$search_query.'%')->paginate(5);
        return view('resp.categorie.result', compact('categories', 'search_query', 'auth'));
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

        $this->validate($request, [
            'nom' => 'required',
        ]);

        Categorie::create([
            'nom' => $request->nom,
        ]);

        Session::flash('success', 'Une nouvelle categorie a été crée avec succès');
        return redirect()->route('categorie.index');
    }

    public function storeResp(Request $request)
    {

        $this->validate($request, [
            'nom' => 'required',
        ]);

        Categorie::create([
            'nom' => $request->nom,
        ]);

        Session::flash('success', 'Une nouvelle categorie a été crée avec succès');
        return redirect()->route('cat');
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
    public function update(Request $request, Categories $categorie)
    {
        // dd($request->all());
        $this->validate($request, [
            'nom' => 'required|unique:categories,nom,'.$categorie->id,
        ]);

        $categorie->nom = $request->nom;
        $categorie->save();

        Session::flash('success', 'La categorie a été modifiée avec succès');
        return redirect()->route('categorie.index');
    }

    public function updateResp(Request $request, Categories $categorie)
    {
        $this->validate($request, [
            'nom' => 'required|unique:categories,nom,'.$categorie->id,
        ]);

        $categorie->nom = $request->nom;
        $categorie->save();

        Session::flash('success', 'La categorie a été modifiée avec succès');
        return redirect()->route('cat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::where('id',$id)->first();
        if ($categorie != null) {
            $categorie->delete();
            Session::flash('success', 'La Categorie a été supprimée avec succès');
            return redirect()->route('categorie.index');
        }
    }

    public function destroyResp($id)
    {
        $categorie = Categorie::where('id',$id)->first();
        if ($categorie != null) {
            $categorie->delete();
            Session::flash('success', 'La Categorie a été supprimée avec succès');
            return redirect()->route('cat');
        }
    }
}
