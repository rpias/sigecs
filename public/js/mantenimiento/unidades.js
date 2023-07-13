$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    initForm();
});

function initForm() {
    $("#select_unidad").attr("disabled", true);

    // -----------------------------------------------------------
    // EVENTOS
    // -----------------------------------------------------------

    ocultarControles(true);
    $("#select_unidad").on("change", onSelectUnidadChange);
    $("#btn_listar_titulares").on("click", onClickBotonListarTitulares);

    $("#btn_guardar_persona").on("click", onClickBotonGuardarPersona);

    $("#btn_agregar_vehiculo").on("click", onClickBotonGuardarVehiculo);
    $("#btn_agregar_movimiento").on("click", onClickBotonAgregarMovimiento);
    $("#btn_agregar_persona").on("click", onClickBotonAgregarPersona);
    $("#btn_agregar_mov_reg").on(
        "click",
        onClickBotonGuardarMovimientoRegistral
    );
    $("#btn_guardar_titular").on("click", onClickBotonGuardarTitular);
    $("#txt_cedula_titular").on(
        "blur",
        { par: "titulares" },
        onBlurTextCedulaTraerDatos
    );
    $("#txt_cedula").on("blur", { par: "mov_reg" }, onBlurTextCedulaTraerDatos);
    $("#btn_mod_saldo_ini").on("click", onClickBotonModificarSaldoInicial);
    setHabilitar(false);

    // -----------------------------------------------------------
    // FIN EVENTOS
    // -----------------------------------------------------------
}

function setHabilitar(habilitar) {
    if (!habilitar) {
        $("#btn_agregar_titular").attr("disabled", true);
        $("#btn_mod_saldo_ini").attr("disabled", true);
        $("#btn_agregar_vehiculos").attr("disabled", true);
        $("#btn_agregar_movimiento").attr("disabled", true);
    } else {
        $("#btn_agregar_titular").attr("disabled", false);
        $("#btn_mod_saldo_ini").attr("disabled", false);
        $("#btn_agregar_vehiculos").attr("disabled", false);
        $("#btn_agregar_movimiento").attr("disabled", false);
    }
}

function onClickBotonModificarSaldoInicial() {
    var id_unidad = $("#select_unidad").val();
    var importe = $("#txt_importe").val();
    var interes = $("#txt_interes").val();
    var ruta = ruta_raiz + "guardar_saldo_inicial";

    $.ajax({
        url: ruta,
        data: {
            id_unidad: id_unidad,
            importe: importe,
            interes: interes,
        },
        type: "POST",
        dataType: "json",
        success: function (datos) {
            if (datos.status == "ok") {
                enviarMesanje(
                    "success",
                    datos.mensaje,
                    "Mantenimiento Saldo Inicial",
                    null,
                    null
                );
            }
            limpiarCampos("saldo_ini");
            cargar_saldo_inicial(datos.id_unidad);
        },
        error: function (respuesta) {
            if (respuesta.status != "error") {
                enviarMesanje(
                    "error",
                    respuesta.mensaje,
                    "Mantenimiento Saldo Inicial",
                    null,
                    null
                );
            }
            limpiarCampos("titulares");
        },
    });

    return;
}

