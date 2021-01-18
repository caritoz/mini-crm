<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class AutoCompleteSearchClientController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('query');

        if($search == '')
        {
            $clients = Client::orderby('first_name','asc')->select('id', 'first_name', 'last_name')->limit(5)->get();
        }
        else
        {
            $clients = Client::orderby('first_name','asc')->select('id','first_name', 'last_name')
                ->where('first_name', 'ilike', '%' .$search . '%')
                ->orWhere('last_name', 'ilike', '%' .$search . '%')
                ->limit(5)->get();
        }

        $response = array();
        foreach($clients as $client)
        {
            $response[] = ['value' => $client->id, 'label' => $client->first_name .' '. $client->last_name ];
        }

        return response()->json($response);
    }
}
