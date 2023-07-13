@extends('layouts.layout')

@section('titulo')
   Consulta de Recibos
@endsection


@section('encabezados')

<style>
    .botoneees{

        margin: 10px;
        
    }

    #tabla_consulta_recibos_length{

        margin-top: 17px;
    }


    #tabla_consulta_recibos_filter{

        margin-top: 17px;
        margin-right: 17px;
    }
</style>
  
@endsection

@section('menu')
{{!! $menu_str !!}}
@endsection

@section('contenido')

<div class="box-content">
    <form class="form-horizontal" action="{{ url('conultar_recibos') }}" method="post">
    {{ csrf_field() }}
        
        <div class="form-row">
            <div class="col">
                <label for="txt_fecha_ini">Fecha inicial</label>
                <input id="txt_fecha_ini" name="txt_fecha_ini" class="form-control" 
                type="date" min="2010-01-01" require
                value="<?php echo date("Y-m-d");?>" />
            </div>

            <div class="col">
                <label for="txt_fecha_fin">Fecha final</label>
                <input id="txt_fecha_fin" name="txt_fecha_fin" class="form-control" 
                type="date" min="2010-01-01" require
                value="<?php echo date("Y-m-d");?>" />
            </div>

            <div class="col">
                    <label for="">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div class="form-check">
                            <input type="checkbox" class="form-check-input" 
                                name="chk_anulados" value="1" id="chk_anulados">
                            <label class="form-check-label" 
                                id="lbl_anulados" 
                                for="chk_anulados">Listar Recibos Anulados
                            </label>
                        </div>
                </div>
        </div>

        <div class="form-row">
                <div class="col-sm-6">
                        <label for="btn_consultar">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="submit" class="btn btn-primary" style="width: 98%" id="btn_consultar">
                            Consultar Recibos
                        </button>
                    </div>
            </div>

        <div class="form-row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
        <div class="form-row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
     

        @isset($registros)
            <div class="form-row">
                    <table class="table table-bordered" id="tabla_consulta_recibos" 
                        style='width: 95% !important;'>
                        <thead>
                            <th>Fecha </th>
                            <th>Nro. Rec.</th>
                            <th>Torre Letra</th>
                            <th>Torre Nro.</th>
                            <th>Unidad</th>
                            <th>Importe</th>
                            <th>Concepto</th>
                            <th>Mes/Cuota</th>
                            <th>Año</th>
                            <th>Titular</th>
                            <th>Usuario</th>
                            <th>Obs</th>
                            <th>IdUsuario</th>
                            <th>Creado</th>
                            <th>Forma Pago</th>
                        </thead>
                        <tbody>
                            @foreach($dt_recibos as $recibo)
                                <tr>
                                    
                                    <td>{{$recibo->fecha}}</td>
                                    <td>{{$recibo->numero}}</td>
                                    <td>{{$recibo->edificio}}</td>
                                    <td>{{$recibo->edificio_id}}</td>
                                    <td>{{$recibo->unidad}}</td>
                                    <td>{{$recibo->importe}}</td>
                                    <td>{{$recibo->concepto}}</td>
                                    <td>{{$recibo->mes}}</td>
                                    <td>{{$recibo->anio}}</td>
                                    <td>{{$recibo->titular}}</td>
                                    <td>{{$recibo->usuario}}</td>
                                    <td>{{$recibo->obs}}</td>
                                    <td>{{$recibo->id_usuario}}</td>
                                    <td>{{$recibo->creado}}</td>
                                    <td>{{$recibo->forma_pago}}</td>
                                </tr> 
                            @endforeach  
                        </tbody>
                    </table>
            </div>
        @endisset
       

    </form>
</div>



@endsection


@section('scripts')
 
<script>

$(document).ready(function() {
    $('#tabla_consulta_recibos').DataTable(
		{
            "dom": '<"botoneees dt-buttons" B><"clear">lftrip', //https://datatables.net/examples/basic_init/dom.html
            "paging": true,
            language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
			"autoWidth": true,
			"buttons": [
                {
                    text: 'Excel',
                    extend: 'excel',
                    filename: 'lista_recibos',

                    },
				{
					text: 'PDF',
					extend: 'pdfHtml5',
					filename: 'lista_recibos',
					orientation: 'landscape', //portrait
					pageSize: 'A4', //A3 , A5 , A6 , legal , letter
					exportOptions: {
						columns: ':visible',
						search: 'applied',
						order: 'applied'
                    },
                    
                   
					customize: function (doc) {
						//Remove the title created by datatTables
						doc.content.splice(0,1);
						//Create a date string that we use in the footer. Format is dd-mm-yyyy
						var now = new Date();
						var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
						// Logo converted to base64
						// var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
						// The above call should work, but not when called from codepen.io
						// So we use a online converter and paste the string in.
						// Done on http://codebeautify.org/image-to-base64-converter
						// It's a LONG string scroll down to see the rest of the code !!!
                        
                        // A documentation reference can be found at
						// https://github.com/bpampuch/pdfmake#getting-started
						// Set page margins [left,top,right,bottom] or [horizontal,vertical]
						// or one number for equal spread
						// It's important to create enough space at the top for a header !!!
						doc.pageMargins = [20,60,20,30];
						// Set the font size fot the entire document
						doc.defaultStyle.fontSize = 7;
						// Set the fontsize for the table header
						doc.styles.tableHeader.fontSize = 7;
						// Create a header object with 3 columns
						// Left side: Logo
						// Middle: brandname
						// Right side: A document title
						doc['header']=(function() {
							return {
								columns: [
									{
										image: logo,
										width: 24
									},
									{
										alignment: 'left',
										italics: true,
										text: 'Lista de Recibos',
										fontSize: 18,
										margin: [10,0]
									},
									{
										alignment: 'right',
										fontSize: 14,
										text: 'Comisión Administradora Central CH71'
									}
								],
								margin: 20
							}
						});
						// Create a footer object with 2 columns
						// Left side: report creation date
						// Right side: current page and total pages
						doc['footer']=(function(page, pages) {
							return {
								columns: [
									{
										alignment: 'left',
										text: ['Created on: ', { text: jsDate.toString() }]
									},
									{
										alignment: 'right',
										text: ['page ', { text: page.toString() },	' of ',	{ text: pages.toString() }]
									}
								],
								margin: 20
							}
						});
						// Change dataTable layout (Table styling)
						// To use predefined layouts uncomment the line below and comment the custom lines below
						// doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
						var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return .5; };
						objLayout['vLineWidth'] = function(i) { return .5; };
						objLayout['hLineColor'] = function(i) { return '#aaa'; };
						objLayout['vLineColor'] = function(i) { return '#aaa'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
				}
				}]
		});
} );




</script>

@endsection