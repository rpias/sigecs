@extends('layout')

@section('titulo')
   Cobranza
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')


    {!!Form::open(['route'=>'cobranza.store', 'metod'=>'POST'])!!}





    {!!Form::submit('Guardar Cobranza',['class'=>'btn btn-primary'])!!}


{!!Form::close()!!}


@endsection