function onBlurTextCedulaTraerDatos(formulario) {
    var ruta = ruta_raiz + "get_datos_persona";
    switch (formulario.data.par) {
        case "mov_reg":
            var cedula = $("#txt_cedula").val();
            break;
        case "titulares":
            var cedula = $("#txt_cedula_titular").val();
            break;
    }
    $.ajax({
        url: ruta,
        data: { cedula: cedula },
        type: "POST",
        dataType: "json",
        success: function (datos) {
            switch (formulario.data.par) {
                case "mov_reg":
                    if (datos.cantidad_encotrada > 0) {
                        $("#txt_primer_nombre").val(
                            datos.datos_persona[0].primer_nombre
                        );
                        $("#txt_segundo_nombre").val(
                            datos.datos_persona[0].segundo_nombre
                        );
                        $("#txt_primer_apellido").val(
                            datos.datos_persona[0].primer_apellido
                        );
                        $("#txt_segundo_apellido").val(
                            datos.datos_persona[0].segundo_apellido
                        );
                        $("#cbo_sexo").val(datos.datos_persona[0].sexo);
                        $("#txt_fecha_nac").val(
                            datos.datos_persona[0].fecha_nac
                        );

                        $("#txt_primer_nombre").prop("disabled", true);
                        $("#txt_segundo_nombre").prop("disabled", true);
                        $("#txt_primer_apellido").prop("disabled", true);
                        $("#txt_segundo_apellido").prop("disabled", true);
                        $("#cbo_sexo").prop("disabled", true);
                        $("#txt_fecha_nac").prop("disabled", true);
                    } else {
                        $("#txt_primer_nombre").val("");
                        $("#txt_segundo_nombre").val("");
                        $("#txt_primer_apellido").val("");
                        $("#txt_segundo_apellido").val("");
                        $("#cbo_sexo").val("F");

                        $("#cbo_titular").val("SI");
                        $("#cbo_figura_recibo").val("SI");
                        $("#cbo_figura_padron").val("SI");

                        $("#txt_fecha_nac").val("");
                        $("#txt_primer_nombre").prop("disabled", false);
                        $("#txt_segundo_nombre").prop("disabled", false);
                        $("#txt_primer_apellido").prop("disabled", false);
                        $("#txt_segundo_apellido").prop("disabled", false);
                        $("#cbo_sexo").prop("disabled", false);
                        $("#txt_fecha_nac").prop("disabled", false);
                    }

                    break;

                case "titulares":
                    if (datos.cantidad_encotrada > 0) {
                        $("#txt_primer_nombre_titular").val(
                            datos.datos_persona[0].primer_nombre
                        );
                        $("#txt_segundo_nombre_titular").val(
                            datos.datos_persona[0].segundo_nombre
                        );
                        $("#txt_primer_apellido_titular").val(
                            datos.datos_persona[0].primer_apellido
                        );
                        $("#txt_segundo_apellido_titular").val(
                            datos.datos_persona[0].segundo_apellido
                        );
                        $("#cbo_sexo_titular").val(datos.datos_persona[0].sexo);
                        $("#txt_fecha_nac_titular").val(
                            datos.datos_persona[0].fecha_nac
                        );

                        $("#txt_primer_nombre_titular").prop("disabled", true);
                        $("#txt_segundo_nombre_titular").prop("disabled", true);
                        $("#txt_primer_apellido_titular").prop(
                            "disabled",
                            true
                        );
                        $("#txt_segundo_apellido_titular").prop(
                            "disabled",
                            true
                        );
                        $("#cbo_sexo_titular").prop("disabled", true);
                        $("#txt_fecha_nac_titular").prop("disabled", true);
                    } else {
                        $("#txt_primer_nombre_titular").val("");
                        $("#txt_segundo_nombre_titular").val("");
                        $("#txt_primer_apellido_titular").val("");
                        $("#txt_segundo_apellido_titular").val("");
                        $("#cbo_sexo_titular").val("F");
                        $("#txt_fecha_nac_titular").val("");

                        $("#txt_primer_nombre_titular").prop("disabled", false);
                        $("#txt_segundo_nombre_titular").prop(
                            "disabled",
                            false
                        );
                        $("#txt_primer_apellido_titular").prop(
                            "disabled",
                            false
                        );
                        $("#txt_segundo_apellido_titular").prop(
                            "disabled",
                            false
                        );
                        $("#cbo_sexo_titular").prop("disabled", false);
                        $("#txt_fecha_nac_titular").prop("disabled", false);
                    }
                    break;
                default:
            }
        },
        error: function (respuesta) {
            if (respuesta.status != "error") {
                enviarMesanje(
                    "error",
                    respuesta.mensaje,
                    "Mantenimiento de " + formulario.data.par,
                    null,
                    null
                );
            }
        },
    });
}

function onSelectUnidadChange() {
    var id_unidad = $("#select_unidad").val();
    cargar_tabla_titulares(id_unidad);
    cargar_saldo_inicial(id_unidad);
    cargar_tabla_vehiculos(id_unidad);
    cargar_tabla_mov_registrales(id_unidad);
    cargarTiposVehiculos();
    cargarTiposMovimientosRegistrales();
    ocultarControles(false);
    setHabilitar(true);
    return;
}

function cargar_saldo_inicial(id_unidad) {
    var ruta_saldo_ini_por_unidad =
        ruta_raiz + "unidades/" + id_unidad + "/saldo_inicial";
    $.get(ruta_saldo_ini_por_unidad, function (data) {
        $("#txt_fecha").val(data[0].saldo_inicial_fecha); //  2021-08-31
        $("#txt_importe").val(data[0].saldo_inicial);
        $("#txt_interes").val(data[0].saldo_inicial_interes);
    });
}

function onClickBotonAgregarPersona() {
    $("#txt_fecha_nac").val(getDiaActualFechaCorta());
    $("#select_tipo_mov_reg").val("0");
}

function onClickBotonAgregarMovimiento() {
    $("#txt_fecha").val(getDiaActualFechaCorta());
    $("#select_tipo_mov_reg").val("0");
}

function limpiarCampos(formulario) {
    switch (formulario) {
        case "saldo_ini":
            $("#txt_fecha").val("");
            $("#txt_importe").val("");
            $("#txt_interes").val("");
            break;

        case "vehiculos":
            $("#txt_matricula").val("");
            $("#txt_marca").val("");
            $("#txt_modelo").val("");
            $("#txt_anio").val("");
            $("#txt_obs").val("");
            $("#select_tipo_vehiculo").val("0");
            break;

        case "mov_reg":
            $("#txt_fecha").val("");
            $("#txt_obs").val("");
            $("#select_tipo_mov_reg").val("0");
            var table = $("#tabla_personas_inv").DataTable();
            table.clear().draw();
            break;

        case "personas":
            $("#txt_cedula").val("");
            $("#txt_primer_nombre").val("");
            $("#txt_segundo_nombre").val("");
            $("#txt_primer_apellido").val("");
            $("#txt_segundo_apellido").val("");
            $("#cbo_sexo").val("F");
            $("#txt_fecha_nac").val("");
            $("#txt_persona_obs").val("");
            $("#cbo_titular").val("SI");
            $("#cbo_figura_recibo").val("SI");
            $("#cbo_figura_padron").val("SI");
            break;

        case "titulares":
            $("#txt_cedula_titular").val("");
            $("#cbo_titular").val("0");
            $("#txt_primer_nombre_titular").val("");
            $("#txt_segundo_nombre_titular").val("");
            $("#txt_primer_apellido_titular").val("");
            $("#txt_segundo_apellido_titular").val("");
            $("#cbo_sexo_titular").val("F");
            $("#txt_fecha_nac_titular").val("");
            $("#cbo_figura_recibo").val("0");
            $("#cbo_figura_padron").val("0");
            $("#txt_titular_obs").val("");
            break;

        default:
    }
}

function ocultarControles(ocultar) {
    if (ocultar == true) {
        $("#btn_agregar_vehiculos").addClass("hide");
        $("#btn_agregar_movimiento").addClass("hide");
        $("#btn_agregar_titular").addClass("hide");
        $("#accordion").addClass("hide");
    } else {
        $("#btn_agregar_vehiculos").removeClass("hide");
        $("#btn_agregar_movimiento").removeClass("hide");
        $("#btn_agregar_titular").removeClass("hide");
        $("#accordion").removeClass("hide");
    }
}

// -----------------------------------------------------------
// MANTENIMIENTO TITULARES E INTEGRANTES
// -----------------------------------------------------------

function onClickBotonGuardarTitular() {
    var ruta = ruta_raiz + "guardar_integrante";
    var id_unidad = $("#select_unidad").val();
    var cedula = $("#txt_cedula_titular").val();
    var es_titular = $("#cbo_titular").val();
    var primer_nombre = $("#txt_primer_nombre_titular").val();
    var segundo_nombre = $("#txt_segundo_nombre_titular").val();
    var primer_apellido = $("#txt_primer_apellido_titular").val();
    var segundo_apellido = $("#txt_segundo_apellido_titular").val();
    var sexo = $("#cbo_sexo_titular").val();
    var fecha_nac = $("#txt_fecha_nac_titular").val();
    var figura_recibo = $("#cbo_figura_recibo").val();
    var figura_padron = $("#cbo_figura_padron").val();
    var obs = $("#txt_titular_obs").val();

    $.ajax({
        url: ruta,
        data: {
            id_unidad: id_unidad,
            cedula: cedula,
            es_titular: es_titular,
            primer_nombre: primer_nombre,
            segundo_nombre: segundo_nombre,
            primer_apellido: primer_apellido,
            segundo_apellido: segundo_apellido,
            sexo: sexo,
            fecha_nac: fecha_nac,
            figura_recibo: figura_recibo,
            figura_padron: figura_padron,
            obs: obs,
        },
        type: "POST",
        dataType: "json",
        success: function (datos) {
            if (datos.status == "ok") {
                enviarMesanje(
                    "success",
                    datos.mensaje,
                    "Mantenimiento de Titulares",
                    null,
                    null
                );
            }
            cargar_tabla_titulares(id_unidad);
            limpiarCampos("titulares");
            CierraPopup("titularModal");
        },
        error: function (respuesta) {
            if (respuesta.status != "error") {
                enviarMesanje(
                    "error",
                    respuesta.mensaje,
                    "Mantenimiento de Titulares",
                    null,
                    null
                );
            }
            cargar_tabla_titulares(id_unidad);
            limpiarCampos("titulares");
            CierraPopup("titularModal");
        },
    });
}

function onClickBotonListarTitulares() {
    var ruta_titulares_por_unidad = ruta_raiz + "listar_titulares";
    var datatable = $("#tabla_titulares_unidad").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Titulares por Apartamento",
                filename: "ListaTitularesPorApartamento",
            },
            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Titulares por Apartamento",
                filename: "ListaTitularesPorApartamento",
                orientation: "landscape",
                pageSize: "A4",
            },
        ],
        serverSide: false,
        pageLength: 5,
        language: {
            url: ruta_raiz + "plugins/datatables/latino.json",
        },
        ajax: ruta_titulares_por_unidad,
        columns: [
            { data: "edificio", name: "edificio" },
            { data: "unidad", name: "unidad" },
            { data: "cedula", name: "cedula" },
            { data: "nombre_completo", name: "nombre_completo" },
            { data: "recibo", name: "recibo" },
            { data: "padron", name: "padron" },
        ],
    });
}

function cargar_tabla_titulares(id) {
    var ruta_titulares_por_unidad = ruta_raiz + "unidades/" + id + "/titulares";
    tabla_titulares = $("#tabla_titulares").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Mov. Registrales por Apartamento",
                filename: "ListaMovRegistralesPorApartamento",
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Mov. Registrales por Apartamento",
                filename: "ListaMovRegistralesPorApartamento",
                orientation: "landscape",
                pageSize: "A4",
            },

            {
                extend: "print",
                text: "Imprimir",
            },
        ],
        destroy: "true",
        select: "true",
        processing: "true",
        serverSide: "true",
        pageLength: "10",
        language: {
            url: ruta_raiz + "plugins/datatables/latino.json",
        },
        ajax: {
            url: ruta_titulares_por_unidad,
            type: "GET",
            dataSrc: "",
        },
        columns: [
            { data: "id", name: "id", visible: false },
            { data: "id_titular", name: "id_titular", visible: false },
            { data: "unidad", name: "unidad", visible: true },
            { data: "cedula", name: "cedula", visible: true },
            { data: "nombre_completo", name: "nombre_completo", visible: true },
            { data: "sexo", name: "sexo", visible: true },
            { data: "fecha_nac", name: "fecha_nac", visible: true },
            {
                data: "pertenece_recibo",
                name: "pertenece_recibo",
                visible: true,
            },
            { data: "pertence_padron", name: "pertence_padron", visible: true },
            {
                defaultContent:
                    "<button type='button' class='form btn btn-danger'> <span class='glyphicon glyphicon-search'>  Eliminar  </span></button>",
            },
        ],
    });

    $("#tabla_titulares tbody").on("click", "button", function () {
        var data = tabla_titulares.row($(this).parents("tr")).data();
        id_unidad_titular = data["id"];
        var ruta = ruta_raiz + "eliminar_titular";
        var id_unidad = $("#select_unidad").val();

        $.ajax({
            url: ruta,
            data: { id_unidad_titular: id_unidad_titular },
            type: "POST",
            dataType: "json",
            success: function (datos) {
                if (datos.status == "ok") {
                    enviarMesanje(
                        "success",
                        datos.mensaje,
                        "Mantenimiento de Titulares",
                        null,
                        null
                    );
                }
                cargar_tabla_titulares(id_unidad);
            },
            error: function (respuesta) {
                if (respuesta.status != "error") {
                    enviarMesanje(
                        "error",
                        respuesta.mensaje,
                        "Mantenimiento de Titulares",
                        null,
                        null
                    );
                }
                cargar_tabla_titulares(id_unidad);
            },
        });
    });
}

// -----------------------------------------------------------
// FIN MANTENIMIENTO TITULARES E INTEGRANTES
// -----------------------------------------------------------

// -----------------------------------------------------------
// MANTENIMIENTO UNIDADES - VEHIULOS
// -----------------------------------------------------------

function onClickBotonGuardarVehiculo() {
    var ruta = ruta_raiz + "guardar_vehiculo";
    var id_unidad = $("#select_unidad").val();
    var tipo = $("#select_tipo_vehiculo").val();
    var matricula = $("#txt_matricula").val();
    var marca = $("#txt_marca").val();
    var modelo = $("#txt_modelo").val();
    var anio = $("#txt_anio").val();
    var obs = $("#txt_obs_vehiculo").val();

    $.ajax({
        url: ruta,
        data: {
            id_unidad: id_unidad,
            tipo: tipo,
            matricula: matricula,
            marca: marca,
            modelo: modelo,
            anio: anio,
            obs: obs,
        },
        type: "POST",
        dataType: "json",
        success: function (datos) {
            if (datos.status == "ok") {
                enviarMesanje(
                    "success",
                    datos.mensaje,
                    "Mantenimiento de Vehículos",
                    null,
                    null
                );
            }
            cargar_tabla_vehiculos(id_unidad);
            limpiarCampos("vehiculos");
            CierraPopup("vehiculosModal");
        },
        error: function (respuesta) {
            if (respuesta.status != "error") {
                enviarMesanje(
                    "error",
                    respuesta.mensaje,
                    "Mantenimiento de Vehículos",
                    null,
                    null
                );
            }
            cargar_tabla_vehiculos(id_unidad);
            limpiarCampos("vehiculos");
            CierraPopup("vehiculosModal");
        },
    });
}

function cargarTiposVehiculos() {
    var ruta_tipos_vehiculos = ruta_raiz + "tipos_vehiculos";
    $.get(ruta_tipos_vehiculos, function (data) {
        var html_select = "";
        html_select = '<option value="0">Seleccione Tipo Vehículo</option>';
        for (var i = 0; i < data.length; ++i) {
            html_select +=
                '<option value="' +
                data[i].id_tipo_vehiculo +
                '">' +
                data[i].tipo_vehiculo +
                "</option>";
            $("#select_tipo_vehiculo").html(html_select);
        }
    });
}

function cargar_tabla_vehiculos(id) {
    var ruta_expedientes_por_unidad =
        ruta_raiz + "unidades/" + id + "/vehiculos";
    var datatable = $("#tabla_vehiculos").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Vehículos por Apartamento",
                filename: "ListaVehículosPorApartamento",
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Vehículos por Apartamento",
                filename: "ListaVehículosPorApartamento",
                orientation: "landscape",
                pageSize: "A4",
            },

            {
                extend: "print",
                text: "Imprimir",
            },
        ],
        destroy: true,
        select: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        language: {
            url: ruta_raiz + "plugins/datatables/latino.json",
        },
        ajax: ruta_expedientes_por_unidad,
        columns: [
            { data: "id_vehiculo", name: "id_vehiculo", visible: true },
            { data: "tipo_vehiculo", name: "tipo_vehiculo" },
            { data: "matricula", name: "matricula" },
            { data: "marca", name: "marca" },
            { data: "modelo", name: "modelo" },
            { data: "anio", name: "anio" },
            { data: "obs", name: "obs" },

            {
                defaultContent:
                    "<button type='button' class='form btn btn-danger'> <span class='glyphicon glyphicon-search'>  Eliminar  </span></button>",
            },
        ],
    });

    $("#tabla_vehiculos tbody").on("click", "tr", function () {
        var table = $("#tabla_vehiculos").DataTable();
        var data = table.row(this).data();
        var ruta = ruta_raiz + "eliminar_vehiculo";
        var id_vehiculo = data["id_vehiculo"];
        var id_unidad = $("#select_unidad").val();

        $.ajax({
            url: ruta,
            data: {
                id_unidad: id_unidad,
                id_vehiculo: id_vehiculo,
            },
            type: "POST",
            dataType: "json",
            success: function (datos) {
                if (datos.status == "ok") {
                    enviarMesanje(
                        "success",
                        datos.mensaje,
                        "Mantenimiento de Vehículos",
                        null,
                        null
                    );
                }
                cargar_tabla_vehiculos(id_unidad);
            },
            error: function (respuesta) {
                if (respuesta.status != "error") {
                    enviarMesanje(
                        "error",
                        respuesta.mensaje,
                        "Mantenimiento de Vehículos",
                        null,
                        null
                    );
                }
                cargar_tabla_vehiculos(id_unidad);
            },
        });
    });
}

// -----------------------------------------------------------
// FIN MANTENIMIENTO UNIDADES - VEHIULOS
// -----------------------------------------------------------

// -----------------------------------------------------------
// MOVIMIENTOS REGISTRALES
// -----------------------------------------------------------

function cargarTiposMovimientosRegistrales() {
    var ruta_tipos_vehiculos = ruta_raiz + "tipos_mov_reg";
    $.get(ruta_tipos_vehiculos, function (data) {
        var html_select = "";
        html_select =
            '<option value="0">Seleccione Tipo Movimiento Registral</option>';
        for (var i = 0; i < data.length; ++i) {
            html_select +=
                '<option value="' +
                data[i].id_tipo_mov_registral +
                '">' +
                data[i].tipo_mov_registral +
                "</option>";
            $("#select_tipo_mov_reg").html(html_select);
        }
    });
}

