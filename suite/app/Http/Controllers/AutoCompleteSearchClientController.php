<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class AutoCompleteSearchClientController extends Controller
{
    const perResult = 10;
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('query');

        if($search == '')
        {
            $clients = Client::orderby('first_name','asc')->select('*')
                ->limit(self::perResult)
                ->get();
        }
        else
        {
            $clients = Client::orderby('first_name','asc')->select('*')
                ->where('first_name', 'ilike', '%' .$search . '%')
                ->orWhere('last_name', 'ilike', '%' .$search . '%')
                ->limit(self::perResult)
                ->get();
        }

        $response = array();
        foreach($clients as $client)
        {
            $response[] = ['value' => $client->id, 'label' => $client->full_name ];
        }

        return response()->json($response);
    }
}
