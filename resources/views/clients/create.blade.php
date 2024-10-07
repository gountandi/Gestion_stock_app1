@extends('layouts.base')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Enregistrer un client") }}
                </div>
            </div>
            <div class="bg-white flex items-center justify-between mx-6 px-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
               <div class="p-6 w-full space-y-6">
                <form action="{{route('clients.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="client">Nom</label>
                                <input type="text" name="nom" id="nom" value="{{old('nom')}}"class="border-gray-300 rounded-md w-full">
                            </div>
                        </div>
                        <div class="flex space-x-3 items-center">
                            <div class="space-y-2 w-1/3">
                                <label for="client">Tel</label>
                                <input type="text" name="tel" id="tel" value="{{old('tel')}}" class="border-gray-300 rounded-md w-full">
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
