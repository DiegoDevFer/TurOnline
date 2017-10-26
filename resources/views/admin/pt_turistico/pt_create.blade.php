@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Cadastrar no ponto Turístico</h3>

        @include('admin.errors')
        <div class="form">
            {!! Form::open(['route'=>'admin.ponto-turistico.store', 'method'=>'POST', 'files'=>'TRUE']) !!}

            @include('admin.pt_turistico.pt_form')

            {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection