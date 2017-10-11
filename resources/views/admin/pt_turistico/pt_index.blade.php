@extends('layouts.app')
@section('content')
    <div class="container">
        <h3><a href="#">Pontos turisticos</a></h3>
        <a href="{{route('admin.ponto-turistico.create')}}" class="btn btn-primary">Criar novo</a>

        @include('admin.errors')

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ação</th>
                <th>Excluir</th>
            </tr>
            </thead>
            <tbory>
                @foreach($cadastros as $dados)
                    <tr>
                        <td scope="row">{{$dados->id}}</td>
                        <td><a href="{{route('admin.ponto-turistico.show', ['id'=>$dados->id])}}">{{$dados->name}}</a>
                        </td>
                        <td><a href="{{route('admin.ponto-turistico.edit',['id'=>$dados->id])}}">Editar</a></td>
                        <td><a href="{{route('admin.ponto-turistico.destroy',['id'=>$dados->id])}}">Excluir</a></td>
                    </tr>
                @endforeach
            </tbory>
        </table>
    </div>
@stop
