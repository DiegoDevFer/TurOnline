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
                <th>Galeria</th>
                <th>Editar</th>
                <th>Excluir</th>
                <th>Xml</th>
            </tr>
            </thead>
            <tbory>
                @foreach($cadastros as $dados)
                    <tr>
                        <td scope="row">{{$dados->id}}</td>
                        <td><a href="{{route('admin.ponto-turistico.show', ['id'=>$dados->id])}}">{{$dados->name}}</a>                        </td>
                        <td><a href="{{route('admin.ponto-turistico.gerarQr',['id'=>$dados->id])}}">GerarQr</a></td>
                        <td><a href="{{route('admin.ponto-turistico.create_gallery',['id'=>$dados->id])}}">Galleria</a></td>
                        <td><a href="{{route('admin.ponto-turistico.edit',['id'=>$dados->id])}}">Editar</a></td>
                        <td><a href="{{route('admin.ponto-turistico.destroy',['id'=>$dados->id])}}">Excluir</a>
                        </td>
                        <td><a href="{{route('admin.ponto-turistico.gerarXml')}}">gerarXml</a>
                        </td>
                    </tr>
                @endforeach
            </tbory>
        </table>
    </div>
@stop
