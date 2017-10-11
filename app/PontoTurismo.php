<?php

namespace TurOnline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PontoTurismo extends Model
{
    protected $table = 'pontoturs';

    protected $fillable = [
        'name', 'description','user_id',
    ];

    public function users(){
        return $this->hasMany('TurOnline\User');
    }

    public function formataDados($dados){
        $dado = [
            'name'=>trim($dados->name),
            'description'=>trim($dados->description),
            'user_id'=>Auth()->user()->id
        ];
        return $dado;
    }
}
