@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">home</div>

                <div class="panel-body">
                    <a href="{{route('admin.user.index')}}">Usuários</a>
                </div>
                <div class="panel-body">
                    <a href="{{route('admin.ponto-turistico.index')}}">Pontos turísticos</a>
                </div>
                <div class="panel-body">
                    <a href="{{route('admin.user.map1')}}">Mapa de turistas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
