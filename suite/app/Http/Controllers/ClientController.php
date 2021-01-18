<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientFormRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateFormRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * ClientController constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->middleware('auth');

        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $clients = $this->client->orderBy('updated_at', 'desc')->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientFormRequest $request)
    {
        try {
            $client = new Client();

            $client = $client->create($request->only([
                'first_name',
                'last_name',
                'email'
            ]));

            $client->avatar = $this->uploadImage($request);
            $client->save();

//        return response()->json($client);
            return redirect('/clients')->with('success', 'Client add!');
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        try
        {
            $client = Client::findOrFail($request['id']);

            return view('clients.show', compact('client'));
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        try
        {
            $client = Client::findOrFail($request['id']);

            return view('clients.edit', compact('client'));
        }
        catch (\Exception $ex)
        {

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateFormRequest $request
     * @param \App\Client $client
     * @return void
     */
    public function update(ClientUpdateFormRequest $request, Client $client)
    {
        try
        {
            $client->update($request->only([
                'first_name',
                'last_name',
                'email'
            ]));

            if ($request->hasFile('avatar'))
            {
                $client->avatar = $this->uploadImage($request);
                $client->save();
            }

            return redirect('/clients')->with('success', 'Client updated!');
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        try
        {
            $client = $this->client->findOrFail($client->id);

            if( count($client->transactions) > 0 )
            {
                return redirect('/clients')->with('errors', 'The Client could be not deleted. It contains transactions.');
            }
            else
            {
                Client::destroy($client->id);

                return redirect('/clients')->with('success', 'Client deleted!');
            }
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * @param Request $request
     * @return string|null
     */
    protected function uploadImage(Request $request)
    {
        try
        {
            $fileName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(storage_path('app/public'), $fileName);

            return $fileName;
        }
        catch (\Exception $ex)
        {
            //do something
        }
    }
}
