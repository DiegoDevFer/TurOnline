@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Usuários do sistema</h3>
        <a href="{{route('admin.user.create')}}" class="btn btn-primary">Novo</a>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <th>{{$user->name}}</th>
                    <th>{{$user->email}}</th>
                    <th>{{$user->role}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop