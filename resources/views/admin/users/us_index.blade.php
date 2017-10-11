@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Usuários do sistema</h3>
        <a href="{{route('admin.user.create')}}" class="btn btn-primary">Novo</a>

        @include('admin.errors')
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nível</th>
                <th>#</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role}}</td>
                    <td><a href="{{route('admin.user.edit',['id'=>$user->id])}}">Editar</a></td>
                    @if(Auth::user()->id == $user->id)
                        <td><a href="{{route('admin.user.destroy',['id'=>$user->id])}}" disabled>Excluir</a></td>
                    @else
                        <td>Você</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop