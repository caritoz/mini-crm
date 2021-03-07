<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\TransactionFormRequest;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    const resultsPerPage = 5;

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if( $request['client_id'] != '' )
            return $this->listByClient( $request);

        $transactions = $this->transaction->orderBy('created_at', 'desc')->paginate(self::resultsPerPage);

        return response()
            ->json($transactions->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function listByClient(Request $request)
    {
        try
        {
            $client = Client::findOrFail($request['client_id']);

            $transactions = $this->transaction->where('client_id', $client->id )->orderBy('created_at', 'desc')->paginate(self::resultsPerPage);

            return response()
                ->json($transactions->toArray());
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TransactionFormRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TransactionFormRequest $request)
    {
        try {
            $transaction = new Transaction();

            $transaction = $transaction->create($request->only([
                'client_id',
                'amount'
            ]));

            return response()
                ->json($transaction->toArray());
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param \App\Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Transaction $transaction)
    {
        try
        {
            $transaction = Transaction::findOrFail($request['id']);

            return response()
                ->json($transaction->toArray());
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TransactionFormRequest $request, Transaction $transaction)
    {
        try
        {
            $transaction->update($request->only([
                'client_id',
                'amount'
            ]));

            return response()
                ->json($transaction->toArray());
        }
        catch (\Exception $ex)
        {
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Transaction $transaction)
    {
        try
        {
            Transaction::destroy($transaction->id);

            return response()->json($transaction, Response::HTTP_OK);
        }
        catch (\Exception $ex)
        {
            // do something
            return response()->json(['message' => $ex->getMessage()], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
