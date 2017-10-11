@if(session('status'))
    <ul>
        <li>{{session('status')}}</li>
    </ul>
@endif

@if($errors->any())
    <ul>
        @foreach($errors->all() as  $erro)
            <li>{{$erro}}</li>
        @endforeach
    </ul>
@endif