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
                    {{ __("Ajouter un nouveau produit") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{route('produits.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="">Libelle</label>
                                <input type="text" name="libelle" id="libelle" value="{{old('libelle')}}"class="border-gray-300 rounded-md w-full">
                            </div>
                            <div class="space-y-2 w-1/3">
                                <label for="user">Prix</label>
                                <input type="number" name="prix_unitaire" id="prix_unitaire" value="{{old('prix_unitaire')}}" class="border-gray-300 rounded-md w-full" min="0">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="produit">Quantité</label>
                                <input type="number" name="qte_stock" id="qte_stock" value="{{old('qte_stock')}}" class="border-gray-300 rounded-md w-full" min="1">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="produit">Marque</label>
                                <input type="text" name="marque" id="marque" value="{{old('marque')}}" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="categorie">Categorie</label>
                                <select name="categorie_id" id="categorie_id" class="categorie1 border-gray-300 rounded-md w-full">
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
                                <input type="file" name="image" id="inputImage" value="{{old('image')}}" class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="mt-6 bg-blue-600 hover:bg-blue-500 text-black text-sm px-3 py-2 rounded-md">
                            Ajouter
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

