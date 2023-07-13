@extends('layouts.layout')

@section('titulo')
Cobro de Facturas
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<div class="card uper" style="display: 
<?php
if (!$errors->any()) {
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
<div id="exito" class="alert alert-success alert-block col-lg-10">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('exito')}}</strong>
</div>
@endif

@if(session()->has('eliminado'))
<div id="eliminado" class="alert alert-success alert-block col-lg-10">
    <button type="button" class="close" data-dismiss="alert">x </button>
    <strong>{{session('eliminado')}}</strong>
</div>
@endif

@if(session()->has('error'))
<div id="error" class="alert alert-success alert-block col-lg-10">
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

        <form id="frm_recibo" class="form-horizontal">
            {{ csrf_field() }}

            <input type="hidden" id="hd_id_recibo" name="hd_id_recibo" />
            <input type="hidden" id="hd_eliminar" name="hd_eliminar" />

            <div class="form-row">
                <div class="col">
                    {!!Form::label('Edificio')!!}
                    <select id="select_edificio" name="" class="form-control">
                        <option value="0">Seleccione Edificio</option>
                        @foreach ($edificios as $edificio)
                        <option value="{{$edificio->id_edificio}}">{{ $edificio->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    {!!Form::label('Unidad')!!}
                    <select id="select_unidad" name="select_unidad" require class="form-control"></select>
                </div>
            </div>

            <br />

            <div class="box box-primary">
                <div id='table_responsive'>

                    <div class="form-row">
                        <div class="col">
                            {!!Form::label('Concepto')!!}
                            <select id="select_concepto" name="select_concepto" class="form-control">
                                <option value="">Seleccione Concepto</option>
                                @foreach ($conceptos as $concepto)
                                <option value="{{ $concepto->id_concepto_factura }}">{{ $concepto->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            {!!Form::label('Forma de Pago')!!}
                            <select id="select_forma_pago" name="select_forma_pago" class="form-control">
                                <option value="">Seleccione Forma de Pago</option>
                                @foreach ($fpagos as $fpago)
                                <option value="{{$fpago->id_forma_pago}}">{{ $fpago->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                      
                    </div>

                    <br />
                    
                    <div class="form-row">
                        
                        <div class="col-2">
                            <label for="txt_fecha">Fecha Recibo</label>
                            <input id="txt_fecha" name="txt_fecha" class="form-control" type="date" min="2010-01-01" require value="<?php echo date("Y-m-d"); ?>" />
                        </div>

                        <div class="col-2">
                            <label for="select_serie">Serie recibo</label>
                            <select id="select_serie" name="select_serie" class="form-control" aria-label="Default select example">
                                <option value="A">A</option>
                                <option value="B" selected>B</option>
                            </select>
                        </div>


                        <div class="col-2">
                            <label for="txt_nro_recibo">Número recibo</label>
                            <input id="txt_nro_recibo" name="txt_nro_recibo" style=" font-size: 20px; font-weight: bold; color: #b22222; float:left" class="form-control" type="number" min="1" max="99999999" require value="0" />
                        </div>

                        <div class="col">
                            <label for="txt_titular">Titular Recibo</label>
                            <input id="txt_titular" name="txt_titular" class="form-control" />
                        </div>
                        
                    </div>

                    <br />

                    <div class="form-row">

                        <div class="col-2">
                            <label for="txt_mes_cuota">Mes o Cuota</label>
                            <input id="txt_mes_cuota" name="txt_mes_cuota" class="form-control" 
                            type="number" min="1" max="60" require value="0" />
                        </div>

                        <div class="col-2">
                            {!!Form::label('Año')!!}
                            <select id="select_anio" name="select_anio" class="form-control">
                                <option value="">Seleccione Año</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="txt_importe">Importe G.C.</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="1" max="99999999" id="txt_importe" 
                                name="txt_importe" class="form-control" require value="0" 
                                aria-label="Amount (to the nearest dollar)" 
                                style=" font-size: 20px; font-weight: bold; color: #b22222; float:left">
                            </div>
                        </div>

                        <div class="col">
                            <label for="txt_interes">Importe Interes</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="1" max="99999999" id="txt_interes" 
                                name="txt_interes" class="form-control" require value="0" 
                                aria-label="Amount (to the nearest dollar)" 
                                style=" font-size: 20px; font-weight: bold; color: #b22222; float:left">
                            </div>
                        </div>

                        <div class="col">
                            <label for="txt_total">Importe Total</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$U</span>
                                </div>
                                <input type="number" min="1" max="99999999" id="txt_total" 
                                name="txt_total" class="form-control" require value="0" 
                                aria-label="Amount (to the nearest dollar)" 
                                style=" font-size: 20px; font-weight: bold; color: #b22222; float:left">
                            </div>
                        </div>
                      
                    </div>
                    
                    <br />

                    <div class="form-row">
                       
                        <div class="col">
                            <label for="txt_obs">Observaciones</label>
                            <input id="txt_obs" name="txt_obs" class="form-control" />
                        </div>

                        <div class="col-2">
                            <label for="txt_recibo_emergencia">Recibo Emergencia</label>
                            <input id="txt_recibo_emergencia" name="txt_recibo_emergencia" class="form-control" />
                        </div>
                    </div>

                    <br />

                    <div class="form-row">
                        <div id="mensaje_interes" class="col alert-warning">
                            <label id="span_mensaje_interes"></label>
                        </div>
                    </div>

                    <br />

                    <div class="form-row">
                        <div class="col">
                            <button type="buttom" style="width: 95%" class="btn btn-success" id="btn_agregar">
                                Ingresar Recibo
                            </button>
                        </div>

                        <div class="col">
                            <button type="button" style="width: 95%" class="btn btn-warning" id="btn_modificar">
                                Modificar Recibo
                            </button>
                        </div>
                    
                        <div class="col">

                            <button type="button" style="width: 95%" class="btn btn-info" id="btn_ver_recibos">
                                Ver Pagos
                            </button>

                        </div>
                        <div class="col"></div>
                        <div class="col"></div>

                    </div>

                </div>
            </div>

            <br />

        </form>

        <div class="form-row">
            <table class="table table-bordered" id="tabla-recibos">
                <thead>
                    <th>Id </th>
                    <th>Serie</th>
                    <th>Nro. Rec.</th>
                    <th>Fecha </th>
                    <th>Edificio</th>
                    <th>Unidad</th>
                    <th>Id Concepto</th>
                    <th>Concepto</th>
                    <th>Id Forma Pago</th>
                    <th>Forma Pago</th>
                    <th>Importe</th>
                    <th>Recargo</th>
                    <th>Precio GC</th>
                    <th>Mes/Cuota</th>
                    <th>Año</th>
                    <th>Titular</th>
                    <th>Obs</th>
                    <th class="text-center"> Seleccionar </th>
                    <th class="text-center"> Imprimir </th>
                </thead>
            </table>
        </div>

        <br />
    </div>

</div>

@endsection

@section('scripts')

<!-- Propios de SIGECS -->
<script src="{{ asset ('js/cobranza/recibos.js')}}"></script>

@endsection