function cargar_tabla_mov_registrales(id) {
    var ruta_expedientes_por_unidad = ruta_raiz + "unidades/" + id + "/mov_reg";
    var datatable = $("#tabla_movimientos").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Mov. Registrales por Apartamento",
                filename: "ListaMovRegistralesPorApartamento",
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Mov. Registrales por Apartamento",
                filename: "ListaMovRegistralesPorApartamento",
                orientation: "landscape",
                pageSize: "A4",
            },

            {
                extend: "print",
                text: "Imprimir",
            },
        ],
        destroy: true,
        select: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        language: {
            url: ruta_raiz + "plugins/datatables/latino.json",
        },
        ajax: ruta_expedientes_por_unidad,
        columns: [
            {
                data: "id_mov_registral",
                name: "id_mov_registral",
                visible: true,
            },
            { data: "tipo_mov_registral", name: "tipo_mov_registral" },
            { data: "fecha", name: "fecha" },
            { data: "obs", name: "obs" },

            {
                defaultContent:
                    "<button type='button' class='form btn btn-danger'> <span class='glyphicon glyphicon-search'>  Eliminar  </span></button>",
            },
        ],
    });

    $("#tabla_movimientos tbody").on("click", "tr", function () {
        var table = $("#tabla_movimientos").DataTable();
        var data = table.row(this).data();
        var ruta = ruta_raiz + "eliminar_mov_registral";
        var id_mov_registral = data["id_mov_registral"];
        var id_unidad = $("#select_unidad").val();

        $.ajax({
            url: ruta,
            data: {
                id_unidad: id_unidad,
                id_mov_registral: id_mov_registral,
            },
            type: "POST",
            dataType: "json",
            success: function (datos) {
                if (datos.status == "ok") {
                    enviarMesanje(
                        "success",
                        datos.mensaje,
                        "Mantenimiento de Mov.Registrales",
                        null,
                        null
                    );
                }
                cargar_tabla_mov_registrales(id_unidad);
            },
            error: function (respuesta) {
                if (respuesta.status == "error") {
                    enviarMesanje(
                        "error",
                        respuesta.mensaje,
                        "Mantenimiento de Mov.Registrales",
                        null,
                        null
                    );
                }
                cargar_tabla_mov_registrales(id_unidad);
            },
        });
    });
}

function onClickBotonGuardarMovimientoRegistral() {
    // Guardo Datos Personas Involucradas
    var rows = $("#tabla_personas_inv").dataTable().fnGetData();
    var tabla_pi = $("#tabla_personas_inv").DataTable();
    if (!tabla_pi.data().any()) {
        enviarMesanje(
            "warning",
            "Debe agregar al menos una Persona pra continuar",
            "Movimientos Registrales",
            null,
            null
        );
    } else {
        // Guardar Datos Movimiento Registral
        var ruta = ruta_raiz + "guardar_mov_reg";
        var id_tipo_mov_registral = $("#select_tipo_mov_reg").val();
        var fecha_mov_registral = $("#txt_fecha").val();
        var id_unidad = $("#select_unidad").val();
        var obs = $("#txt_obs").val();

        if (id_tipo_mov_registral > 0) {
            $.ajax({
                url: ruta,
                data: {
                    id_unidad: id_unidad,
                    id_tipo_mov_registral: id_tipo_mov_registral,
                    fecha_mov_registral: fecha_mov_registral,
                    obs: obs,
                },
                type: "POST",
                dataType: "json",
                success: function (datos) {
                    if (datos.status == "ok") {
                        // Recorro la tabla y Guardo las personas
                        $(rows).each(function () {
                            var id_movimiento_reg = datos.id_mov_reg_ingresado;
                            var ruta = ruta_raiz + "guardar_persona_mov_reg";
                            var cedula = $(this)[0];
                            var primer_nombre = $(this)[1];
                            var segundo_nombre = $(this)[2];
                            var primer_apellido = $(this)[3];
                            var segundo_apellido = $(this)[4];
                            var sexo = $(this)[5];
                            var fecha_nac = $(this)[6];
                            var obs = $(this)[7];

                            $.ajax({
                                url: ruta,
                                data: {
                                    id_movimiento_reg: id_movimiento_reg,
                                    cedula: cedula,
                                    primer_nombre: primer_nombre,
                                    segundo_nombre: segundo_nombre,
                                    primer_apellido: primer_apellido,
                                    segundo_apellido: segundo_apellido,
                                    sexo: sexo,
                                    fecha_nac: fecha_nac,
                                    obs: obs,
                                },
                                type: "POST",
                                dataType: "json",
                                success: function (respuesta) {
                                    if (respuesta.status == "ok") {
                                        enviarMesanje(
                                            "success",
                                            datos.mensaje,
                                            "Mantenimiento de Mov.Registrales",
                                            null,
                                            null
                                        );
                                    }
                                },
                                error: function (respuesta) {
                                    if (respuesta.status == "error") {
                                        enviarMesanje(
                                            "error",
                                            respuesta.mensaje,
                                            "Mantenimiento de Mov.Registrales",
                                            null,
                                            null
                                        );
                                    }
                                },
                            }); // Fin AJAX
                        }); // Fin ForEach

                        limpiarCampos("mov_reg");
                        CierraPopup("movimientosModal");
                    }
                    cargar_tabla_mov_registrales(id_unidad);
                },
                error: function (respuesta) {
                    if (respuesta.status != "error") {
                        enviarMesanje(
                            "error",
                            respuesta.mensaje,
                            "Mantenimiento de Mov.Registrales",
                            null,
                            null
                        );
                        limpiarCampos("mov_reg");
                        CierraPopup("movimientosModal");
                    }
                    cargar_tabla_mov_registrales(id_unidad);
                },
            });
        } else {
            enviarMesanje(
                "warning",
                "Debe seleccionar un Tipo de Movimiento Registral",
                "Mantenimiento de Mov.Registrales",
                null,
                null
            );
        }
    }
}

