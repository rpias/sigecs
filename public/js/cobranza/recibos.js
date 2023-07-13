$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    initForm();
});

function initForm() {
    let mes_hoy = hoy.getMonth() + 1;
    let anio_hoy = hoy.getFullYear();

    // ==================================================
    // Eventos
    // ==================================================

    $("#select_unidad").on("change", onSelectUnidadChange);
    $("#select_anio").on("change", onSelectMesAnioChange);
    $("#txt_mes_cuota").on("change", onSelectMesAnioChange);
    $(".close").on("click", onClickCloseRedireccionar);
    $("#select_serie").on("change", onSelectSerieChange);
    $("#select_concepto").on("change", onSelectConceptoChange);
    $("#btn_agregar").on("click", onClickBtnGestionarRecibos);
    $("#btn_modificar").on("click", onClickBtnGestionarRecibos);

    // ==================================================
    // ==================================================

    $("#btn_agregar").attr("disabled", true);
    $("#btn_modificar").attr("disabled", true);
    $("#btn_imp_recibo").attr("disabled", true);
    $("#btn_ver_recibos").hide();
    $("#mensaje_interes").hide();
    $("select_edificio").val(0);
    $("#select_unidad").val(0);
    $("#tabla-recibos").hide();
    $("#select_anio").val(anio_hoy);
    $("#txt_mes_cuota").val(mes_hoy);
    $("#tabla-recibos_wrapper").hide();

    setHabilitar(false);
    onSelectSerieChange();
    onSelectEdificioChange();
}

function setHabilitar(habilitar) {
    if (!habilitar) {
        $("#btn_imp_recibo").attr("disabled", true);
        $("#hd_id_recibo").attr("disabled", true);
        $("#txt_nro_recibo").attr("disabled", true);
        $("#txt_fecha").attr("disabled", true);
        $("#txt_importe").attr("disabled", true);
        $("#txt_interes").attr("disabled", true);
        $("#txt_total").attr("disabled", true);
        $("#txt_mes_cuota").attr("disabled", true);
        $("#select_anio").attr("disabled", true);
        $("#select_concepto").attr("disabled", true);
        $("#select_forma_pago").attr("disabled", true);
        $("#txt_titular").attr("disabled", true);
        $("#txt_obs").attr("disabled", true);
        $("#select_serie").attr("disabled", true);
        $("#select_unidad").attr("disabled", true);
        $("#txt_recibo_emergencia").attr("disabled", true);
    } else {
        $("#btn_imp_recibo").attr("disabled", false);
        $("#hd_id_recibo").attr("disabled", false);
        $("#txt_nro_recibo").attr("disabled", false);
        serie = $("#select_serie").val();
        if (serie == "B") {
            $("#txt_nro_recibo").attr("disabled", true);
        } else {
            $("#txt_nro_recibo").attr("disabled", false);
        }
        $("#txt_total").attr("disabled", false);
        $("#txt_mes_cuota").attr("disabled", false);
        $("#select_anio").attr("disabled", false);
        $("#select_concepto").attr("disabled", false);
        $("#select_forma_pago").attr("disabled", false);
        $("#txt_titular").attr("disabled", false);
        $("#txt_obs").attr("disabled", false);
        $("#select_serie").attr("disabled", false);
        $("#select_unidad").attr("disabled", false);
        $("#txt_recibo_emergencia").attr("disabled", false);
    }
}

function onClickBtnGestionarRecibos(e) {
    // evita que se envie el formulario antes de ser validado
    e.preventDefault();
    var mes = $("#txt_mes_cuota").val();
    var anio = $("#select_anio").val();
    var importe = $("#txt_total").val();
    var metodo_pago = $("#select_forma_pago").val();
    var concepto = $("#select_concepto").val();

    if (mes > 0) {
        if (anio > 2015) {
            if (metodo_pago > 0) {
                if (importe > 0) {
                    if (concepto > 0) {
                        GestionarRecibo();
                    } else {
                        enviarMesanje(
                            "error",
                            mensajes.recibos_concepto,
                            funcionalidades.recibos_ingreso,
                            null,
                            null
                        );
                    }
                } else {
                    enviarMesanje(
                        "error",
                        mensajes.recibos_importe,
                        funcionalidades.recibos_ingreso,
                        null,
                        null
                    );
                }
            } else {
                enviarMesanje(
                    "error",
                    mensajes.recibos_metodo_pago_invalido,
                    funcionalidades.recibos_ingreso,
                    null,
                    null
                );
            }
        } else {
            enviarMesanje(
                "error",
                mensajes.recibos_anio_invalido,
                funcionalidades.recibos_ingreso,
                null,
                null
            );
        }
    } else {
        enviarMesanje(
            "error",
            mensajes.recibos_mes_invalido,
            funcionalidades.recibos_ingreso,
            null,
            null
        );
    }
}

function GestionarRecibo() {
    let ruta = ruta_raiz + "guardar_recibo";
    var form_element = document.getElementById("frm_recibo");
    var form_data = new FormData();

    for (var i = 0; i < form_element.length; i++) {
        form_data.append(form_element[i].name, form_element[i].value);
    }
    var datos = JSON.stringify(Object.fromEntries(form_data));

    $.ajax({
        url: ruta,
        method: "POST",
        data: JSON.parse(datos),
        success: function (data) {

            if (data.id_recibo) {
                enviarMesanje(
                    "success",
                    data.mensaje,
                    funcionalidades.recibos_ingreso,
                    null,
                    null
                );
                myWindow = window
                    .open("pdf_recibo?idRecibo=" + data.id_recibo, "Pagos")
                    .focus();

            } else {
                enviarMesanje(
                    "success",
                    data,
                    funcionalidades.recibos_ingreso,
                    null,
                    null
                );
            }

            onClickCloseRedireccionar();
        },
        error: function (error) {
            enviarMesanje(
                "error",
                error,
                funcionalidades.recibos_ingreso,
                null,
                null
            );
        },
    });
}

function IsUnidadSeleccionada() {
    var unidad = $("#select_unidad").val();
    if (unidad != 0) return true;
    else return true;
}

function onSelectConceptoChange() {
    onSelectMesAnioChange();
    if (!IsUnidadSeleccionada()) {
        $("#select_concepto").attr("disabled", true);
        enviarMesanje(
            "error",
            MENSAJE_UNIDAD_NO_SELECCIONADA,
            FUNCIONALIDAD_MANT_RECIBOS,
            null,
            null
        );
    }
}

function onSelectSerieChange() {
    
    var recibo_cargado = $("#hd_id_recibo").val();

    if (IsUnidadSeleccionada() && !recibo_cargado) {
        // trer numero del ultimo recibo de la serie B + 1
        var serie = $("#select_serie").val();
        if (serie == "B") {
            $("#txt_nro_recibo").attr("disabled", true);
            $("#txt_fecha").attr("disabled", true);
        }else {
            $("#txt_nro_recibo").attr("disabled", false);
            $("#txt_fecha").attr("disabled", false);
        }
            

        var numero_recibo_serie_b_ajax =
            ruta_raiz + "obtener_nro_recibo/" + serie + "/serie";
        $.get(numero_recibo_serie_b_ajax, function (data) {
            var valor = data[0].numero;
            $("#txt_nro_recibo").val(valor);
        });

    } else {
        enviarMesanje(
            "error",
            MENSAJE_UNIDAD_NO_SELECCIONADA + " O SE ESTA MODIFICANDO UN RECIBO" ,
            FUNCIONALIDAD_MANT_RECIBOS,
            null,
            null
        );
    }
}

function onSelectUnidadChange() {
    id_unidad = $("#select_unidad").val();
    traer_importe(id_unidad);
    traer_nombre_titular(id_unidad);
    activar_tabla_facturas(id_unidad);

    setHabilitar(true);

    $("#btn_agregar").attr("disabled", false);
    $("#btn_modificar").attr("disabled", true);

    $("#tabla-recibos").css("width", "100%");
    $("#tabla-recibos_wrapper").css("width", "100%");

    return;
}

