import $ from 'jquery';
import 'select2/dist/css/select2.min.css';
import 'select2';


let boutton_ajouter1=document.getElementById("btn_ajouter1");
let nbligne1=0;
boutton_ajouter1.addEventListener("click",ajouterLigneApp);
let element_produit1=document.getElementById("produit_id");

let element_prix_achat=document.getElementById("prix_achat_id")
let element_quantite1=document.getElementById("quantite_id");
let tableau_ligne_app=document.getElementById("tableau_lignes_approvisionements");

function supprimerLigneApprovisionement(id_ligne_tableau){
    const ligne = document.getElementById(id_ligne_tableau);
    ligne.remove();
}

function editerLigneApprovisionement(id_ligne_tableau){
    const ligne = document.getElementById(id_ligne_tableau);
}


function creerLigneApp(produit,quantite,prix_achat) {
    nbligne1+=1;

    return `<tr id="ligne_app_${nbligne1}" class="bg-gray-100">
        <td class="py-3 px-6">
        <input type="hidden" name="produit_ids[]" id="produit_ids" value="${JSON.parse(produit.value).id}" class="border-gray-300 rounded-md w-full" >
        ${JSON.parse(produit.value).libelle}
        </td>

        <td class="py-3 px-6">
        <input type="hidden" name="quantites[]" id="quantites" value="${quantite.value}" class="border-gray-300 rounded-md w-full" >
        ${quantite.value}
        </td>
        <td class="py-3 px-6">
        <input type="hidden" name="prix_achat_ids[]" id="prix_achat_ids" value="${prix_achat.value}" class="border-gray-300 rounded-md w-full" >
        ${prix_achat.value}
        </td>
        <td class="py-3 px-6">

            <a>
                <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md" onclick="event.preventDefault();supprimerLigneApprovisionement('ligne_app_${nbligne1}')">Supprimer</button>
            </a>
        </td>
    </tr>`


}

function ajouterLigneApp(){
    tableau_ligne_app.innerHTML += creerLigneApp(element_produit1,element_quantite1,element_prix_achat);
}
/*
$(document).ready(function() {
    $('#fournisseur_id').select2({
        placeholder: 'Sélectionnez un fournisseur',
        allowClear: true
    });

    $('#produit_id').select2({
        placeholder: 'Sélectionnez un produit',
        allowClear: true
    });
});*/


