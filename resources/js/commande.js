
var boutton_ajouter=document.getElementById("btn_ajouter");
//console.log(boutton_ajouter);
var nbligne=0;
boutton_ajouter.addEventListener("click",ajouterLigne);
var element_produit=document.getElementById("produit_id");
//let search=document.getElementById("search2")
//search.addEventListener("click",rechercherProduit)();
var prod=document.getElementById('produit_id')

var element_quantite=document.getElementById("quantite_id");
var tableau_ligne_cmd=document.getElementById("tableau_lignes_commandes");
console.log(tableau_ligne_cmd);

/*
function rechercherProduit(){
    if(prod){
        search.classList.remove('hidden');
    }
}*/

function supprimerLigneCommande(id_ligne_tableau){
    const ligne = document.getElementById(id_ligne_tableau);
    ligne.remove();
}
/*
function editerLigneCommande(id_ligne_tableau){
    const ligne = document.getElementById(id_ligne_tableau);

    if(quantite.value >= JSON.parse(produit.value).qte_stock){
        return alert('Vous ne pouvez pas vendre ce produit!!!');
     }

     else{
        nbligne+=1;

        return `<tr id="ligne_cmd_${nbligne}" class="bg-gray-100">
        <td class="py-3 px-6">
        <input type="hidden" name="produit_ids[]" id="produit_ids" value="${JSON.parse(produit.value).id}" class="border-gray-300 rounded-md w-full" min="1" >
        ${JSON.parse(produit.value).libelle}

        </td>
        <td class="py-3 px-6">
        <input type="hidden" name="quantites[]" id="quantites" value="${quantite.value}" class="border-gray-300 rounded-md w-full" min="1" >
        ${quantite.value}
        </td>
        <td class="py-3 px-6">
        <input type="hidden" name="montants[]" id="montants" value="${quantite.value * JSON.parse(produit.value).prix_unitaire}" class="border-gray-300 rounded-md w-full" min="1" >
        ${quantite.value * JSON.parse(produit.value).prix_unitaire}
        </td>
        <td class="py-3 px-6">



            <a>
                <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md" onclick="event.preventDefault();supprimerLigneCommande('ligne_cmd_${nbligne}')">Supprimer</button>
            </a>produit_ids
        </td>
    </tr>`

    }

}

*/
function creerLigne(produit,quantite) {

     if(quantite.value >= JSON.parse(produit.value).qte_stock){
        return alert('Vous ne pouvez pas vendre ce produit!!!');
     }

     else{
        nbligne+=1;

        return `<tr id="ligne_cmd_${nbligne}" class="bg-gray-100">
        <td class="py-3 px-6">
        <input type="hidden" name="produit_ids[]" id="produit_ids" value="${JSON.parse(produit.value).id}" class="border-gray-300 rounded-md w-full" min="1" >
        ${JSON.parse(produit.value).libelle}

        </td>
        <td class="py-3 px-6">
        <input type="hidden" name="quantites[]" id="quantites" value="${quantite.value}" class="border-gray-300 rounded-md w-full" min="1" >
        ${quantite.value}
        </td>
        <td class="py-3 px-6">
        <input type="hidden" name="montants[]" id="montants" value="${quantite.value * JSON.parse(produit.value).prix_unitaire}" class="border-gray-300 rounded-md w-full" min="1" >
        ${quantite.value * JSON.parse(produit.value).prix_unitaire}
        </td>
        <td class="py-3 px-6">



            <a>
                <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md" onclick="event.preventDefault();supprimerLigneCommande('ligne_cmd_${nbligne}')">Supprimer</button>
            </a>
        </td>
    </tr>`

}



}

function ajouterLigne(){
    tableau_ligne_cmd.innerHTML += creerLigne(element_produit,element_quantite);
}



