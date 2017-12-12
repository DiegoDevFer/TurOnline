<?php

namespace TurOnline;

use Illuminate\Database\Eloquent\Model;

class ImgPontos extends Model
{
    protected $table = 'imgpontos';
    protected $fillable = [
        'capa','path_file_p','path_file_m','path_file_g','pontotur_id','title','description'
    ];

    public function pontoTurs (){
        return $this->hasOne('TurOnline\PontoTurismo');
    }

}
