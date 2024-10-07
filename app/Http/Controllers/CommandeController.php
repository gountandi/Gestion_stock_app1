<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Ismaelw\LaraTeX\LaraTeX;





class CommandeController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value = $request->input("search");
        $search_value1 = $request->input("search1");
        $clients_ids = Client::where('nom', $search_value1)->pluck('id');

        $pagination_number = 5;

        // Ajouter une condition where pour exclure les commandes avec montant_total == 0
        if ($search_value) {
            $commandes = Commande::where("montant_total", "like", "%" . $search_value . "%")
                ->orWhere("date_cmd", $search_value)
                ->orWhere("client_id", $search_value)
                ->where('montant_total', '>', 0) // Exclure les commandes avec montant_total = 0
                ->paginate($pagination_number);
        } elseif ($search_value1) {
            $commandes = Commande::whereIn('client_id', $clients_ids)
                ->where('montant_total', '>', 0) // Exclure les commandes avec montant_total = 0
                ->paginate($pagination_number);
        } else {
            $commandes = Commande::where('montant_total', '>', 0) // Exclure les commandes avec montant_total = 0
                ->paginate($pagination_number);
        }

        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produit=Produit::all();
        $client=Client::all();

        return view('commandes.create',compact('produit','client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request)
    {

        //Commande::create($request->all());
        $search_value3=$request->input("search2");
        //$categorie=DB::table('categories')->select('categories.id')->where ('nom',$search_value);
        //dd($categorie);
        //$pagination_number=5;
        if ($search_value3){
             $produits = Produit::where("libelle", "like", "%".$search_value3. "%")
             ->orWhere("libelle", $search_value3)
             ->orWhere("prix", $search_value3)
             ->orWhere("qte_stock", $search_value3)
             ->orWhere("marque", $search_value3)
             ->paginate($pagination_number);
        }

        $vendeur=Auth::user();
        $produit_ids=$request->input("produit_ids");
        $quantites=$request->input("quantites");
        $montants=$request->input("montants");

        //dd($request->all());

        $commande=Commande::create([
            "client_id" => $request->input("client_id"),
            "vendeur_id"=>$vendeur->id,



        ]);
        $montant_total=0;
        //dd($produit_ids);

        for($i=0;$i<count($produit_ids);$i++){
            $produit=$produit_ids[$i];
            $quantite=$quantites[$i];
            $montant=$montants[$i];
            $montant_total+=$montants[$i];

            $ligne_commande =LigneCommande::create([
                "qte_ligne"=>$quantite,
                "prod_id"=>$produit,
                "montant"=>$montant,
                "cmd_id"=>$commande->id,

            ]);

            $ligne_commande->produit->qte_stock -= $ligne_commande->qte_ligne;

            $ligne_commande->produit->save();




        }
        $commande->montant_total=$montant_total;
        $commande->save();
        return redirect()->route('commandes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)

    {
        $produits=Produit::all();
        $clients=Client::all();

        return view('commandes.edit',compact('commande','clients','produits'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $vendeur=Auth::user();
        $produit_ids=$request->input("produit_ids");
        $quantites=$request->input("quantites");
        $montants=$request->input("montants");


        $commande->update($request->all());
        for($i=0;$i<count($produit_ids);$i++){
            $produit=$produit_ids[$i];
            $quantite=$quantites[$i];
            $montant=$montants[$i];
            $montant_total+=$montants[$i];

            LigneCommande::create([
                "qte_ligne"=>$quantite,
                "prod_id"=>$produit,
                "montant"=>$montant,
                "cmd_id"=>$commande->id,

            ]);

        }
        $commande->montant_total=$montant_total;
        $commande->save();
        return redirect()->route('commandes.edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('commandes.index');
    }

    public function generer_facture(Commande $commande){

        return (new LaraTeX('latex.facture'))->with([
             'commande'=>$commande,
         ])->download('facture.pdf');
     }

}
