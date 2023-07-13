@extends('layout')

@section('titulo')
   Crear Condominios
@endsection

@section('menu')
  {{!! session()->get('menu') !!}}
@endsection

@section('contenido')


    {!!Form::open(['route'=>'condominio.store', 'metod'=>'POST'])!!}

        <div class="form-group">
            {!!Form::label('Nombre:')!!}
            {!!Form::text('txtnombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese Nombre del Condominio' ])!!}
        </div>

        <div class="form-group">
            {!!Form::label('Dirección:')!!}
            {!!Form::text('txtdireccion', null, ['class'=>'form-control', 'placeholder'=>'Ingrese Dirección del Condominio' ])!!}
        </div>

        <div class="form-group">
            {!!Form::label('Teléfono:')!!}
            {!!Form::text('txttelefono', null, ['class'=>'form-control', 'placeholder'=>'Ingrese Teléfono del Condominio' ])!!}
        </div>

        {!!Form::submit('Guardar Condomminio',['class'=>'btn btn-primary'])!!}

     {!!Form::close()!!}


@endsection