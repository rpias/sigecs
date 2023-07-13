$(function(){
    
    $('#select_unidad').on('change', onSelectUnidadChangeInConvenio);
  
    
});


function onSelectUnidadChangeInConvenio(){

    var id_unidad = $('#select_unidad').val();
   
    if(id_unidad > 0){
       
         //AJAX
        var ruta_unidades_por_edificio = ruta_raiz + "/convenio/" + id_unidad + "/unidad";
        $.get(ruta_unidades_por_edificio, function(data){
                    
           //var numero = nf.format(data[0].total);
           var numero = data[0].total;
           $('#txt_total_a_financiar').val(numero);
           $('#txt_deuda_actual').val(numero);  
           onTotalFinanciarChangeInConvenio();  
           
        });
      
    }else{
       
    }
 
}