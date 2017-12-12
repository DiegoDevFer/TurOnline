{!! Form::label('name', 'Nome:') !!}
{!! Form::text('name', null,['name'=>'name','placeholder'=>'Informe o nome do local','class'=>'form-control']) !!}

{!! Form::label('description','Descrição') !!}
{!! Form::textarea('description', null, ['placeholder'=>'Descreva aqui o ponto turistico', 'class'=>'form-control']) !!}

{!! Form::label('img_capa', 'Capa') !!}
{!! Form::file('img_capa',['name'=>'img_capa']) !!}

{{--{!! Form::label('galeria', 'Galeria de Fotos') !!}--}}
{{--{!! Form::file('foto[]', ['name'=>'galeria', 'multiple']) !!}--}}

<br>