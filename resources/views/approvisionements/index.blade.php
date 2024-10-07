@extends('layouts.base')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Approvisionements') }}
        </h2>
    </x-slot>

    <section class="bg-gray-900 text-gray-400 body-font">
        <div class="container mx-auto px-5 py-12">
            <!-- Bouton Ajouter -->
            <div class="flex justify-center mb-10">
                <form action="{{ route('approvisionements.create') }}" method="get">
                    @csrf
                    <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-6 py-2 rounded-full shadow-md transition duration-300">
                        Ajouter
                    </button>
                </form>
            </div>

            <!-- Formulaire de recherche -->
            <div class="flex justify-center mb-12">
                <form action="{{ route('approvisionements.index') }}" method="get" class="flex items-center space-x-3 w-full max-w-md">
                    <input type="text" placeholder="Rechercher par nom" class="w-full px-4 py-2 rounded-full border border-gray-300 bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out" name="search">
                    <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-full shadow-md transition duration-300">Rechercher</button>
                </form>
            </div>

            <!-- Tableau des approvisionnements -->
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full table-auto bg-gray-800 text-white rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-700">
                            <th class="px-6 py-4 font-medium text-sm tracking-wider text-left">Gérant</th>
                            <th class="px-6 py-4 font-medium text-sm tracking-wider text-left">Fournisseur</th>
                            <th class="px-6 py-4 font-medium text-sm tracking-wider text-left">Prix d'achat</th>
                            <th class="px-6 py-4 font-medium text-sm tracking-wider text-left">Date</th>
                            <th class="px-6 py-4 font-medium text-sm tracking-wider text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @forelse ($approvisionements as $approvisionement)
                            <tr>
                                <td class="px-6 py-4">{{ $approvisionement->user->name }}</td>
                                <td class="px-6 py-4">{{ $approvisionement->fournisseur->nom }}</td>
                                <td class="px-6 py-4">{{ $approvisionement->prix_achat_unitaire }}</td>
                                <td class="px-6 py-4">{{ $approvisionement->date_livraison }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('approvisionements.show', $approvisionement) }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-full transition duration-300">Voir</a>
                                        <form action="{{ route('approvisionements.destroy', $approvisionement) }}" method="post" class="inline-block">
                                            @csrf
                                            @method("DELETE")
                                            <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-4 py-2 rounded-full transition duration-300">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">Aucun approvisionnement trouvé</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $approvisionements->links() }}
            </div>
        </div>
    </section>
@endsection
