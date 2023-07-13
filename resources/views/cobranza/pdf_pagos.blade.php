<link href="{{ public_path('css/pdf_pagos.css')}}" rel="stylesheet"/>
<link href="{{ public_path('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"/>

<img src="{{ public_path('img/comision_admin_central.jpeg') }}" alt="comision"/>


@if (isset($morosos))

@php
$encabezados = 3;
$filas = 1;
$elementoActual = 0;
$className="";
if(count($morosos) > 3)
{
    if(count($morosos) % 3 == 0)
    {
        $filas = count($morosos) / 3;
    }
    else
    {
        $filas = (count($morosos) / 3) + 1;
    }
}
@endphp

  <p class="encabezado">Pago de Gastos Comunes Torre    {{$morosos[0]->torre_nombre}} fecha: {{$fecha_Actual}} </p>


<table class="table">
    <thead class="thead-dark">
        <tr>
        @for ($i=0; $i < $encabezados; $i++)
            <th scope="col">Unidad</th>
            <th scope="col">Mes Pago</th>
        @endfor
        </tr>
    </thead>
    <tbody>


@for ($i=0; $i < $filas; $i++)
    <tr>
        @for($j=0; $j < $encabezados; $j++)
        @if($elementoActual < count($morosos))

        @php
        if($morosos[$elementoActual]->mes != null)
        {
            if($morosos[$elementoActual]->mes >= $mes_Actual && $morosos[$elementoActual]->anio >= $anio_Actual)
            {
                $className = "text-white bg-success";
            }
            else
            {
                $className = "text-dark bg-warning";
            }

        }
        else
        {
            $className = "text-white bg-danger";
        }
        @endphp


            <th class="{{$className}}" scope="row mt-3">{{$morosos[$elementoActual]->unidad}}</th>
            @switch($morosos[$elementoActual]->mes)
            @case(1)
                <td class="{{$className}}">Enero/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(2)
                <td class="{{$className}}">Febrero/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(3)
                <td class="{{$className}}">Marzo/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(4)
                <td class="{{$className}}">Abril/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(5)
                <td class="{{$className}}">Mayo/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(6)
                <td class="{{$className}}">Junio/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(7)
                <td class="{{$className}}">Julio/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(8)
                <td class="{{$className}}">Agosto/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(9)
                <td class="{{$className}}">Septiembre/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(10)
                <td class="{{$className}}">Octubre/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(11)
                <td class="{{$className}}">Noviembre/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @case(12)
                <td class="{{$className}}">Diciembre/{{$morosos[$elementoActual]->anio}}</td>
                @break
            @default
                <td class="{{$className}}">Ningún pago</td>
        @endswitch
            @php
                $elementoActual++;
            @endphp
        @endif
        @endfor

    </tr>
@endfor
    </tbody>
</table>
@endif

<img id="logoInferior" src="{{ public_path('img/comision_admin_central_sello.png') }}"/>
