<?php

namespace TurOnline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TurOnline\TrataImagens;

class PontoTurismo extends Model
{
    protected $table = 'pontoturs';

    protected $fillable = [
        'name', 'description','img_capa','user_id',
    ];

    public function users(){
        return $this->hasMany('TurOnline\User');
    }

    public function imgPontos() {
        return $this->hasMany('TurOnline\ImgPontos', 'pontotur_id');
    }

    public function formataDados($dados){
        $imagem = new TrataImagens();
        $dado = [
            'name'=>trim($dados->name),
            'description'=>trim($dados->description),
            'img_capa' => $imagem->createImagem($dados->img_capa),
            'user_id'=>Auth()->user()->id
        ];
        return $dado;
    }
}
