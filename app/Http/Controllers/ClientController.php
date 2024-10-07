<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_value=$request->input("search");
        $pagination_number=5;
        if ($search_value){
             $clients = Client::where("nom", "like", "%".$search_value. "%")
             ->orWhere("prenom", $search_value)
             ->orWhere("date_naiss", $search_value)
             ->orWhere("tel", $search_value)
             ->paginate($pagination_number);
        }
        else{
             $clients = Client::paginate($pagination_number);

        }
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $client=Client::create(['nom'=>$request->input('nom'),
        'prenom'=>$request->input('prenom'),
        'date_naiss'=>$request->input('date_naiss'),
        'tel'=>$request->input('tel')],);
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
       $client->update($request->all());
       return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
