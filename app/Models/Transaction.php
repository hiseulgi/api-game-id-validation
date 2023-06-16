<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $fillable = [
        'transaction_number', 'reference_number', 'game_code', 'game_detail_id', 'buyer_game_id', 'amount', 'payment_method_id', 'email', 'status', 'user_id'
    ];

    public function game_detail(){
        return $this->belongsTo('App\Models\GameList', 'id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function payment_method(){
        return $this->belongsTo('App\Models\PaymentMethod', 'id');
    }
}
