@extends('layouts.base')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>
    <section class="text-gray-400 bg-gray-900 body-font">
        <div class="container px-5 py-24 mx-auto">
          <div class="flex flex-col text-center w-full mb-20">
            <form action="{{route('produits.create')}}" method="get">
                @csrf
                <button class="bg-blue-600 hover:bg-blue-500 text-black text-sm px-3 py-2 rounded-md">Ajouter</button>
            </form>
           </div>
          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Name</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800 rounded-tl rounded-bl">Email</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Roles</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-white text-sm bg-gray-800">Actions</th>
                </tr>
              </thead>
              <tbody>
                    @forelse( $users as $user )
                        <tr>
                            <td class="px-4 py-3"> <img alt="{{$chemin_image.$produit->image }}" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4" src="{{ $chemin_image.$produit->image }}" height="2%" width="2%"></td>
                            <td class="px-4 py-3">{{$user->name}}</td>
                            <td class="px-4 py-3">{{$user->email}}</td>
                            <td class="px-4 py-3">@if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $roles)
                                   <label class="badge bg-success">{{ $roles }}</label>
                                @endforeach
                              @endif
                            </td>
                            <td class="px-4 py-3 text-lg text-white">
                                <a href="{{route('users.edit',$user)}}">
                                <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-3 py-2 rounded-md">Editer</button>
                                </a>
                                <form action="{{route('users.destroy',$user)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button class="bg-red-600 hover:bg-red-500 text-white text-sm px-3 py-2 rounded-md">Supprimer</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                    <p>Aucun user</p>
                    @endforelse
                  </tbody>
                </table>
                <div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection

