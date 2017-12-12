<?php

namespace TurOnline;

use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class TrataImagens extends Model
{
    /*
     * trata a imagem e guarda na pasta,
     * @return Retorna o camiho da imagem pronto para inserção no banco.
     * param $file = imagem que vem do formulário
     * param $dir NULLO pode ou não passar o caminho da imagem.
     */
    public function createImagem($file, $dir = null, $sizefile = null)
    {

//        dd($file, $dir, $sizefile);
        if (Input::file()):
            //inicio criação do nome da imagem
            $data = \Carbon\Carbon::now();
            $dt = $data->ToDateString();
            $micro = $data->micro;
            $hora = $data->format('H-i-s-m');
            $dtHora = $hora . '-' . $micro;

            //criando diretório
            if ($dir):
                $diretorio = $dir."/". $data->year . "/" . $data->month;
            else:
                $diretorio = 'img/' . $data->year . "/" . $data->month . "/" . $data->day;
            endif;

            //se não existir ele cria o diretorio
            if (!file_exists($diretorio)):
                mkdir($diretorio, 0777, true);
            endif;

            //data e hora servem para nomear a imagem de maneira única, concatenada com a extensão do arquivo.
            $imgName = $dtHora . '.' . $file->getClientOriginalExtension();

            $caminho = $diretorio . '/' . $imgName;


            //salva a imagem redimensionada no caminho indicado.
            $redImagem = Image::make($file->getRealpath());

            //se não for passado o tamanho por parâmetro então este será padraõ.
            $sizefile = (isset($sizefile)?$sizefile : 900);

            $redImagem->resize(null, $sizefile, function ($constraint) {
                $constraint->aspectRatio();
            });
            $redImagem->save($caminho);
            //$img->destroy();
        endif;

        return $caminho;
    }
}
