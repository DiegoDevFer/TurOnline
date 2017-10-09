<?php

namespace TurOnline;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_S_ADMIN = 0;
    const ROLE_ADMIN = 1;

    public $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'cpf' => 'unique:users',
        'password' => 'required|same:confirmasenha|min:6'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'cpf', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Para uso do controller UserController.php
     */
    public function cadAdmin($dados)
    {
        $data = [
            'name' => trim($dados['name']),
            'email' => trim($dados['email']),
            'cpf' => trim($dados['cpf']),
            'password' => bcrypt(trim($dados['passowrd'])),
            'user_id' => Auth()->user()->id
        ];
        return $data;
    }
}
