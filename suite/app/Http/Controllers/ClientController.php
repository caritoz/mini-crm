<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientFormRequest;
use App\Http\Requests\ClientUpdateFormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    const resultsPerPage = 5;
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
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function index()
    {
        $clients = $this->client->orderBy('updated_at', 'desc')->paginate(self::resultsPerPage);

        return response($clients->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientFormRequest $request
     * @return \Illuminate\Http\JsonResponse
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

            if ($request->hasFile('avatar'))
            {
                $client->avatar = $this->uploadImage($request);
            }

            $client->save();

            return response()->json($client, Response::HTTP_CREATED);
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, Client $client)
    {
        try
        {
            $client = Client::findOrFail($request['id']);

            return response()->json($client, Response::HTTP_OK);
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateFormRequest $request
     * @param \App\Client $client
     * @return \Illuminate\Http\JsonResponse
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

            return response()->json($client, Response::HTTP_CREATED);
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Client $client)
    {
        try
        {
            $client = $this->client->findOrFail($client->id);

            if( count($client->transactions) > 0 )
            {
                return response()->json([
                    'message' => 'The Client could be not deleted. It contains transactions.'],
                    Response::HTTP_EXPECTATION_FAILED);
            }
            else
            {
                Client::destroy($client->id);
                return response()->json($client, Response::HTTP_OK);
            }
        }
        catch (\Exception $ex)
        {
            // do something
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
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
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
