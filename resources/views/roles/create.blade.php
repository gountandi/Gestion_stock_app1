@extends('layouts.base')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Header Card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4 flex items-center justify-between">
                <h3 class="text-gray-900 dark:text-gray-100 text-lg font-semibold">
                    {{ __("Créer un rôle") }}
                </h3>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4">
                <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        <!-- Nom -->
                        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
                            <div class="flex-1 space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600" placeholder="Nom du rôle">
                            </div>
                        </div>

                        <!-- Permissions -->
                        <div class="flex flex-col space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permissions</label>
                            <div class="flex flex-wrap space-x-4">
                                @foreach($permission as $value)
                                    <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                                        <input type="checkbox" name="permission[{{ $value->id }}]" value="{{ $value->id }}" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ml-2">{{ $value->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md transition-colors duration-300">
                                Ajouter
                            </button>
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="mt-4 text-red-500">
                            {{ implode('', $errors->all('<p>:message</p>')) }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
