@extends('layouts.base')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Approvisionnement Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __('Approvisionnement Information') }}
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Fournisseur') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ $approvisionnement->fournisseur->nom }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Produit') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ $approvisionnement->produit->libelle }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Quantité') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ $approvisionnement->quantite }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                {{ __('Prix d\'achat') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ $approvisionnement->prix_achat }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __('Items') }}
                    </h3>
                </div>
                <div class="border-t border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Produit') }}
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Quantité') }}
                                </th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Prix d\'achat unitaire') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($approvisionnement->items as $item)
                                <tr>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">
                                        {{ $item->produit->libelle }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500">
                                        {{ $item->quantite }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500">
                                        {{ $item->prix_achat }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('approvisionements.edit', $approvisionnement->id) }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                    {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
@endsection
