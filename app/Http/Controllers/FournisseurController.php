<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;
use App\Models\Fournisseur;
use Illuminate\Http\Request;


class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value=$request->input("search");
        $pagination_number=5;
        if ($search_value){
             $fournisseurs = Fournisseur::where("nom", "like", "%".$search_value. "%")
             ->orWhere("tel", $search_value)
             ->paginate($pagination_number);
        }
        else{
             $fournisseurs = Fournisseur::paginate($pagination_number);

        }
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFournisseurRequest $request)
    {
        $fournisseur=Fournisseur::create(['nom'=>$request->input('nom'),
        'tel'=>$request->input('tel')]);
        return redirect()->route('fournisseurs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit',compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur)
    {
        $fournisseur->update($request->all());
        return redirect()->route('fournisseurs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index');
    }
}
