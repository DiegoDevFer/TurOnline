@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>{{$pontoTur->name}}</h4>

        <div>
            <div class="">
                {!! QrCode::size(900)->generate(route('show',['id'=>$pontoTur->id])); !!}
                <p></p>
            </div>
        </div>
@stop