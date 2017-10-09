<div class="row">
    <div class="form-group col-xs-4">
        {!! Form::label('name', 'Nome', ['class'=>'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Digite seu nome']) !!}
    </div>

    <div class="form-group col-xs-4">
        {!! Form::label('cpf', 'Cpf', ['class'=>'control-label']) !!}
        {!! Form::text('cpf', null, ['class'=>'form-control','placeholder'=>'Ex: 999.9999.999-99']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-8">
        {!! Form::label('email', 'E-mail', ['class'=>'control-label']) !!}
        {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Digite aqui o email']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-4">
        {!! Form::label('password', 'Senha', ['class'=>'control-label']) !!}
        {!! Form::password('password', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group col-xs-4">
        {!! Form::label('confirmasenha', 'Confirme a senha:', ['class'=>'control-label']) !!}
        {!! Form::password('confirmasenha', null, ['class'=>'form-control']) !!}
    </div>
</div>