$(() => {
    $("#select_unidad").on("change", onSelectUnidadChangeInConvenio);
    $("#txt_entrega_cta").on("keyup keypress blur change", actualizarEntregaCta);
    $("#txt_importe_cuota_refinanciado").on("keyup keypress blur change",actualizarEntregaCta);
    $("#txt_cuotas_refinanciado").on("keyup keypress blur change",actualizarEntregaCta);
    $("#txt_cantidad_cuotas").on("keyup keypress blur change",actualizarEntregaCta);
    $("#txt_entrega_cta").on("click", () => {$("#txt_entrega_cta").select();});
    $("#txt_cantidad_cuotas").on("click", () => {$("#txt_cantidad_cuotas").select();});
    $("#txt_importe_cuota_refinanciado").on("click", () => {$("#txt_importe_cuota_refinanciado").select();});
    $("#txt_cuotas_refinanciado").on("click", () => {$("#txt_cuotas_refinanciado").select();});
    $("#tipo_convenio").on("change",habilitarRefinanciado);
});

const onSelectUnidadChangeInConvenio = () => {
    var idUnidad = $("#select_unidad").val();
    calcularDeudaUnidad(idUnidad);
    cargarDTConveniosUnidad(idUnidad);
    $("#txt_entrega_cta").val(0);
    $("#txt_entrega_cta").prop("readonly", false);
    $("#txt_cantidad_cuotas").prop("readonly", false);
};

const calcularDeudaUnidad = (idUnidad) => {
    $.ajax({
        async: false,
        type: "GET",
        url: ruta_raiz + "unidad/" + idUnidad + "/deudaUnidad",
        success: function (data) {
            $("#txt_deuda_actual").val(data);
            $("#txt_total_a_financiar").val(data);
            titularesUnidad(idUnidad);
            formasPago();
            cuotasPorDefecto();
            actualizarCuota();
        },
    });
};

const cargarDTConveniosUnidad = (idUnidad) => {
    var ruta_convenios_por_unidad =
        ruta_raiz + "unidad/" + idUnidad + "/convenios";
    var idioma = ruta_raiz + "/plugins/datatables/latino.json";
    var datatable = $("#tabla-convenios").DataTable({
        dom: "Bfrtip",
        order: [[0, "desc"]], // Ordena la tabla por la columna indicada comenzando de cero.
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                title: "Lista de Convenios por Unidad",
                filename: "ListaConveniosPorUnidad",
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                image: logo,
                title: "Lista de Convenios por Unidad",
                filename: "ListaConveniosPorUnidad",
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
        pageLength: 5,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sSortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
        },
        ajax: ruta_convenios_por_unidad,
        columns: [
            { data: "id_convenio", name: "id_convenio", visible: false },
            { data: "fecha", name: "fecha" },
            { data: "edificio", name: "edificio" },
            { data: "unidad", name: "unidad" },
            { data: "importe_total", name: "importe_total" },
            { data: "importe_adelanto", name: "importe_adelanto" },
            { data: "cantidad_cuotas", name: "cantidad_cuotas" },
            { data: "importe_cuota", name: "importe_cuota" },
            { 
                data: 'refinanciado', 
                render: function(data) { 
                  if(data == 1) {
                    return 'SI';
                  }
                  else {
                    return 'NO';
                  }
                }
            },
            { 
                data: 'importe_refinanciado', 
                render: function(data) { 
                  if(data == null) {
                    return '0';
                  }
                  else {
                    return data;
                  }
                }
            },
            { 
                data: 'cantidad_cuotas_refinanciado', 
                render: function(data) { 
                  if(data == null) {
                    return '0';
                  }
                  else {
                    return data;
                  }
                }
            },
            { data: "estado_convenio", name: "estado_convenio" },
            {
                defaultContent:
                    "<button type='button' class='pdfConvenio btn btn-outline-danger'> <span class='glyphicon glyphicon-signal'></span>  Imprimir </button>",
            },
        ],
    });

    //Importante el .off es para que no se generen multiples eventos al hacer click
    $("#tabla-convenios tbody").off('click').on('click', "button.pdfConvenio" , function () {
        var data = datatable.row($(this).parents("tr")).data();
        myWindow = window
            .open("pdf_convenio?idConvenio=" + data["id_convenio"], "Convenio")
            .focus();
    });

    $("#tabla-convenios").attr("hidden", false); //Muestro la tabla de convenios de la unidad seleccionada
};

const titularesUnidad = (idUnidad) => {
    $.ajax({
        async: false,
        type: "GET",
        url: ruta_raiz + "unidades/" + idUnidad + "/titulares",
        success: function (data) {
            $("#select_titulares_unidad").empty();
            $.each(data, function (index, value) {
                $("#select_titulares_unidad").append(
                    "<option value='" +
                        value.id_persona +
                        "'>" +
                        value.primer_apellido + " " + value.segundo_apellido + " " + value.primer_nombre + " " + value.segundo_nombre +
                        "</option>"
                );
            });
        },
    });
};

const formasPago = () => {
    $.ajax({
        async: false,
        type: "GET",
        url: ruta_raiz + "facturas/formas_pago",
        success: function (data) {
            $("#select_formas_pago").empty();
            $.each(data, function (index, value) {
                $("#select_formas_pago").append(
                    "<option value='" + value.id_forma_pago + "'>" + value.nombre + "</option>"
                );
            });
        },
    });
}

const cuotasPorDefecto = (total_a_financiar) => {
    // Cantidad de cuotas por defecto
    // Hasta 50.000 en 30 cuotas
    // de 51.000 a 100.000 60 cuotas
    // 101.000 en adelante 72 cuotas
    var total_a_financiar = $("#txt_total_a_financiar").val();
    if (total_a_financiar < 51000) {
        $("#txt_cantidad_cuotas").val(CUOTAS_F1);
    } else if (total_a_financiar > 51000 && total_a_financiar < 101000) {
        $("#txt_cantidad_cuotas").val(CUOTAS_F2);
    } else if (total_a_financiar > 101000) {
        $("#txt_cantidad_cuotas").val(CUOTAS_F3);
    }
};

const actualizarCuota = () => {
    var cantidad_cuotas = $("#txt_cantidad_cuotas").val();
    var deuda_actual = $("#txt_deuda_actual").val();
    var entrega_a_cta = $("#txt_entrega_cta").val();
    var importe_cuota_refinanciado = $("#txt_importe_cuota_refinanciado").val();
    var cantidad_cuotas_refinanciado = $("#txt_cuotas_refinanciado").val();
    var cuota_mensual = 0;
    if (importe_cuota_refinanciado > 0) {
        var total_refinanciado =
            importe_cuota_refinanciado * cantidad_cuotas_refinanciado;
        var total_a_financiar = deuda_actual - total_refinanciado;
        $("#txt_total_refinanciado").val(total_refinanciado);
        $("#txt_total_a_financiar").val(total_a_financiar.toFixed(2));
        cuota_mensual = (total_a_financiar - entrega_a_cta) / cantidad_cuotas;
    } else {
        $("#txt_total_refinanciado").val(0);
        $("#txt_total_a_financiar").val(deuda_actual);
        cuota_mensual = (deuda_actual - entrega_a_cta) / cantidad_cuotas;
    }

    $("#txt_importe_cuota").val(cuota_mensual.toFixed(2));
};

const actualizarEntregaCta = () => {
    if ($("#txt_entrega_cta").val() < 0) {
        $("#txt_entrega_cta").val(0);
    }
    actualizarCuota();
};

const habilitarRefinanciado = () => {
    if (document.getElementById("tipo_convenio").value == "refinanciado") {
        $("#txt_importe_cuota_refinanciado").prop("readonly", false);
        $("#txt_cuotas_refinanciado").prop("readonly", false);
    } else {
        $('#txt_importe_cuota_refinanciado').val(0);
        $('#txt_cuotas_refinanciado').val(1);
        actualizarCuota();
        $("#txt_importe_cuota_refinanciado").prop("readonly", true);
        $("#txt_cuotas_refinanciado").prop("readonly", true);
    }
};

const crearConvenio = () => {
    var form_element = document.getElementsByClassName("form-data");
    var form_data = new FormData();

    for(var i = 0; i < form_element.length; i++)
    {
        form_data.append(form_element[i].name, form_element[i].value);
    }

    var data = JSON.stringify(Object.fromEntries(form_data));
    data = JSON.parse(data);

    $.ajax({
        type:'POST',
        url: ruta_raiz + 'crear_convenio',
        data: data,
 
        success:function(response){
            const alert = document.getElementById("message")
            alert.innerHTML = response;
            onSelectUnidadChangeInConvenio();
            cargarDTConveniosUnidad(data.select_unidad);

            setTimeout(function(){ 
                alert.innerHTML = "";
        
            }, 6000);
           
           //myWindow = window.open('pdf_convenio?idConvenio=' + "1", "Convenio").focus();
 
        },
 
     });

}
