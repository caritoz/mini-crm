<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Client extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'avatar'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
