@extends('layouts.base')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Role Information Card -->
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Role Information') }}
                    </h3>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700">
                    <dl>
                        <!-- Role Name -->
                        <div class="bg-gray-50 dark:bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ __('Role Name') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                {{ $role->name }}
                            </dd>
                        </div>

                        <!-- Permissions -->
                        <div class="bg-white dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ __('Permissions') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100 sm:col-span-2 sm:mt-0">
                                <ul class="list-disc pl-5">
                                    @foreach ($role->permissions as $permission)
                                        <li>{{ $permission->name }}</li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('roles.edit', $role->id) }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                    {{ __('Edit') }}
                </a>
            </div>
        </div>
    </div>
@endsection
