function onClickBtnUltimoPago() {
    var ruta_ultimo_pago_por_unidad = ruta_raiz + "ultimopago";

    $("#tabla_ultimo_pago").DataTable({
        dom: "Bfrtip",
        retrieve: true,
        buttons: [
            {
                extend: "excel",
                text: "Excel",
                footer: true,
                retrieve: true,
                title: 'Lista último pago por Apartamento',
                filename: 'ListaUltimoPagoPorApartamento'
            },

            {
                extend: "pdf",
                text: "PDF",
                footer: true,
                title: "Lista último pago por Apartamento",
                filename: "ListaUltimoPagoPorApartamento",
                pageSize: "A4",
            },

            {
                extend: "print",
                text: "Imprimir",
            },
        ],
        pageLength: 5,
        serverSide: false,
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
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
        ajax: ruta_ultimo_pago_por_unidad,
        columns: [
            { data: "torre_nombre", name: "torre_nombre" },
            { data: "torre_nro", name: "torre_nro" },
            { data: "unidad", name: "unidad" },
            { data: "fecha", name: "fecha" },
            { data: "nro_recibo", name: "nro_recibo" },
            { data: "mes", name: "mes" },
            { data: "anio", name: "anio" },
            { data: "obs", name: "obs" },
            { data: "ultimo_expediente", name: "ultimo_expediente" },
        ],
    });
}

function onClickBtnGenerarPdfPagos() {
    myWindow = window
        .open(
            "pdf_pagos?torre=" +
                document.getElementById("select_edificio").value,
            "Pagos"
        )
        .focus();
}

$(document).ready(function () {
    $("#btn_listar_ultimo_pago").on("click", onClickBtnUltimoPago);
    $("#btn_generar_pdf_pagos").on("click", onClickBtnGenerarPdfPagos);

    $("#tabla-morosidad").DataTable({
        dom: "Bfrtip",
        buttons: {
            buttons: [
                {
                    extend: "excel",
                    text: "Excel",
                    footer: true,
                    className: "btn btn-success",
                    title: "Lista de Pagos por Apartamento",
                    filename: "ListaPagosPorApartamento",
                },

                {
                    extend: "pdf",
                    text: "PDF",
                    footer: true,
                    className: "btn btn-danger",
                    title: "Lista de Pagos por Apartamento",
                    filename: "ListaPagosPorApartamento",
                    pageSize: "A4",
                },

                {
                    extend: "print",
                    text: "Imprimir",
                    className: "btn btn-info",
                },
            ],
            dom: {
                button: {
                    className: "btn",
                },
            },
        },
        pageLength: 10,
        serverSide: false,
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
    });
});
