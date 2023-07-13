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

    $('#btn_buscar_registros').on('click', onClickBotonListarRegistro);
    $('#btn_buscar_historia').on('click', onClickBotonListarHistoria);

    // -----------------------------------------------------------
    // FIN EVENTOS
    // -----------------------------------------------------------
    function onClickBotonListarHistoria() {


        var table = $('#tabla_registros').DataTable();
            table.clear().draw();

        var ruta = ruta_raiz + "get_historia_recibo";
        var nro_recibo = $('#txt_nro_recibo').val();

        $('#tabla_registros').DataTable({
            dom: 'Bfrtip',
            retrieve: true,
            serverSide: false,
            pageLength: 10,
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    title: 'Registro de Sucesos - Historia de Recibo',
                    filename: 'Registro_de_Sucesos_Historia_de_Recibo'
                },
            ],
            language: {
                "url": ruta_raiz + "plugins/datatables/latino.json"
            },
            ajax: {
                url: ruta,
                type: "POST",
                data: {
                    nro_recibo: nro_recibo
                }
              },
            dataType: "json",
            columns: [

                { data: 'id_registro_sucesos', name: 'id_registro_sucesos' },
                { data: 'usuario', name: 'usuario' },
                { data: 'SP', name: 'SP' },
                { data: 'parametros', name: 'parametros' },
                { data: 'IP', name: 'IP' },
                { data: 'creado', name: 'creado' }

                
            ],
        });

       
     
    }

    function onClickBotonListarRegistro() {

        var table = $('#tabla_registros').DataTable();
            table.clear().draw();

        var ruta = ruta_raiz + "get_registros";
        var fecha_ini = $('#txt_fecha_ini').val();
        var fecha_fin = $('#txt_fecha_fin').val();
        var tipo = $('#select_tipo').val();

        if(tipo != "0")
            tipo = $("#select_tipo :selected").text();
        
        $('#tabla_registros').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    title: 'Registro de Sucesos',
                    filename: 'Registro de Sucesos'
                },
            ],
            destroy: true,
            select: true,
            processing: true,
            serverSide: false,
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            pageLength: 10,
            language: {
                "url": ruta_raiz + "plugins/datatables/latino.json"
            },
            ajax: {
                url: ruta,
                type: "POST",
                data: {
                    fecha_ini: fecha_ini,
                    fecha_fin: fecha_fin,
                    tipo: tipo
                }
              },
            dataType: "json",
            columns: [

                { data: 'id_registro_sucesos', name: 'id_registro_sucesos' },
                { data: 'usuario', name: 'usuario' },
                { data: 'SP', name: 'SP' },
                { data: 'parametros', name: 'parametros' },
                { data: 'IP', name: 'IP' },
                { data: 'creado', name: 'creado' }

                // { data: 'creado', name: 'creado', visible: true },
                // { data: 'id_recibo', name: 'id_recibo', visible: false },
                // { data: 'serie_recibo', name: 'serie_recibo', visible: false },
                // { data: 'nro_recibo', name: 'nro_recibo' },
                // { data: 'fecha', name: 'fecha' },
                // { data: 'edificio', name: 'edificio' },
                // { data: 'unidad', name: 'unidad' },
                // { data: 'id_concepto', name: 'id_concepto', visible: false },
                // { data: 'concepto', name: 'concepto' },
                // { data: 'id_fpago', name: 'id_fpago', visible: false },
                // { data: 'fpago', name: 'fpago' },
                // { data: 'importe', name: 'importe' },
                // { data: 'mes', name: 'mes' },
                // { data: 'anio', name: 'anio' },
                // { data: 'titular', name: 'titular' },
                // { data: 'obs', name: 'obs' }
            ],
        });

       
    }



    function cargar_tabla_registros() {

        var ruta_titulares_por_unidad = ruta_raiz + 'unidades/' + id + '/titulares';
       $('#tabla_titulares tbody').on('click', 'tr', function() {
            var table = $('#tabla_titulares').DataTable();
            var data = table.row(this).data();
            var ruta = ruta_raiz + "eliminar_titular";
            var id_unidad_titular = data['id'];
            var id_unidad = $('#select_unidad').val();

            $.ajax({
                url: ruta,
                data: { id_unidad_titular: id_unidad_titular },
                type: "POST",
                dataType: "json",
                success: function(datos) {
                    if (datos.status == "ok") {
                        enviarMesanje("success", datos.mensaje,
                            "Mantenimiento de Titulares", null, null);
                    }
                    cargar_tabla_titulares(id_unidad);
                },
                error: function(respuesta) {
                    if (respuesta.status != "error") {
                        enviarMesanje("error", respuesta.mensaje,
                            "Mantenimiento de Titulares", null, null);
                    }
                    cargar_tabla_titulares(id_unidad);
                }
            });
        });

    }



});