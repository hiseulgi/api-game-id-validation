<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDetail extends Model {
    use HasFactory;
    
    protected $table = "game_detail";
    protected $fillable = [
        'product_name', 'price', 'game_code'
    ];

    public function game_list(){
        return $this->belongsTo('App\Models\GameList', 'game_code');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction', 'game_detail_id');
    }
}
