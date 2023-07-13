$(document).ready(function() {
    // -----------------------------------------------------------
    // TOCKEN de PETICIONES
    // -----------------------------------------------------------

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // -----------------------------------------------------------
    // FIN TOCKEN de PETICIONES
    // -----------------------------------------------------------

    // -----------------------------------------------------------
    // EVENTOS
    // -----------------------------------------------------------
    $('#btn_agregar_indice').on('click', onClickBotonAgregarIndice);
    $('#btn_guardar_indice').on('click', onClickBotonGuardarIndice);
    $('#btn_mod_indice').on('click', onClickBotonModificarIndice);
    $('#btn_eliminar_indice').on('click', onClickBotonEliminarIndice);
    cargar_tabla_indices();
    limpiarCampos();

    // -----------------------------------------------------------
    // FIN EVENTOS
    // -----------------------------------------------------------
  
    function onClickBotonGuardarIndice()
    {
            var ruta = ruta_raiz + "guardar_indice";
            var mes = $('#txt_mes').val();
            var anio = $('#txt_anio').val();
            var v_indice = $('#txt_indice').val();
            var v_mensual = $('#txt_v_mensual').val();
            var v_anual = $('#txt_v_anual').val();
            var v_12m = $('#txt_v_12m').val();

            $.ajax({
                url: ruta,
                data: {
                    mes: mes,
                    anio: anio,
                    v_indice: v_indice,
                    v_mensual: v_mensual,
                    v_anual: v_anual,
                    v_12m: v_12m
                },
                type: "POST",
                dataType: "json",
                success: function(datos) {
                    if (datos.status == "ok") {
                        enviarMesanje("success", datos.mensaje,
                            "Mantenimiento de valores de Índices IPC", null, null);
                    }
                },
                error: function(respuesta) {
    
                    if (respuesta.status != "error") {
                        enviarMesanje("error", respuesta.mensaje,
                            "Mantenimiento de valores de Índices IPC", null, null);
                    }
                }
            });

        limpiarCampos();
        CierraPopup("historicoModal");
        cargar_tabla_indices();
    }

    function onClickBotonModificarIndice(){

        var ruta = ruta_raiz + "modificar_indice";
        var id_indice = $('#h_id_indice').val();
        var mes = $('#txt_mes').val();
        var anio = $('#txt_anio').val();
        var v_indice = $('#txt_indice').val();
        var v_mensual = $('#txt_v_mensual').val();
        var v_anual = $('#txt_v_anual').val();
        var v_12m = $('#txt_v_12m').val();

        $.ajax({
            url: ruta,
            data: {
                id_indice: id_indice,
                mes: mes,
                anio: anio,
                v_indice: v_indice,
                v_mensual: v_mensual,
                v_anual: v_anual,
                v_12m: v_12m
            },
            type: "POST",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "ok") {
                    enviarMesanje("success", datos.mensaje,
                        "Mantenimiento de valores de Índices IPC", null, null);
                }
                cargar_tabla_indices();
                limpiarCampos();
                CierraPopup("historicoModal");
            },
            error: function(respuesta) {

                if (respuesta.status != "error") {
                    enviarMesanje("error", respuesta.mensaje,
                        "Mantenimiento de valores de Índices IPC", null, null);
                }
                cargar_tabla_indices();
                limpiarCampos();
                CierraPopup("historicoModal");
            }
        });
       
    }

    function onClickBotonEliminarIndice(){
       
        var ruta = ruta_raiz + "eliminar_indice";
        var id_indice = $('#h_id_indice').val();

        $.ajax({
            url: ruta,
            data: {
                id_indice: id_indice
            },
            type: "POST",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "ok") {
                    enviarMesanje("success", datos.mensaje,
                        "Mantenimiento de valores de Índices IPC", null, null);
                }
                cargar_tabla_indices();
                limpiarCampos();
                CierraPopup("historicoModal");
            },
            error: function(respuesta) {

                if (respuesta.status != "error") {
                    enviarMesanje("error", respuesta.mensaje,
                        "Mantenimiento de valores de Índices IPC", null, null);
                }
                cargar_tabla_indices();
                limpiarCampos();
                CierraPopup("historicoModal");
            }
        });
       
    }

    function onClickBotonAgregarIndice(){
        limpiarCampos();
        esconderBotones(true);
    }

    function esconderBotones(mostrar){

        if(mostrar == true){
            $('#h_estado').val("alta");
            $('#btn_mod_indice').hide();
            $('#btn_eliminar_indice').hide();
            $('#btn_guardar_indice').show();
        }else{
            $('#h_estado').val("mod");
            $('#btn_mod_indice').show();
            $('#btn_eliminar_indice').show();
            $('#btn_guardar_indice').hide();
        }

    }

    function limpiarCampos() {
        $('#h_estado').val("alta");
        $('#txt_mes').val("");
        $('#txt_anio').val("");
        $('#txt_indice').val("");
        $('#txt_v_mensual').val("");
        $('#txt_v_anual').val("");
        $('#txt_v_12m').val("");
    }

    function cargar_tabla_indices() {

        var ruta_personas = ruta_raiz + 'get_indices';
        var datatable = $('#tabla_historico').DataTable({
            dom: 'Bfrtip',
            "order": [[ 2, "desc" ], [ 1, "desc" ]],
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    title: 'Histórico de Valores de Índices IPC',
                    filename: 'Lista_Historico_Valores_Indices_IPC'
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    footer: true,
                    image: logo,
                    title: 'Histórico de Valores de Índices IPC',
                    filename: 'Lista_Historico_Valores_Indices_IPC',
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
            processing: false,
            serverSide: false,
            pageLength: 10,
            language: {
                "url": ruta_raiz + "plugins/datatables/latino.json"
            },
           
            ajax:{url:ruta_personas,dataSrc:""},
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'mes', name: 'mes' },
                { data: 'anio', name: 'anio' },
                { data: 'indice', name: 'indice' },
                { data: 'valor_mensual', name: 'valor_mensual' },
                { data: 'acumulado_anio', name: 'acumulado_anio' },
                { data: 'acumulado_12_meses', name: 'acumulado_12_meses' },
                { "defaultContent": "<button type='button' class='form btn btn-info btn-xs '> <span class='glyphicon glyphicon-search'>  Seleccionar  </span></button>" }
            ],
        });

        $('#tabla_historico tbody').on('click', 'tr', function() {
            esconderBotones(false);
            var table = $('#tabla_historico').DataTable();
            var data = table.row(this).data();
            var id_indice = data['id'];
            $('#h_id_indice').val(id_indice);
            $('#h_estado').val("mod");
            $('#txt_mes').val(data['mes']);
            $('#txt_anio').val(data['anio']);
            $('#txt_indice').val(data['indice']);
            $('#txt_v_mensual').val(data['valor_mensual']);
            $('#txt_v_anual').val(data['acumulado_anio']);
            $('#txt_v_12m').val(data['acumulado_12_meses']);
            $("#historicoModal").modal("show");
        });
    
    }
    
});