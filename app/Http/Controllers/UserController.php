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

    public function index()
    {
        $users = User::all();
        return view('admin.users.us_index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.us_create');
    }

    public function store(Request $r)
    {
//        dd($r->all());
        $this->validate($r, $this->User->rules);
        $user = User::create($this->User->cadAdmin($r));
        return redirect()->route('admin.user.index')->with('status', 'Cadastrado com sucesso');
    }
}
