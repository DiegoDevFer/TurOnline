<?php

namespace TurOnline\Http\Controllers;

use Illuminate\Http\Request;
use TurOnline\PontoTurismo;

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



    public function create()
    {
        return view('admin.pt_turistico.pt_create');
    }


    /*
     * Criar um novo registro na tabela de pontos turísticos.
     */
    public function store(Request $r)
    {
//        dd(strlen($r->description));

        $store = new PontoTurismo();

        $this->pTur->create($this->pTur->formataDados($r));

        return redirect()->route('admin.ponto-turistico.index');
    }


    public function update($id)
    {

    }



    public function edit($id)
    {
        $pontoTur = PontoTurismo::find($id);
        if (count($pontoTur) > 0):
            return view('admin.pt_turistico.pt_edit', compact('pontoTur'));
        else:
            return redirect()->route('admin.ponto-turistico.index')->withErrors('Não é possível editar um registro inexistente');
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
}
