<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Transaction;

/**
 * Class Client
 * @package App
 *
 * @property integer id
 * @property string first_name
 * @property string last_name
 * @property string full_name
 * @property string email
 * @property string avatar
 * @property string full_path_avatar
 * @property integer amount_transactions
 * @property array transactions
 */
class Client extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'avatar'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['amount_transactions'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullPathAvatarAttribute()
    {
        $full_avatar = asset('storage/'. $this->avatar);

        // > HACK FOR FAKE LINKS
        if ( preg_match('/via.placeholder.com/', $this->avatar, $output_array) )
            $full_avatar = $this->avatar;
        // < HACK FOR FAKE LINKS

        return $full_avatar;
    }

    public function getAmountTransactionsAttribute()
    {
        return $this->transactions->count();
    }

    public function toArray()
    {
        return [
            'id'                => $this->id,
            'first_name'        => $this->first_name,
            'last_name'         => $this->last_name,
            'full_name'         => $this->full_name,
            'email'             => $this->email,
            'avatar'            => $this->avatar,
            'full_path_avatar'      => $this->full_path_avatar, // full path
            'transactions'          => $this->transactions,
            'amount_transactions'   => $this->amount_transactions
        ];
    }
}
