<link href="{{ public_path('css/pdf_recibo.css')}}" rel="stylesheet"/>
<link href="{{ public_path('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"/>

<div class="contenedor">
    <div class="via-cliente">
        <img src="{{ public_path('img/comision_admin_central_datos.jpg') }}" alt="comision"/>
        <div class="contenedor-fecha-unidad-via-numero">
            <div class="fecha">
                <table class="tabla-fecha table table-sm table-bordered">
                    <thead>
                        <th scope="col">DÍA</th>
                        <th scope="col">MES</th>
                        <th scope="col">AÑO</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$dia_Actual}}</td>
                            <td>{{$mes_Actual}}</td>
                            <td>{{$anio_Actual}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="unidad">
                <table class="tabla-unidad table table-sm table-bordered">
                    <thead>
                        <th scope="col">TORRE</th>
                        <th scope="col">UNIDAD</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$recibo[0]->edificio}}</td>
                            <td>{{$recibo[0]->unidad}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="via-cliente-texto">
                <p>VIA: CLIENTE</p>
            </div>
            <div class="serie-numero">
                SERIE: {{$recibo[0]->serie_recibo}} <br/>
                N° {{$recibo[0]->nro_recibo}}
            </div>
        </div>
        <div class="contenedor-importe">
            <table class="tabla-importe table table-sm table-bordered">
                <thead>
                    <th scope="col"></th>
                    <th scope="col">IMPORTE</th>
                    <th scope="col">RECARGO</th>
                    <th scope="col">DESCUENTO</th>
                    <th scope="col">MES</th>
                    <th scope="col">AÑO</th>
                    <th scope="col">CUOTA</th>
                    <th scope="col">SALDO</th>
                    <th scope="col">TOTAL</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-concepto">GASTOS COMUNES</td>
                        @php
                        if($recibo[0]->concepto == 'GASTOS COMUNES')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                    <tr>
                        <td class="td-concepto">CONVENIO</td>
                        @php
                        if($recibo[0]->concepto == 'CONVENIO')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                    <tr>
                        <td class="td-concepto">FONDO DE RESERVA</td>
                        @php
                        if($recibo[0]->concepto == 'FONDO DE RESERVA')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="contenedor-leyenda">
            @php
            $cantLineasPrimerRenglon = 50 - strlen($recibo[0]->titular);
            $cantLineasSegundoRenglon = 33 - strlen($texto_Monto);
            $cantLineasTercerRenglon = 0;
            if($cantLineasSegundoRenglon < 0)
            {
                $cantLineasTercerRenglon = 100 - strlen($texto_Monto);
            }
            $lineasPrimerRenglon = '';
            $lineasSegundoRenglon = '';
            $lineasTercerRenglon = '';
            for($i = 0; $i < $cantLineasPrimerRenglon; $i++)
            {
                $lineasPrimerRenglon .= '_';
            }
            for($i = 0; $i < $cantLineasSegundoRenglon; $i++)
            {
                $lineasSegundoRenglon .= '_';
            }
            for($i = 0; $i < $cantLineasTercerRenglon; $i++)
            {
                $lineasTercerRenglon .= '_';
            }

            echo '<p>RECIBÍ DE:_'.'<span class="leyenda-agregada">'.strtoupper($recibo[0]->titular).'</span>'.$lineasPrimerRenglon
            .'<br/>'.'LA CANTIDAD DE PESOS URUGUAYOS_'.'<span class="leyenda-agregada">'.$texto_Monto.'</span>'.$lineasSegundoRenglon
            .$lineasTercerRenglon.'</p>';
            @endphp
            <p class="pie-concepto">POR CONCEPTO DE GASTOS COMUNES, CONVENIOS Y/O FONDOS DE RESERVA</p>
            <p class="pie-leyenda">SU PAGO NO CANCELA ADEUDOS ANTERIORES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p class="pie-leyenda-firma">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Por&nbsp;:&nbsp;CAC
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
    </div>  
    
    <div class="via-administracion">
        <img src="{{ public_path('img/comision_admin_central_datos.jpg') }}" alt="comision"/>
        <div class="contenedor-fecha-unidad-via-numero">
            <div class="fecha">
                <table class="tabla-fecha table table-sm table-bordered">
                    <thead>
                        <th scope="col">DÍA</th>
                        <th scope="col">MES</th>
                        <th scope="col">AÑO</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$dia_Actual}}</td>
                            <td>{{$mes_Actual}}</td>
                            <td>{{$anio_Actual}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="unidad">
                <table class="tabla-unidad table table-sm table-bordered">
                    <thead>
                        <th scope="col">TORRE</th>
                        <th scope="col">UNIDAD</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$recibo[0]->edificio}}</td>
                            <td>{{$recibo[0]->unidad}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="via-administracion-texto">
                <p>VIA: ADMINISTRACION</p>
            </div>
            <div class="serie-numero">
                SERIE: {{$recibo[0]->serie_recibo}} <br/>
                N° {{$recibo[0]->nro_recibo}}
            </div>
        </div>
        <div class="contenedor-importe">
            <table class="tabla-importe table table-sm table-bordered">
                <thead>
                    <th scope="col"></th>
                    <th scope="col">IMPORTE</th>
                    <th scope="col">RECARGO</th>
                    <th scope="col">DESCUENTO</th>
                    <th scope="col">MES</th>
                    <th scope="col">AÑO</th>
                    <th scope="col">CUOTA</th>
                    <th scope="col">SALDO</th>
                    <th scope="col">TOTAL</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-concepto">GASTOS COMUNES</td>
                        @php
                        if($recibo[0]->concepto == 'GASTOS COMUNES')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                    <tr>
                        <td class="td-concepto">CONVENIO</td>
                        @php
                        if($recibo[0]->concepto == 'CONVENIO')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                    <tr>
                        <td class="td-concepto">FONDO DE RESERVA</td>
                        @php
                        if($recibo[0]->concepto == 'FONDO DE RESERVA')
                        {
                            echo "<td>".$recibo[0]->importe."</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>".$recibo[0]->mes."</td>";
                            echo "<td>".$recibo[0]->anio."</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo '<td class=td-total>$u'.$recibo[0]->importe."</td>";
                        }
                        else
                        {
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- - - -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                            echo "<td>- -</td>";
                        }
                        @endphp
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="contenedor-leyenda">
            @php
            $cantLineasPrimerRenglon = 50 - strlen($recibo[0]->titular);
            $cantLineasSegundoRenglon = 33 - strlen($texto_Monto);
            $cantLineasTercerRenglon = 0;
            if($cantLineasSegundoRenglon < 0)
            {
                $cantLineasTercerRenglon = 100 - strlen($texto_Monto);
            }
            $lineasPrimerRenglon = '';
            $lineasSegundoRenglon = '';
            $lineasTercerRenglon = '';
            for($i = 0; $i < $cantLineasPrimerRenglon; $i++)
            {
                $lineasPrimerRenglon .= '_';
            }
            for($i = 0; $i < $cantLineasSegundoRenglon; $i++)
            {
                $lineasSegundoRenglon .= '_';
            }
            for($i = 0; $i < $cantLineasTercerRenglon; $i++)
            {
                $lineasTercerRenglon .= '_';
            }

            echo '<p>RECIBÍ DE:_'.'<span class="leyenda-agregada">'.strtoupper($recibo[0]->titular).'</span>'.$lineasPrimerRenglon
            .'<br/>'.'LA CANTIDAD DE PESOS URUGUAYOS_'.'<span class="leyenda-agregada">'.$texto_Monto.'</span>'.$lineasSegundoRenglon
            .$lineasTercerRenglon.'</p>';
            @endphp
            <p class="pie-concepto">POR CONCEPTO DE GASTOS COMUNES, CONVENIOS Y/O FONDOS DE RESERVA</p>
            <p class="pie-leyenda">SU PAGO NO CANCELA ADEUDOS ANTERIORES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            <p class="pie-leyenda-firma">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Por&nbsp;:&nbsp;CAC
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
    </div>
</div>