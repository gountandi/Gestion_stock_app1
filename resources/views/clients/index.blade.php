

@extends('layouts.base')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>
    <section class="text-gray-400 bg-gray-900 body-font">
        {{$errors}}
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-col text-center w-full mb-20">
            <form action="{{route('clients.create')}}" method="get">
                @csrf
                <button class="bg-blue-600 hover:bg-blue-500 text-black text-sm px-3 py-2 rounded-md">Ajouter</button>
            </form>
           </div>
           <div class="lg:w-1/3 lg:mb-0 p-4">
            <div class="h-full text-center">
                <form action="{{route('clients.index')}}" method="get">
                    <input type="text" placeholder="Rechercher par nom" class="w-2/3 rounded-md border border-gray-300" name="search">
                    <button class="bg-blue-600 hover:bg-blue-500 text-blue text-sm px-3 py-2 rounded-md">Rechercher</button>
                </form>
            </div>
          </div>
          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Nom</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Tel</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Actions</th>
                </tr>
              </thead>
              <tbody>
                    @forelse( $clients as $client )
                        <tr>
                            <td class="px-4 py-3">{{$client->nom}}</td>
                            <td class="px-4 py-3">{{$client->tel}}</td>
                            <td class="px-4 py-3 text-lg text-white">
                                <a href="{{route('clients.edit',$client)}}">
                                <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Editer</button>
                                </a>
                                <form action="{{route('clients.destroy',$client)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                    <p>Aucun client</p>
                    @endforelse
                  </tbody>
                </table>
                <div>
                    {{$clients->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

