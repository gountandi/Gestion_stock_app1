@extends('layouts.base')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Header and Create Button -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4 flex items-center justify-between">
            <h2 class="text-gray-900 dark:text-gray-100 text-2xl font-semibold">
                Role Management
            </h2>
            @can('role-create')
                <a href="{{ route('roles.create') }}" class="bg-green-600 hover:bg-green-500 text-white text-sm px-4 py-2 rounded-md inline-flex items-center">
                    <i class="fa fa-plus mr-2"></i> Create New Role
                </a>
            @endcan
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Roles Table -->
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mx-6 px-6 py-4">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-800 dark:bg-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ ++$i }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $role->name }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('roles.show', $role->id) }}" class="text-blue-600 hover:text-blue-500">
                                    <i class="fa-solid fa-list mr-2"></i> Show
                                </a>
                                @can('role-edit')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600 hover:text-blue-500 mx-2">
                                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit
                                    </a>
                                @endcan
                                @can('role-delete')
                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-500">
                                            <i class="fa-solid fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mx-6">
            {!! $roles->links('pagination::tailwind') !!}
        </div>
    </div>
</div>
@endsection
