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
    $('#btn_agregar_persona').on('click', onClickBotonAgregarPersona);
    $('#btn_guardar_persona').on('click', onClickBotonGuardarPersona);
    $('#btn_mod_persona').on('click', onClickBotonModificarPersona);
    $('#btn_eliminar_persona').on('click', onClickBotonEliminarPersona);
    cargar_tabla_personas();
    limpiarCampos();

    // -----------------------------------------------------------
    // FIN EVENTOS
    // -----------------------------------------------------------
    function existePersona() {
        var ruta = ruta_raiz + "get_datos_persona";
        var cedula = $('#txt_cedula').val();
        $.ajax({
            url: ruta,
            data: { cedula: cedula },
            type: "POST",
            dataType: "json",
            success: function(datos) {
                if (datos.cantidad_encotrada > 0) {
                    $('#h_id_persona').val("encontrado");
                }else{
                    $('#h_id_persona').val("");
                }
            },
            error: function(respuesta) {
                if (respuesta.status != "error") {
                    enviarMesanje("error", respuesta.mensaje,
                        "Mantenimiento de " + formulario.data.par, null, null);
                        return true;
                }
            }
        });
    }



    // 26 de Mayo 19:00hs, simulacro y consulta de P3
    // 27 de Mayo Examen 19:00hs








    function onClickBotonGuardarPersona()
    {
            var ruta = ruta_raiz + "guardar_persona";
            var cedula = $('#txt_cedula').val();
            var primer_nombre = $('#txt_primer_nombre').val();
            var segundo_nombre = $('#txt_segundo_nombre').val();
            var primer_apellido = $('#txt_primer_apellido').val();
            var segundo_apellido = $('#txt_segundo_apellido').val();
            var sexo = $('#cbo_sexo').val();
            var fecha_nac = $('#txt_fecha_nac').val();
            var obs = $('#txt_persona_obs').val(); //txt_persona_obs
            $.ajax({
                url: ruta,
                data: {
                    cedula: cedula,
                    primer_nombre: primer_nombre,
                    segundo_nombre: segundo_nombre,
                    primer_apellido: primer_apellido,
                    segundo_apellido: segundo_apellido,
                    sexo: sexo,
                    fecha_nac: fecha_nac,
                    obs: obs
                },
                type: "POST",
                dataType: "json",
                success: function(datos) {
                    if (datos.status == "ok") {
                        enviarMesanje("success", datos.mensaje,
                            "Mantenimiento de Personas", null, null);
                    }
                },
                error: function(respuesta) {
    
                    if (respuesta.status != "error") {
                        enviarMesanje("error", respuesta.mensaje,
                            "Mantenimiento de Personas", null, null);
                    }
                }
            });

        limpiarCampos();
        CierraPopup("personasModal");
        cargar_tabla_personas();
    }

    function onClickBotonModificarPersona(){

        var ruta = ruta_raiz + "modificar_persona";
        var id_persona = $('#h_id_persona').val();
        var cedula = $('#txt_cedula').val();
        var primer_nombre = $('#txt_primer_nombre').val();
        var segundo_nombre = $('#txt_segundo_nombre').val();
        var primer_apellido = $('#txt_primer_apellido').val();
        var segundo_apellido = $('#txt_segundo_apellido').val();
        var sexo = $('#cbo_sexo').val();
        var fecha_nac = $('#txt_fecha_nac').val();
        var obs = $('#txt_obs').val();

        $.ajax({
            url: ruta,
            data: {
                id_persona: id_persona,
                cedula: cedula,
                primer_nombre: primer_nombre,
                segundo_nombre: segundo_nombre,
                primer_apellido: primer_apellido,
                segundo_apellido: segundo_apellido,
                sexo: sexo,
                fecha_nac: fecha_nac,
                obs: obs
            },
            type: "POST",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "ok") {
                    enviarMesanje("success", datos.mensaje,
                        "Mantenimiento de Personas", null, null);
                }
                cargar_tabla_personas();
                limpiarCampos();
                CierraPopup("personasModal");
            },
            error: function(respuesta) {

                if (respuesta.status != "error") {
                    enviarMesanje("error", respuesta.mensaje,
                        "Mantenimiento de Personas", null, null);
                }
                cargar_tabla_personas();
                limpiarCampos();
                CierraPopup("personasModal");
            }
        });
       
    }

    function onClickBotonEliminarPersona(){
       
        var ruta = ruta_raiz + "eliminar_persona";
        var id_persona = $('#h_id_persona').val();

        $.ajax({
            url: ruta,
            data: {
                id_persona: id_persona
            },
            type: "POST",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "ok") {
                    enviarMesanje("success", datos.mensaje,
                        "Mantenimiento de Personas", null, null);
                }
                cargar_tabla_personas();
                limpiarCampos();
                CierraPopup("personasModal");
            },
            error: function(respuesta) {

                if (respuesta.status != "error") {
                    enviarMesanje("error", respuesta.mensaje,
                        "Mantenimiento de Personas", null, null);
                }
                cargar_tabla_personas();
                limpiarCampos();
                CierraPopup("personasModal");
            }
        });
       
    }

    function onClickBotonAgregarPersona(){
        esconderBotones(true);
    }

    function esconderBotones(mostrar){

        if(mostrar == true){
            $('#h_estado').val("alta");
            $('#btn_mod_persona').hide();
            $('#btn_eliminar_persona').hide();
            $('#btn_guardar_persona').show();
        }else{
            $('#h_estado').val("mod");
            $('#btn_mod_persona').show();
            $('#btn_eliminar_persona').show();
            $('#btn_guardar_persona').hide();
        }

    }

    function limpiarCampos() {
        $('#h_estado').val("alta");
        $('#txt_cedula').val("");
        $('#txt_primer_nombre').val("");
        $('#txt_segundo_nombre').val("");
        $('#txt_primer_apellido').val("");
        $('#txt_segundo_apellido').val("");
        $('#cbo_sexo').val("F");
        $('#txt_fecha_nac').val("");
        $('#txt_persona_obs').val("");
    }

    function cargar_tabla_personas() {

        var ruta_personas = ruta_raiz + 'get_personas';
        var datatable = $('#tabla_personas').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excel',
                    text: 'Excel',
                    footer: true,
                    title: 'Lista de Personas',
                    filename: 'ListaPersonas'
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    footer: true,
                    image: logo,
                    title: 'Lista de Personas',
                    filename: 'ListaPersonas',
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
                { data: 'id_persona', name: 'id_persona', visible: false },
                { data: 'cedula', name: 'cedula' },
                { data: 'primer_nombre', name: 'primer_nombre' },
                { data: 'segundo_nombre', name: 'segundo_nombre' },
                { data: 'primer_apellido', name: 'primer_apellido' },
                { data: 'segundo_apellido', name: 'segundo_apellido' },
                { data: 'sexo', name: 'sexo' },
                { data: 'fecha_nac', name: 'fecha_nac' },
                { data: 'obs', name: 'obs' },
                { "defaultContent": "<button type='button' class='form btn btn-info btn-xs '> <span class='glyphicon glyphicon-search'>  Seleccionar  </span></button>" }
            ],
        });

        $('#tabla_personas tbody').on('click', 'tr', function() {
            esconderBotones(false);
            var table = $('#tabla_personas').DataTable();
            var data = table.row(this).data();
            var id_persona = data['id_persona'];
            $('#h_id_persona').val(id_persona);
            $('#h_estado').val("mod");
            $('#txt_cedula').val(data['cedula']);
            $('#txt_primer_nombre').val(data['primer_nombre']);
            $('#txt_segundo_nombre').val(data['segundo_nombre']);
            $('#txt_primer_apellido').val(data['primer_apellido']);
            $('#txt_segundo_apellido').val(data['segundo_apellido']);
            $('#cbo_sexo').val(data['sexo']);
            $('#txt_fecha_nac').val(data['fecha_nac']);
            $('#txt_obs').val(data['obs']);
            $("#personasModal").modal("show");
        });
    
    }
    
});