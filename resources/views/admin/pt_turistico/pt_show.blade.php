@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>{{$pontoTur->name}}</h4>
        <div>
            estou aqui


            <p>{{$pontoTur->description}}</p>
            <img src="../../../{{$pontoTur->img_capa}}">
        </div>
        {{--<div>--}}
            {{--<div class="">--}}
                {{--{!! QrCode::size(100)->generate(route('admin.ponto-turistico.edit',['id'=>$pontoTur->id])); !!}--}}
                {{--<p>Scan me to return to the original page.</p>--}}
            {{--</div>--}}
        {{--</div>--}}
@stop