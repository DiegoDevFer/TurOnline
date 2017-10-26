<?php

namespace TurOnline\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use TurOnline\PontoTurismo;
use TurOnline\RegisterQrAccess;
use TurOnline\User;

class PontoTuristicoController extends Controller
{
    private $pTur;

    /**
     * PontoTuristicoController constructor.
     * @param $pTur
     */
    public function __construct(PontoTurismo $pTur)
    {
        $this->pTur = $pTur;
    }


    public function index()
    {
        $cadastros = PontoTurismo::all();

        return view('admin.pt_turistico.pt_index', compact('cadastros'));
    }


    public function show($id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.pt_show', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrado :(');
        endif;
    }

    /*
     * Mostra o ponto turistico cadastrado no QrCode disponível nos locais estratégicos na cidade
     */
    public function showPontoTur($id)
    {
        //registra os dados do cliente para fins de estatística.
        $registros = new RegisterQrAccess();
        $registros->create($registros->dados());

        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('view_public.show', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrado :(');
        endif;
    }

    /*
     * redireciona para a view que vai gerar o qrCode com o id
     */
    public function gerarQrCode($id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.qrcode', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrado :(');
        endif;
    }






    //||||||||||||||||||||||||||||||||||||Aqui começa o CRUD|||||||||||||||||||||||||||||||||||||||||||||||||||||\\

    public function create()
    {
        return view('admin.pt_turistico.pt_create');
    }


    /*
     * Criar um novo registro na tabela de pontos turísticos.
     */
    public function store(Request $r)
    {


//        dd($r->file('foto'));
//        $f = Storage::disk('local')->put($r-
//        $ip = $r->getClientIp();
//        Log::info('oi estou aqui');

//        dd($ip);
        $store = new PontoTurismo();
        $this->pTur->create($this->pTur->formataDados($r));

        return redirect()->route('admin.ponto-turistico.index');
    }


    public function edit(Request $r, $id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.pt_edit', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Não é possível editar um registro inexistente');
        endif;
    }


    public function update(Request $r, $id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            $pontoTur->update($this->pTur->formataDados($r));
            return back();
        endif;
    }


    public function destroy($id)
    {
        $pontoTur = $this->pTur->find($id);
        if (count($pontoTur) > 0):
            $pontoTur->delete();
            return redirect()->route('admin.ponto-turistico.index')->with('status', 'Deletado com sucesso');
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Registro não encotrando');
        endif;
    }

    //||||||||||||||||||||||||||||||||||||||||||| Fim do CRUD |||||||||||||||||||||||||||||||||||||||||||||||\\
}
