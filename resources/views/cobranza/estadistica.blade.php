@extends('layouts.layout')

@section('titulo')
   Estadística de Cobranza Mensual
@endsection

@section('encabezados')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')
  <!-- Custom tabs (Charts with tabs)-->
<div class="card">
    <div class="card-header">
    <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Cobranza mensual
    </h3>
    <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#grafico_area" data-toggle="tab">Área</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#grafico_barras" data-toggle="tab">Barras</a>
        </li>
        </ul>
    </div>
    </div><!-- /.card-header -->
    <div class="card-body">
    <div class="tab-content p-0">
  
        <div class="chart tab-pane" id="grafico_area" style="position: relative; height: 300px;">
            <canvas id="area-chart-canvas" height="300" style="height: 300px;"></canvas>                         
        </div>

        <div class="chart tab-pane active" id="grafico_barras" style="position: relative; height: 300px;">
            <canvas id="barras-chart-canvas" height="300" style="height: 300px;"></canvas>                         
        </div>  
        
        
    </div>
    </div><!-- /.card-body -->
</div>
<!-- /.card -->

@endsection

@section('scripts')

    <!-- Propios de SIGECS -->

    <script src="{{ asset ('js/cobranza/estadistica.js')}}"></script>


@endsection