function onSelectMesAnioChange() {
    concepto = $("#select_concepto").val();
    var id_unidad = $("#select_unidad").val();
    var anio = $("#select_anio").val();
    var mes = $("#txt_mes_cuota").val();

    if (concepto == 1) {
        var mes_act;
        if (anio == "") {
            anio = hoy.getFullYear();
        }

        if (mes < 10) {
            mes_act = "0" + mes;
        } else {
            mes_act = mes;
        }

        var fecha_ini = "01/" + mes_act + "/" + anio;

        var dia = hoy.getDate();
        var mes_f = hoy.getMonth() + 1;
        var anio_f = hoy.getFullYear();
        if (mes_f < 10) {
            mes_f = "0" + mes_f;
        }
        if (dia < 10) {
            dia = "0" + dia;
        }
        var fecha_fin = dia + "/" + mes_f + "/" + anio_f;

        var cant_dias = getDiasEntreDosFechas(fecha_ini, fecha_fin);

        if (cant_dias > 31) {
            traer_importe_mes_anio(id_unidad, mes, anio);
        } else {
            traer_importe(id_unidad);
        }

    } else if (concepto == 2) {

        $("#mensaje_interes").text("");
        $("#mensaje_interes").hide();
        $("#txt_importe").val(0);
        $("#txt_total").val(0);
        $("#txt_interes").val(0);
        
    } else if (concepto == 3) {


    } else {

    
        traer_importe(id_unidad);
        $("#mensaje_interes").text("");
        $("#mensaje_interes").hide();
    }

    return;
}

function traer_nombre_titular(id_unidad) {
    var nombre_titular_por_unidad_ajax =
        ruta_raiz +
        "nombre_titular_por_unidad/" +
        id_unidad +
        "/nombre_titular";
    $.get(nombre_titular_por_unidad_ajax, function (data) {
        var valor = data[0].nombre;
        $("#txt_titular").val(valor);
    });
}

function traer_importe(id_unidad) {
    var ruta_precio_gc_por_unidad_ajax =
        ruta_raiz + "precio_gc_por_unidad/" + id_unidad + "/importe";
    $.get(ruta_precio_gc_por_unidad_ajax, function (data) {
        var valor = data[0].valor;
        $("#txt_importe").val(valor);
        $("#txt_total").val(valor);
        $("#txt_interes").val(0);
    });
}

function traer_importe_mes_anio(id_unidad, mes, anio) {
    //console.log(id_unidad + " " + mes + " " + anio);

    var ruta_precio_gc_por_unidad_ajax =
        ruta_raiz +
        "precio_gc_por_unidad_fecha/" +
        id_unidad +
        "/" +
        mes +
        "/" +
        anio +
        "/importe_fecha";

    $.get(ruta_precio_gc_por_unidad_ajax, function (data) {
        //console.log(data);
        var texto = "";
        $("#mensaje_interes").text(texto);
        porcentaje = parseFloat(data.valor_porcentaje);
        gc_ipc = parseFloat(data.gc_ipc);
        g_c = parseFloat(data.valor_gc_mes_recibo);
        texto += "     Valor Gasto Común: <b>" + g_c + "</b>";
        texto +=
            "<br />    Fecha a partir de la cual se calculan los intereses: <b>" +
            data.fecha_para_calculo_ipc +
            "</b>";
        texto +=
            "<br />    Mes para calculo IPC: <b>" +
            data.mes_para_calculo_ipc +
            "</b>";
        texto +=
            "<br />    Año para calculo IPC: <b>" +
            data.anio_para_calculo_ipc +
            "</b>";

        texto +=
            "<br />    Valor IPC Fecha Recibo: <b>" +
            data.valor_ipc_del_recibo +
            "</b>";
        texto +=
            "<br />    Valor IPC Actual: <b>" + data.valor_ipc_actual + "</b>";
        texto +=
            "<br />    Valor IPC Promedio: <b>" +
            data.valor_ipc_promedio +
            "</b>";

        texto += "<br />    Importe sobre Gactos Común: <b>" + gc_ipc + "</b>";

        texto += "<br />    Importe Porcentaje 1%: <b>" + porcentaje + "</b>";

        texto +=
            "<br />     Intereses cobrados sobre el Gasto Común:  <b>" +
            (gc_ipc + porcentaje).toFixed(2) +
            "</b>";
        texto +=
            "<br />     Total a cobrar:  <b>" +
            Math.round(g_c + gc_ipc + porcentaje) +
            "</b>";
        texto += "<br />";

        if (!g_c) {
            $("#mensaje_interes").hide();
            $("#mensaje_interes").text("");
            traer_importe(id_unidad);
        } else {
            $("#txt_importe").val(g_c);
            $("#txt_interes").val((gc_ipc + porcentaje).toFixed(2));
            $("#txt_total").val(Math.round(g_c + gc_ipc + porcentaje));
            $("#mensaje_interes").show();
            $("#mensaje_interes").append(texto);
        }
    }).fail(function () {
        traer_importe(id_unidad);
    });
}

function onClickCloseRedireccionar() {
    var ruta = ruta_raiz + "ing_recibos";
    window.location.href = ruta;
}

function activar_tabla_facturas(id) {
    var ruta_recibos_por_dptos = ruta_raiz + "unidades/" + id + "/recibos";
    var idioma = ruta_raiz + "/plugins/datatables/latino.json";
    var datatable = $("#tabla-recibos").DataTable({
        dom: "Bfrtip",
        order: [
            [3, "desc"],
            [2, "desc"],
        ], // Ordena la tabla por la columna indicada comenzando de cero.
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Pagos por Apartamento",
                filename: "ListaPagosPorApartamento",
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Pagos por Apartamento",
                filename: "ListaPagosPorApartamento",
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
            "url": ruta_raiz + "plugins/datatables/latino.json",
        },
        ajax: ruta_recibos_por_dptos,
        columns: [
            { data: "id_recibo", name: "id_recibo", visible: true },
            { data: "serie_recibo", name: "serie_recibo", visible: true },
            { data: "nro_recibo", name: "nro_recibo", visible: true },
            { data: "fecha", name: "fecha", visible: true },
            { data: "edificio", name: "edificio", visible: true },
            { data: "unidad", name: "unidad", visible: true },
            { data: "id_concepto", name: "id_concepto", visible: false },
            { data: "concepto", name: "concepto", visible: true },
            { data: "id_fpago", name: "id_fpago", visible: false },
            { data: "fpago", name: "fpago", visible: false },
            { data: "importe", name: "importe", visible: true },
            { data: "recargo", name: "recargo", visible: false },
            { data: "precio_gc", name: "precio_gc", visible: false },
            { data: "mes", name: "mes", visible: true },
            { data: "anio", name: "anio", visible: true },
            { data: "titular", name: "titular", visible: false },
            { data: "obs", name: "obs", visible: true },
            {
                defaultContent:
                    "<button type='button' class='form btn btn-primary'> <span class='glyphicon glyphicon-search'>  Seleccionar  </span></button>",
            },
            {
                defaultContent:
                    "<button type='button' class='pdfRecibo btn btn-outline-danger'> <span class='glyphicon glyphicon-signal'></span>  Imprimir </button>",
            },
        ],
    });

    $("#tabla-recibos tbody").on("click", "button.form", function () {
        var data = datatable.row($(this).parents("tr")).data();
        $("#hd_id_recibo").val(data["id_recibo"]);
        $("#txt_nro_recibo").val(data["nro_recibo"]);
        $("#select_serie").val(data["serie_recibo"]);
        $("#txt_fecha").val(data["fecha"]);
        $("#txt_importe").val(data["precio_gc"]);
        $("#txt_total").val(data["importe"]);
        $("#txt_interes").val(data["recargo"]);
        $("#txt_mes_cuota").val(data["mes"]);
        $("#select_anio").val(data["anio"]);
        $("#select_concepto").val(data["id_concepto"]);
        $("#select_forma_pago").val(data["id_fpago"]);
        $("#txt_titular").val(data["titular"]);
        $("#txt_obs").val(data["obs"]);
        $("#btn_agregar").attr("disabled", true);
        $("#btn_modificar").attr("disabled", false);
        serie_cargada = $("#select_serie").val();
        if (serie_cargada == "B") {
            $("#txt_nro_recibo").attr("disabled", true);
            $("#txt_fecha").attr("disabled", true);
        }else {
            $("#txt_nro_recibo").attr("disabled", false);
            $("#txt_fecha").attr("disabled", false);
        }



    });

    $("#tabla-recibos tbody").on("click", "button.pdfRecibo", function () {
        var data = datatable.row($(this).parents("tr")).data();
        myWindow = window
            .open("pdf_recibo?idRecibo=" + data["id_recibo"], "Pagos")
            .focus();
    });

    $("#tabla-recibos").show();
}