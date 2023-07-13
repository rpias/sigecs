@extends('layouts.layout')

@section('titulo')
Morosidad Por Torre y último pago por unidad
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<div class="card uper" style="display: <?php if (!$errors->any()) {
                                            echo "none";
                                        } else {
                                            echo "inline";
                                        } ?>">
    <div class="card-header">
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x </button>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
    </div>
</div>

@if(session()->has('exito'))
<div class="alert alert-success alert-block col-lg-10 ">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('exito')}}</strong>
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-success alert-block col-lg-10 ">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('error')}}</strong>
</div>
@endif

<div class="row-fluid sortable">
    <div class="box span12">

        <div class="box-header" data-original-title>
            <h2><i class="halfling-icon edit"></i><span class="break"></span></h2>
            <div class="box span12">
                <a href="#" class="btn-setting"><i class="halfling-icon wrench"></i></a>
                <a href="#" class="btn-setting"><i class="halfling-icon chevron-up"></i></a>
                <a href="#" class="btn-setting"><i class="halfling-icon remove"></i></a>
            </div>

        </div>

        <div class="box-content">
            <form class="form-horizontal" action="{{ url('mostrar_morosidad') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" id="hd_id_recibo" name="hd_id_recibo" />
                <div class="form-row">
                    <div class="col">
                        {!!Form::label('Edificio')!!}
                        <select id="select_edificio" name="select_edificio" class="form-control">
                            <option value="0">Listar Todos los Edificios</option>
                            @foreach ($edificios as $edificio)
                            <option value="{{$edificio->identificador}}">{{ $edificio->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        {!!Form::label('Días ')!!}
                        <select id="select_dias" name="select_dias" class="form-control">
                            <option value="30">30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                            <option value="90">90</option>
                            <option value="120">120</option>
                        </select>
                    </div>

                </div>
                <br />
                <div class="box box-primary">
                    <div id='table_responsive' style='min-height: 50px;'>
                        <div style="font-weight: bold" class="form-group">
                            <div class="col"><span> Morosidad {{$morosidad}} %</span></div>
                            <div class="col"><span>Fecha límite {{$fecha_limite}} ({{$dias}} días)</span></div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary" id="btn_agregar">Listar Morosos
                                </button>
                                <button type="button" class="btn btn-primary" id="btn_listar_ultimo_pago">Listar último pago por Unidad
                                </button>
                                <button type="button" class="btn btn-outline-danger" id="btn_generar_pdf_pagos">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                        <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                        <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z" />
                                    </svg>
                                    Generar PDF de pagos
                                </button>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col">
                    <h3>Morosidad por unidad</h3>
                    <table class="table table-bordered" id="tabla-morosidad" style='width: 100% !important;'>
                        <thead>
                            <th>Torre </th>
                            <th>Torre Nro.</th>
                            <th>Unidad</th>
                            <th>Fecha último pago</th>
                            <th>Número Recibo</th>
                            <th>Mes Pago</th>
                            <th>Año Pago</th>
                            <th>Observaciones</th>
                            <th>Expediente ANV</th>
                        </thead>

                        <tbody>
                            @if (isset($dt_morosos))
                            @foreach ($dt_morosos as $morosidad)
                            <tr>
                                <td>{{$morosidad->torre_nombre}}</td>
                                <td>{{$morosidad->torre_nro}}</td>
                                <td>{{$morosidad->unidad}}</td>
                                <td>{{$morosidad->fecha}}</td>
                                <td>{{$morosidad->nro_recibo}}</td>
                                <td>{{$morosidad->mes}}</td>
                                <td>{{$morosidad->anio}}</td>
                                <td>{{$morosidad->obs}}</td>
                                <td>{{$morosidad->ultimo_expediente}}</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col">
                    <h3>Último pago por unidad</h3>
                    <table class="table table-bordered" id="tabla_ultimo_pago" style='width: 100% !important;'>
                        <thead>
                            <th>Torre </th>
                            <th>Torre Nro.</th>
                            <th>Unidad</th>
                            <th>Fecha último pago</th>
                            <th>Número Recibo</th>
                            <th>Mes Pago</th>
                            <th>Año Pago</th>
                            <th>Observaciones</th>
                            <th>Expediente ANV</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
    </div>
</div>


@endsection


@section('scripts')

<!-- Propios de SIGECS -->
<script src="{{ asset ('js/cobranza/morosidad.js')}}"></script>


@endsection