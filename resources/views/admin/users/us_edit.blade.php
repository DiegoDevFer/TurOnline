@extends('layouts.app')
@section('content')
    <div class="container">
        @include('admin.errors')

        <h3><a href="{{route('admin.user.index')}}">Usuários-></a><strong>Editar usuário</strong></h3>

        {!! Form::model($user, ['route'=>['admin.user.update', $user->id], 'method'=>'put']) !!}

        @include('admin.users.us_form')

        {!! Form::submit('Salvar Alterações', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@stop