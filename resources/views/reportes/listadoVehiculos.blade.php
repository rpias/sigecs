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
      <th class="tg-0lax">Tipo Vehículo</th>
      <th class="tg-0lax">Matrícula</th>
      <th class="tg-0lax">Marca</th>
      <th class="tg-0lax">Modelo</th>
      <th class="tg-0lax">Año</th>
    </tr>
</thead>
<tbody>
  @foreach($vehiculos as $vehiculo)
  <tr>
    <td>{{ $vehiculo->edificio }}</td>
    <td>{{ $vehiculo->unidad }}</td>
    <td>{{ $vehiculo->tipo_vehiculo }}</td>
    <td>{{ $vehiculo->matricula }}</td>
    <td>{{ $vehiculo->marca }}</td>
    <td>{{ $vehiculo->modelo }}</td>
    <td>{{ $vehiculo->anio }}</td>
   
  
  </tr>
  @endforeach
</tbody>



</table>

<br><br>
Cantidad de Registros : {{ $cantidad_registros }}
<br>
</body>
</html>
