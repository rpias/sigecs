@extends('layouts.layout')

@section('titulo')
   Cobranza de Facturas
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

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
                    {!!Form::open(['route'=>'cobranza.store', 'metod'=>'POST'])!!}
                    <div class="form-row">
                        <div class="col">
                            {!!Form::label('Edificio')!!}
                            <select id="select_edificio" name="" class="form-control">
                                <option value="">Seleccione Edificio</option>
                                @foreach ($edificios as $edificio)
                                    <option value="{{ $edificio->id_edificio}}">{{ $edificio->nombre}}</option>
                                @endforeach
                            </select> 
                        </div>

                        <div class="col">
                            {!!Form::label('Unidad')!!}
                            <select id="select_unidad" name="select_unidad" class="form-control"></select> 
                        </div>
                    </div>
                    <br /><br /> 
                    <div class="form-group">
                            <button id="btn_imp_recibo" type="submit" class="btn btn-primary mb-2">Imprimir Recibo</button>
                    </div>
                    <br /> 
                    <div class="box box-primary">
                        <div id='table_responsive' style='min-height: 700px;' >
                        <table class="table table-bordered" id="tabla-facturas" 
                        style='width: 100% !important;'>
                                <thead>
                                        <th>Id Factura</th>
                                        <th>Fecha Factura</th>
                                        <th>Edificio</th>
                                        <th>Unidad</th>
                                        <th>Concepto</th>
                                        <th>Monto</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Fecha Límite</th>
                                        <th>Cobrar</th>
                                
                                </thead>
                            </table>
                        </div>   
                    
                    {!!Form::close()!!}
                            
                
                </div> 

            </div> 
        </div> 
        </div> 

    


@endsection


@section('scripts')

    <!-- Propios de SIGECS -->
    <script src="{{ asset ('js/cobranza/create.js')}}"></script>
  

@endsection