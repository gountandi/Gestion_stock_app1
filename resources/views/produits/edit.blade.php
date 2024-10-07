@extends('layouts.base')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("modifier un  produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{ route('produits.update',$produit)}}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="">Libelle</label>
                                <input type="text" name="libelle" id="libelle" class="border-gray-300 rounded-md w-full" value="{{ old('libelle')??$produit->libelle}}">

                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="user">Prix</label>
                                <input type="number" name="prix_unitaire" id="prix_unitaire" class="border-gray-300 rounded-md w-full" value="{{ old('prix_unitaire')??$produit->prix_unitaire}}" min="0">

                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="produit">Quantité</label>
                                <input type="number" name="qte_stock" id="qte_stock" class="border-gray-300 rounded-md w-full"  value="{{ old('qte_stock')??$produit->qte_stock}}" min="1">

                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="produit">Marque</label>
                                <input type="text" name="marque" id="marque" class="border-gray-300 rounded-md w-full"  value="{{ old('marque')??$produit->marque}}">

                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="categorie">Categorie</label>
                                <select name="categorie_id" id="categorie_id" class="categorie1 border-gray-300 rounded-md w-full" value="{{ old('categorie')??$produit->categorie}}">
                                <option value="Sélectioné"></option>
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->nom}}</option>
                                @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="inputImage" class="form-label">Image</label>
                                <input type="file" name="inputImage" id="inputImage" class="border-gray-300 rounded-md w-full">
                                <img src="{{ $chemin_image.$produit->image }}" width="300px">

                            </div>
                        </div>

                    </div>
                    <div>
                        <button class="mt-6 bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">
                            Valider
                        </button>
                    </div>
                </form>
                @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif
               </div>
            </div>
        </div>
    </div>
@endsection
