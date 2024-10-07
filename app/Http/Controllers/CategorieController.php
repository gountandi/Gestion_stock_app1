<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value=$request->input("search");
        $pagination_number=5;
        if ($search_value){
             $category = Categorie::where("nom", "like", "%".$search_value. "%")
             ->paginate($pagination_number);
        }
        else{
             $category = Categorie::paginate($pagination_number);

        }
        return view('categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie=Categorie::create(['nom'=>$request->input('nom')] );
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
