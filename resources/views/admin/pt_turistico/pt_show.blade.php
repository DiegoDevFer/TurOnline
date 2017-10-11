@extends('layouts.app')
@section('content')
    <div class="container">
            <h4>{{$pontoTur->name}}</h4>
        <div>
            <p>{{$pontoTur->description}}</p>
        </div>
    </div>
@stop