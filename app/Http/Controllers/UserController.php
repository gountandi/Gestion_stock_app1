<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Client;


class UserController extends Controller
{
    public function login(Request $request){
        return view('auth.login');
    }

    public function register(Request $request){
        return view('auth.register');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagination_number=5;

        $users = User::paginate($pagination_number);


        return view('users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $client = Client::create([
            'nom' => $request->input('name'),
            'tel' => $request->input('telephonne'),
        ]);

        $user=User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mot_de_passe' => bcrypt($request->input('mot_de_passe')),
            'client_id' => $client->id,
        ]);

        //$user->assignRole($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->load('client');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->client->update([
            'nom' => $request->input('nom'),
            'tel' => $request->input('telephone'),
        ]);

        // Mettre à jour l'utilisateur
        $user->update([
            'email' => $request->input('emai'),
            'mot_de_passe' => $request->mot_de_passe ? bcrypt($request->mot_de_passe) : $user->mot_de_passe,
            'role_id' => $request->role_id,
        ]);
        //$user->assignRole($request->input('roles'));
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
