@extends('layouts.base')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header and Back Button -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4 flex items-center justify-between">
            <h2 class="text-gray-900 dark:text-gray-100 text-2xl font-semibold">
                Edit Role
            </h2>
            <a href="{{ route('roles.index') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md inline-flex items-center">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4">
            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div class="space-y-4">
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                        <input type="text" name="name" id="name" placeholder="Name" class="border-gray-300 rounded-md w-full dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600" value="{{ $role->name }}">
                    </div>

                    <!-- Permissions -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Permissions:</label>
                        <div class="flex flex-wrap space-x-4">
                            @foreach($permission as $value)
                                <label class="inline-flex items-center text-gray-700 dark:text-gray-300">
                                    <input type="checkbox" name="permission[{{ $value->id }}]" value="{{ $value->id }}" class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $value->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md transition-colors duration-300 inline-flex items-center">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
