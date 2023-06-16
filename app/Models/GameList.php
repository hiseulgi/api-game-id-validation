<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameList extends Model {
    use HasFactory;
    
    protected $table = "game_list";
    protected $fillable = [
        'game_code', 'game_name', 'icon_url'
    ];

    public function game_detail(){
        return $this->hasMany('App\Models\GameDetail', 'game_code');
    }
}
