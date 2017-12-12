<?php

namespace TurOnline\Http\Controllers;

//use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use TurOnline\User;

class UserController extends Controller
{
    private $User;

    /**
     * UserController constructor.
     */
    public function __construct(User $user)
    {
        $this->User = $user;
    }
    //METHODOS DE EXIBIÇÃO DE DADOS DO APLICATVO.

    /*
     * return VIEW com o mapa
     */
    public function map1(){
        return view('admin.dados.mapa1');
    }


    //FIM DOS METHODOS DE EXIBIÇÃO DE DADOS.

    public function index()
    {
        $users = User::all();
        return view('admin.users.us_index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.us_create');
    }


    public function edit($id)
    {
        $user = User::find($id);
        if (count($user) > 0):
            return view('admin.users.us_edit', compact('user'));
        else:
            return redirect()->route('admin.user.index')->withErrors('Registro não encontrado :(');
        endif;
    }


    public function store(Request $r)
    {
//        dd($r->all());
        $this->validate($r, $this->User->rules);
        $user = User::create($this->User->cadAdmin($r));
        return redirect()->route('admin.user.index')->with('status', 'Cadastrado com sucesso');
    }


    public function update(Request $r, $id)
    {

    }


    public function destroy($id)
    {
        $user = User::find($id);
        if (count($user) > 0):
            $user->delete();

            //pesquisa novamente. Caso encontre o registro, então deu erro ao tentar deletar.
            $deletado = User::find($id);
//            dd($deletado);
            if (count($deletado) != null):
                return back()->withErrors('Ocorreu um erro inesperado ao tentar deletar, tente novamente :(');
            else:
                return redirect()->route('admin.user.index')->with('status', 'Usuário deletado com sucesso');
            endif;

        else:
            return redirect()->route('admin.user.index')->withErrors('Registro não encontrado :(');
        endif;
    }
}
