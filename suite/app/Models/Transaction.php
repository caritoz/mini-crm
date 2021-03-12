<?php
namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App
 *
 *
 * @property \DateTime created_at
 * @property \DateTime transaction_date
 * @property string reference
 * @property float amount
 * @property integer client_id
 * @property Client client
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'reference', 'amount'];

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

        return $client->full_name;
    }

    public function getTransactionDateAttribute()
    {
//        return $this->created_at->format('l jS \of F Y');
        return $this->created_at->format('M j, Y');
    }

    public function toArray()
    {
        return [
            'id'                => $this->id,
            'reference'         => $this->reference,
            'transaction_date'  => $this->transaction_date,
            'full_name'         => $this->client->full_name,
            'amount'            => number_format($this->amount, 2)
        ];
    }
}
