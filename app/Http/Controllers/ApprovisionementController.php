<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovisionementRequest;
use App\Http\Requests\UpdateApprovisionementRequest;
use App\Models\Approvisionement;
use App\Models\LigneApprovisionement;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;



class ApprovisionementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value=$request->input("search");
        $search_value1=$request->input("search1");

        $produitss_ids=Produit::where('libelle',$search_value)->pluck('id');
        $fournisseurs_ids=Fournisseur::where('nom',$search_value)->pluck('id');


        $pagination_number=5;
         if ($search_value){
             $approvisionements = Approvisionement::whereIn("produit_id",$produitss_ids)
             ->paginate($pagination_number);
        }
        elseif($fournisseurs_ids) {
            $approvisionements = Approvisionement::whereIn("fournisseur_id",$fournisseurs_ids)
            ->paginate($pagination_number);

        }
        else{
             $approvisionements = Approvisionement::paginate($pagination_number);

        }
        return view('approvisionements.index', compact('approvisionements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fournisseur=Fournisseur::all();
        $produit=Produit::all();
        return view('approvisionements.create',compact('produit','fournisseur'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(StoreApprovisionementRequest $request)
{
    // Récupération de l'utilisateur actuel
    $gerant = Auth::user();
    $produit_ids = $request->input('produit_ids');
    $quantites = $request->input('quantites');
    $prix_achat_ids=$request->input("prix_achat_ids");


    // Création de l'approvisionnement
    $approvisionement = Approvisionement::create([
        'fournisseur_id' => $request->input('fournisseur_id'),
        'gerant_id' => $gerant->id,
        'prix_achat_unitaire' => 0,
    ]);
    //dd($request->all());
    // Traitement des lignes d'approvisionnement
    for($i=0;$i<count($produit_ids);$i++){
        $produit=$produit_ids[$i];
        $quantite=$quantites[$i];
        $prix_achat_unitaire=$prix_achat_ids[$i];

        // Création de la ligne d'approvisionnement
        $ligne_approvisionement = LigneApprovisionement::create([
            'qte_approvisionner' => $quantite,
            'prod_id' => $produit,
            'approvisionement_id' => $approvisionement->id,
        ]);

        // Mise à jour du stock du produit
        $produit = $ligne_approvisionement->produit;
        $produit->qte_stock += $ligne_approvisionement->qte_approvisionner;
        $produit->save();

        $approvisionement->prix_achat_unitaire = $prix_achat_unitaire;
        $approvisionement->save();
    }


    // Redirection vers la liste des approvisionnements
    return redirect()->route('approvisionements.index');
}


    /**
     * Display the specified resource.
     */
    public function show(Approvisionement $approvisionement)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approvisionement $approvisionement)
    {
        return view('approvisionements.edit',compact('approvisionement'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovisionementRequest $request, Approvisionement $approvisionement)
    {
        $approvisionement->update($request->all());
        return redirect()->route('approvisionements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approvisionement $approvisionement)
    {
        $approvisionement->delete();
        return redirect()->route('approvisionements.index');
    }
}
