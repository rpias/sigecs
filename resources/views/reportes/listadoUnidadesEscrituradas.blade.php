<html><head>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
</head><body>
<table class="tg">
  <thead>
    <tr>
      <th class="tg-0lax">Edificio</th>
      <th class="tg-0lax">Unidad</th>
      <th class="tg-0lax">Tipo Movimiento</th>
      <th class="tg-0lax">Fecha</th>
      <th class="tg-0lax">Cédula</th>
      <th class="tg-0lax">Primer Nombre</th>
      <th class="tg-0lax">Segundo Nombre</th>
      <th class="tg-0lax">Primer Apellido</th>
      <th class="tg-0lax">Segundo Apellido</th>
    </tr>
</thead>
<tbody>
  @foreach($unidades as $unidad)
  <tr>
    <td>{{ $unidad->nombre }}</td>
    <td>{{ $unidad->descripcion }}</td>
    <td>{{ $unidad->tipo_mov_registral }}</td>
    <td>{{ $unidad->fecha }}</td>
    <td>{{ $unidad->cedula }}</td>
    <td>{{ $unidad->primer_nombre }}</td>
    <td>{{ $unidad->segundo_nombre }}</td>
    <td>{{ $unidad->primer_apellido }}</td>
    <td>{{ $unidad->segundo_apellido }}</td>
   
  
  </tr>
  @endforeach
</tbody>



</table>

<br><br>
Cantidad de Registros : {{ $cantidad_registros }}
<br>
</body>
</html>
