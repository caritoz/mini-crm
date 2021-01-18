<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['client_id', 'amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');// alternative "public function client()"
    }

    /**
     * @return string
     */
    public function ClientName()
    {
        $client = Client::findOrFail($this->client_id);

        return $client->first_name . ' ' . $client->last_name;
    }
}
