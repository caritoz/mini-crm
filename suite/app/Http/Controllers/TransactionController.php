<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\TransactionFormRequest;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->middleware('auth');

        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $client_id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = $this->transaction->orderBy('created_at', 'desc')->paginate(10);
        $client = null;

        return view('transactions.index', compact('transactions'), compact('client'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listByClient(Request $request)
    {
        try
        {
            $client = Client::findOrFail($request['client_id']);

            $transactions = $this->transaction->where('client_id', $request['client_id'] )->paginate(10);
//        return response()->json($transactions);

            return view('transactions.index', compact('transactions'), compact('client'));
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TransactionFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionFormRequest $request)
    {
        try {
            $transaction = new Transaction();

            $transaction->create($request->only([
                'client_id',
                'amount'
            ]));

            return redirect('/transactions')->with('success', 'Transaction add!');
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::findOrFail($request['id']);

        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionFormRequest $request, Transaction $transaction)
    {
        try
        {
            $transaction->update($request->only([
                'client_id',
                'amount'
            ]));

            return redirect('/transactions')->with('success', 'Transaction updated!');
        }
        catch (\Exception $ex)
        {
            // do something
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        try
        {
            Transaction::destroy($transaction->id);

            return redirect('/transactions')->with('success', 'Transaction deleted!');
        }
        catch (\Exception $ex)
        {
            // do something
            \Log::info($ex->getMessage());
        }
    }
}
