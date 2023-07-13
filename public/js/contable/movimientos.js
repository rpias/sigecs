$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    resetForm();

});

function resetForm() {

    var facturas_seleccionadas = "";
    $('#btn_agregar').attr("disabled", false);
    $('#btn_modificar').attr("disabled", true);
    $('#btn_eliminar').attr("disabled", true);
    $('#btn_imp_recibo').attr("disabled", true);
    $('#btn_ver_recibos').hide();
    $('#select_rubro').on('change', onSelectRubrosChange);
    $("select_rubro").val(0);
    $('#select_sub_rubro').html('<option value="0">Seleccione Sub Rubro</option>');
    $('#btn_buscar').on('click', onClickBtnBuscarMov);
    $('#btn_eliminar').on('click', onClickBtnEliminarMovimiento);
    $("frm_mov").hide();
    $('#hd_id_movimiento').val("");
    $('#txt_fecha_mov').val("");
    $('#txt_detalle').val("");
    $('#txt_fecha_doc').val("");
    $('#txt_nro_doc').val("");
    $('#txt_importe').val("");
    $('#txt_obs').val("");
    $('#tabla_mov').hide();
    
    // $('.close').on('click', onClickCloseRedireccionar);

}

function onClickBtnEliminarMovimiento() {

    $('#hd_eliminar').val(1);

}

function onClickBtnBuscarMov() {

    /*
    fecha_mov = $('#txt_fecha_mov').val();
    rubro = $('#select_rubro').val();
    sub_rubro = $('#select_SUB_rubro').val();
    detalle = $('#txt_detalle').val();
    fecha_doc = $('#txt_fecha_doc').val();
    nro_doc = $('#txt_nro_doc').val();
    importe = $('#txt_importe').val();
    obs = $('#txt_obs').val();
    */


    
    $('#tabla_mov').show();
    

}

function onSelectRubrosChange() {

    // =====================================================================
    // Cargar combo Sub Rubros dependiendo del Rubro
    // =====================================================================

    var id_rubro = $(this).val();
    if (!id_rubro) {
        $('#select_sub_rubro').html('<option value="0">Seleccione Sub Rubro</option>');
        return;
    }

    var ruta_sub_rubros_por_rubro = ruta_raiz + "rubros/" + id_rubro + "/sub_rubros";
    $.get(ruta_sub_rubros_por_rubro, function(data) {
        var html_select = '';
        html_select = '<option value="">Seleccione Sub Rubro</option>';
        for (var i = 0; i < data.length; ++i) {
            html_select += '<option value="' + data[i].id_rubro + '">' + data[i].nombre + '</option>';
            $('#select_sub_rubro').html(html_select);
        }

    });
}
