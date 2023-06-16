<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {
    use HasFactory;
    protected $table = "payment_method";
    protected $fillable = [
        'name', 'tax', 'icon_url'
    ];

    public function transaction(){
        return $this->hasMany('App\Models\Transaction', 'payment_method_id');
    }
}
