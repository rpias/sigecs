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
      <th class="tg-0lax">idEdificio</th>
      <th class="tg-0lax">Identificador Edificio</th>
      <th class="tg-0lax">Número Edificio</th>
      <th class="tg-0lax">Cantidad Unidades</th>
    </tr>
</thead>
  
<tbody>
  @foreach($edificios as $edificio)
  <tr>
    <td>{{ $edificio->id_edificio }}</td>
    <td>{{ $edificio->identificador }}</td>
    <td>{{ $edificio->nombre }}</td>
    <td>{{ $edificio->cantidad_departamentos }}</td>
  </tr>
  @endforeach
</tbody>



</table>

<br><br>
Cantidad de Registros : {{ $cantidad_registros }}
<br>
</body>
</html>
