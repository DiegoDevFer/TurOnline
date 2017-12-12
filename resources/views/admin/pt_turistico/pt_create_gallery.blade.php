@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Cadastrar galeria de fotos para </h3>
        <h5>{{$pontoTur->name}}</h5>

        @include('admin.errors')
        <div class="form">

            <form action="{{route('admin.ponto-turistico.store_gallery')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <br/><br/>
                Product photos (can attach more than one):
                <br/>
                <input type="file" name="galeria[]" multiple/>
                <br/><br/>
                <input type="hidden" name="pontotur_id" value="{{$pontoTur->id}}">
                <input type="submit" value="Upload"/>
            </form>

            <div id="message"></div>
        </div>
        @if(count($imagens)>0)
            @foreach($imagens as $img)
                {{$img}}
{{--                {{$raiz.$img->path_file_p}}--}}
            @endforeach
        @endif
    </div>
    {{--<script>--}}
    {{--var form = document.getElementById('galeria');--}}
    {{--var request = new XMLHttpRequest();--}}

    {{--form.addEventListener('submit', function (e) {--}}
    {{--e.preventDefault();--}}
    {{--var formdata = new FormData(form);--}}

    {{--request.open('post','/admin.ponto-turistico.store_gallery');--}}
    {{--request.addEventListener("load",transferComplete);--}}
    {{--request.send(formdata);--}}
    {{--});--}}
    {{----}}
    {{--function transferComplete(data) {--}}
    {{--response = JSON.parse(data.currentTarget.response);--}}
    {{--if(response.success){--}}
    {{--document.getElementById('message').innerHTML = "Sucesso!";--}}
    {{--}--}}
    {{--}--}}

    {{--</script>--}}

@endsection