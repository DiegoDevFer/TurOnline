@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Usuários > <strong>Novo</strong></h3>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $erro)
                    <li>{{$erro}}</li>
                @endforeach
            </ul>
        @endif
        <div class="container">
            <div class="form">
                {!! Form::open(['route'=>   'admin.user.store', 'method'=>'POST']) !!}
                @include('admin.users.us_form')
                <br>
                {!! Form::submit('Cadastrar', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
