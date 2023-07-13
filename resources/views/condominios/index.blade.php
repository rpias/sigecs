@extends('layout')

@section('titulo')
   Condominios
@endsection

@section('menu')
  {{!! session()->get('menu') !!}}
@endsection

@section('contenido')

<!--
<div class="table table-responsive">
  <table class="table table-bordered" id="table">
    <tr>
        <th width="150px">id </th>
        <th>Nombre </th>
       
        <th class="text-center" width="150px">
            <a href="#" class="create-modal btn btn-success btn-sm"> 
                <i class="glyphicon glyphicon-plus"></i>
            </a>
        </th>
    </tr>
    {{ csrf_field() }}
    <?php $no=1;?>
    @foreach($condominios as $key => $value)
        <tr class="condominios{{$value->idcondominio}}">
            <td>{{ $no++ }}</td>
            <td>{{ $value->nombre}}</td>

            <td>{{ $value->create_at}}</td>

            <td>
            
            <a href="#" class="show-modal btn btn-info btn-sm" data-idcondominio="{{$value->idcondominio}}" data-nombre="{{$value->nombre}}"> 
                <i class="fa fa-eye"></i>
            </a>
            
            <a href="#" class="show-modal btn btn-warning btn-sm" data-idcondominio="{{$value->idcondominio}}" data-nombre="{{$value->nombre}}"> 
                <i class="glyphicon glyphicon-pencil"></i>
            </a>

            <a href="#" class="show-modal btn btn-danger btn-sm" data-idcondominio="{{$value->idcondominio}}" data-nombre="{{$value->nombre}}"> 
                <i class="glyphicon glyphicon-trash"></i>
            </a>

            </td>
        </tr>
    @endforeach

  </table>
</div>
-->

@endsection