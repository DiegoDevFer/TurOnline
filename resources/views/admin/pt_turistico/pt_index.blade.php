@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Pontos turisticos</h3>
        <a href="{{route('admin.ponto-turistico.create')}}">Criar novo</a>
    </div>
@stop