// -----------------------------------------------------------
// FIN MOVIMIENTOS REGISTRALES
// -----------------------------------------------------------

// -----------------------------------------------------------
// INICIAR TABLA PERSONAS A LA TABLA
// -----------------------------------------------------------

function inicializarTablaPersonas() {
    var table = $("#tabla_personas_inv").DataTable({
        language: {
            url: ruta_raiz + "plugins/datatables/latino.json",
        },
        lengthChange: false,
        paging: false,
        ordering: true,
        info: false,
        searching: false,
        columns: [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            {
                sortable: false,
            },
        ],
    });
}

// -----------------------------------------------------------
// FIN - INICIAR TABLA PERSONAS A LA TABLA
// -----------------------------------------------------------

function onClickBotonGuardarPersona() {
    var tabla_personas_mr = $("#tabla_personas_inv").DataTable();
    var cedula = $("#txt_cedula").val();
    var primer_nombre = $("#txt_primer_nombre").val();
    var segundo_nombre = $("#txt_segundo_nombre").val();
    var primer_apellido = $("#txt_primer_apellido").val();
    var segundo_apellido = $("#txt_segundo_apellido").val();
    var sexo = $("#cbo_sexo").val();
    var fecha_nac = $("#txt_fecha_nac").val();
    var obs = $("#txt_persona_obs").val();

    if (cedula != "" && primer_nombre != "" && primer_apellido != "") {
        tabla_personas_mr.row
            .add([
                cedula,
                primer_nombre,
                segundo_nombre,
                primer_apellido,
                segundo_apellido,
                sexo,
                fecha_nac,
                obs,
                "<button type='button' class='form btn btn-danger'> <span class='glyphicon glyphicon-search'>  Eliminar  </span></button>",
            ])
            .draw(false);

        limpiarCampos("personas");
        CierraPopup("personasModal");

        enviarMesanje(
            "info",
            "Persona Agregada con Éxito",
            "Mantenimiento de Personas",
            null,
            null
        );
    } else {
        enviarMesanje(
            "warning",
            "Debe llenar los campos requeridos!",
            "Mantenimiento de Personas",
            null,
            null
        );
    }

    // -----------------------------------------------------------
    // ELIMINAR PERSONAS
    // -----------------------------------------------------------

    $("#tabla_personas_inv tbody").on("click", "button.form", function () {
        tabla_personas_mr.row($(this).parents("tr")).remove().draw(false);
    });

    // -----------------------------------------------------------
    // FIN AGREGAR PERSONAS
    // -----------------------------------------------------------
}

$(".modal").on("shown.bs.modal", function () {
    $("body").addClass("modal-open"); // Se utiliza para mantener Modal sobre Modal
});

// -----------------------------------------------------------
// FIN AGREGAR PERSONAS
// -----------------------------------------------------------