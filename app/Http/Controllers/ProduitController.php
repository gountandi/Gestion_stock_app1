<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;



class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value=$request->input("search");
        //$search_value="non";


        $categories_ids=Categorie::where('nom',$search_value)->pluck('id');
        //dd($categories_ids);
        $pagination_number=5;
        if ($search_value){
             $produits = Produit::whereIn("categorie_id",$categories_ids)
             ->paginate($pagination_number);

        }
        else{
             $produits = Produit::paginate($pagination_number);

        }
        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=Categorie::all();
        return view('produits.create',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {

        /*$categories_ids=$request->input(("categories_ids"));

        for($i=0;$i<count($categories);$i++){
            $category=$categories_ids[$i];
        }*/

         //Generer l'image
         $image_produit=$request->file("image");
         $id=Produit::max("id")+1;
         $ext= $image_produit->getClientOriginalExtension();
         $nom_image=strtolower($request->libelle."_".$id.".".$ext);

         //sauvegarder l'image
         $image_produit->storeAs("public/produits", $nom_image);

         //changer le chemin de l'image
         $data=(['libelle'=>$request->input('libelle'),
         'prix_unitaire'=>$request->input('prix_unitaire'),
         'qte_stock'=>$request->input('qte_stock'),
         'marque'=>$request->input('marque'),
         'categorie_id'=>$request->input('categorie_id')]);

         $data["image"]=$nom_image;

         //dd($data);
         //dd($data);
         Produit::create($data);

         return redirect()->route('produits.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)

    {
        $category=Categorie::all();

        return view('produits.edit',compact('produit','category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {



        //Generer l'image
         $image_produit=$request->file("image");
         $id=Produit::max("id")+1;
         $ext=$image_produit->getClientOriginalExtension();
         $nom_image=strtolower($request->libelle."_".$id.".".$ext);

         //sauvegarder l'image
         $image_produit->storeAs("public/produits", $nom_image);


        $data=(['libelle'=>$request->input('libelle'),
         'prix_unitaire'=>$request->input('prix_unitaire'),
         'qte_stock'=>$request->input('qte_stock'),
         'marque'=>$request->input('marque'),
         'categorie_id'=>$request->input('categorie_id')]);


        $data["image"]=$nom_image;

        $produit->update($data);
        return redirect()->route('produits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index');
    }
}
