$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //$('#select_unidad').html('<option value="0">Seleccione Unidad</option>');
    $('#select_unidad').on('change', onSelectUnidadChange);
    $('#btn_listar').on('click', onClickBotonListar);
    $('#btn_eliminar').on('click', onClickBotonEliminar);
    $('#btn_agregar').attr("disabled", false);
    $('#btn_modificar').attr("disabled", true);
    $('#btn_eliminar').attr("disabled", true);
    $('#btn_cerrar').attr("disabled", true);
    $('#btn_agregar_mov').attr("disabled", true);

    $('#btn_cerrar').hide();

});

function onClickBotonEliminar() {

    $('#hd_eliminar').val(1);
}

function onClickBotonListar() {

    $('#select_edificio').val(0);
    $('#select_unidad').val(0);
    onSelectUnidadChange();
}

function onSelectUnidadChange() {

    id_unidad = $('#select_unidad').val();
    activar_tabla_expedientes(id_unidad);

    return;
}

/*
function cargarComboUnidades(id_unidad){

    var id_edificio = $('#select_edificio').val();
    if(id_edificio > 0 ){
        var ruta_unidades_por_edificio = ruta_raiz + "edificios/" + id_edificio + "/unidades";
        $.get(ruta_unidades_por_edificio, function(data) {
            var html_select = '';
            html_select = '<option value="0">Seleccione Unidad</option>';
            for (var i = 0; i < data.length; ++i) {

                if(data[i].id_unidad == id_unidad){
                    html_select += '<option selected="selected" value="' + data[i].id_unidad + '">' + data[i].identificador + '</option>';
                    $('#select_unidad').html(html_select);
                }else{
                    html_select += '<option value="' + data[i].id_unidad + '">' + data[i].descripcion + '</option>';
                    $('#select_unidad').html(html_select);
                }
            }
        });

    }else{
        html_select = '<option value="0">Seleccione Unidad</option>';
        $('#select_unidad').html(html_select);
    }
}
*/

function onSelectEdificioChange() {
    var id_unidad_por_defecto = 0;
    cargarComboUnidades(id_unidad_por_defecto);
}

function activar_tabla_expedientes(id) {

    var ruta_expedientes_por_unidad = ruta_raiz + 'unidades/' + id + '/expedientes';
    var datatable = $('#tabla_expedientes').DataTable({
        dom: 'Bfrtip',
        buttons: [{
            extend: 'excel',
            text: 'Excel',
            footer: true,
            title: 'Lista de Expedientes por Apartamento',
            filename: 'ListaExpedientesPorApartamento'
        },

        {
            extend: 'pdf',
            text: 'PDF',
            footer: true,
            image: logo,
            title: 'Lista de Expedientes por Apartamento',
            filename: 'ListaExpedientesPorApartamento',
            orientation: 'landscape',
            pageSize: 'A4'
        },

        {
            extend: 'print',
            text: 'Imprimir',
        },
        ],
        destroy: true,
        select: true,
        processing: true,
        serverSide: false,
        pageLength: 10,
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
        ajax: ruta_expedientes_por_unidad,
        columns: [
            { data: 'id_expediente', name: 'id_expediente', visible: false },
            { data: 'unidad', name: 'unidad' },
            { data: 'edificio', name: 'edificio' },
            { data: 'nro_expediente', name: 'nro_expediente' },
            { data: 'fecha_ingreso_anv', name: 'fecha_ingreso_anv' },
            { data: 'fecha_expediente', name: 'fecha_expediente' },
            { data: 'fecha_deuda', name: 'fecha_deuda' },
            { data: 'importe_total_reclamado', name: 'importe_total_reclamado' },
            { data: 'id_estado', name: 'id_estado', visible: false },
            { data: 'estado', name: 'estado' },
            { data: 'fecha_cierre', name: 'fecha_cierre', "defaultContent": "" },
            { data: 'nro_convenio_resolucion', name: 'nro_convenio_resolucion,  "defaultContent": ""' },
            { data: 'obs', name: 'obs' },
            { "defaultContent": "<button type='button' class='form btn btn-primary btn-xs '> <span class='glyphicon glyphicon-search'>  Seleccionar  </span></button>" }
        ],
    });

    $('#tabla_expedientes').show();


    $('#tabla_expedientes tbody').on('click', 'button.form', function () {

        var data = datatable.row($(this).parents("tr")).data();
        $('#hd_id_expediente').val(data['id_expediente']);
        $('#txt_nro_exp').val(data['nro_expediente']);
        $('#txt_fecha_anv').val(data['fecha_ingreso_anv']);
        $('#txt_fecha_exp').val(data['fecha_expediente']);
        $('#txt_fecha_deuda').val(data['fecha_deuda']);
        $('#txt_importe').val(data['importe_total_reclamado']);
        $('#txt_fecha_clausura').val(data['fecha_cierre']);
        $('#txt_nro_convenio').val(data['nro_convenio_resolucion']);
        $('#txt_obs').val(data['obs']);
        $('#select_estado').val(data['id_estado'])

        // Hbilito Botones
        $('#btn_agregar').attr("disabled", true);
        $('#btn_modificar').attr("disabled", false);
        $('#btn_eliminar').attr("disabled", false);
        $('#btn_cerrar').attr("disabled", false);
        $('#btn_agregar_mov').attr("disabled", false);
    });

}
