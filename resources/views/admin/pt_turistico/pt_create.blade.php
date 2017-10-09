@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Cadastrar no ponto Turístico</h3>
        <div class="form">
            {!! Form::open(['route'=>'admin.ponto-turistico.store', 'method'=>'POST']) !!}

            @include('admin.pt_turistico.pt_form')
            <br>
            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection