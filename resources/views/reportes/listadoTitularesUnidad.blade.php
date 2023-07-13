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
      <th class="tg-0lax">Cédula Identidad Titular</th>
      <th class="tg-0lax">Nombre Competo del Titular</th>
    </tr>
</thead>
<tbody>
  @foreach($titulares as $titular)
  <tr>
    <td>{{ $titular->edificio }}</td>
    <td>{{ $titular->unidad }}</td>
    <td>{{ $titular->cedula }}</td>
    <td>
        {{ $titular->primer_nombre  }} &nbsp; 
        {{ $titular->segundo_nombre }} &nbsp; 
        {{ $titular->primer_apellido }} &nbsp; 
        {{ $titular->segundo_apellido }}
    </td>
  
  </tr>
  @endforeach
</tbody>



</table>

<br><br>
Cantidad de Registros : {{ $cantidad_registros }}
<br>
</body>
</html>
