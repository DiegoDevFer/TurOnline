@extends('layouts.app')
@section('content')
    <div class="container">
        <p>Editar ponto turístico</p>

        {!! Form::model($pontoTur,['route'=>['admin.ponto-turistico.update', $pontoTur->id], 'method'=>'put']) !!}
        @include('admin.pt_turistico.pt_form')

        {!! Form::submit('Salvar Alterações', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>

@stop