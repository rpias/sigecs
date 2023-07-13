<link href="{{ public_path('css/pdf_convenio.css')}}" rel="stylesheet" />
<link href="{{ public_path('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />

<div class="contenedor">
    <img src="{{ public_path('img/comision_admin_central_datos.jpg') }}" alt="comision" />
    <div class="encabezado">
        <div class="encabezado-titulo">
            <h4>CONVENIO DE PAGO</h1>
        </div>
        <div class="encabezado-fecha">
            <p>Montevideo, <b>{{$diaConvenio}}</b> de <b>{{$mesConvenio}}</b> de <b>{{$anioConvenio}}</b></p>
        </div>
    </div>
    <div class="contenido">
        <div class="contenido-porunaparte">
            <p><b>Por una parte,</b> la Comisión Administradora Central del Complejo Euskal Erria 71, actuando
                en cumplimiento a lo dispuesto en la Resolución del Directorio de la Agencia Nacional de
                Vivienda N° 0163/06 de fecha 07/02/2006. --------------------------.</p>
        </div>
        <div class="contenido-porotraparte">
            <p><b>Por otra parte,</b> el Sr./Sra.: <b>{{$convenio->titular}}</b>
                C.I.:<b>{{$convenio->cedula_titular}}</b> con domicilio en Torre <b></b> apartamento………….. de
                este Complejo, convienen en celebrar el siguiente Convenio de Pago de Gastos Comunes, el
                que consta de las siguientes cláusulas:------------------------------------------ </p>
        </div>
        <div class="contenido-clausula-primera">
            <p>CLÁUSULA PRIMERA: El Sr./Sra.: <b>{{$convenio->titular}}</b> debe a la Comisión
                Administradora Central por concepto de Gastos Comunes, la suma de 
                <b>$ {{$convenio->importe_total}}</b> correspondiente al periodo comprendido entre
                ……………………………….………….. y …………………………, dicho monto no
                incluye la multa del 10% calculado sobre el total de la
                deuda------------------------------------------</p>
        </div>
        <div class="contenido-clausula-segunda">
            <p>CLÁUSULA SEGUNDA: En esta instancia el Sr./Sra.: ……………………………………..
                reconoce dicha deuda y ofrece pagar la suma de $ ……………………… en el día de la
                fecha en …. cuotas de acuerdo al siguiente detalle, ……. de $ …………….y las ……….
                cuotas restantes iguales y consecutivas de $.............................,) reajustables cada 12 meses de
                acuerdo al porcentaje de aumento de los gastos comunes. Además del pago de los gastos
                comunes mensuales.-------------------------------------------------------------------------------</p>
        </div>
        <div class="contenido-clausula-tercera">
            <p>CLÁUSULA TERCERA: La Comisión Administradora Central, en concordancia a lo
                establecido en el artículo 6 del Reglamento antes mencionado, modificado por Resolución
                0163/06 y en aplicación a lo dispuesto en el inciso tercero, acepta aplicar un régimen de
                refinanciación benévolo acorde a la situación económica y social del
                Sr./Sra.:………………………………………….., motivo por el cual acepta dicha propuesta
                recibiendo la suma dada por concepto de entrega, otorgando carta de pago exonerándolo/a de
                la multa mencionada en la Cláusula Primera de este Convenio.-----</p>
        </div>
        <div class="contenido-clausula-cuarta">
            <p>CLAUSULA CUARTA: Las cuotas serán pagaderas del 1° al 15 de cada mes, comenzando a
                pagar la primera a partir del mes siguiente a la suscripción del convenio. Las cuotas se
                pagarán en forma conjunta con los gastos comunes de cada mes, siendo las mismas de
                carácter indivisible con estos últimos.</p>
        </div>
        <div class="contenido-clausula-quinta">
            <p>CLÁUSULA QUINTA: El no pago de dos (2) cuotas consecutivas, dará lugar a la rescisión
                del presente Convenio por el solo incumplimiento, sin necesidad de apercibimiento ni
                notificación alguna. De caducar el Convenio por falta de pago, la Comisión Administradora
                Central procederá a notificar del incumplimiento a la Agencia Nacional de Vivienda para que
                ésta inicie así los trámites correspondientes, a fin de que la CAC pueda cobrar lo adeudado.</p>
        </div>
        <div class="contenido-clausula-sexta">
            <p>CLÁUSULA SEXTA: De existir convenios anteriores, los mismos caducarán y dejarán de
                surtir efecto, teniendo única validez el suscripto en esta instancia.</p>
        </div>
        <div class="contenido-clausula-septima">
            <p>CLÁUSULA SÉPTIMA: Este acuerdo no exonera del pago de otras deudas por concepto de
                gastos comunes que pudieran existir, ni el pago de gastos comunes correspondientes al mes a
                vencer. ---------------------------------------------------------------</p>
        </div>
        <div class="contenido-clausula-octava">
            <p>CLÁUSULA OCTAVA: El Sr./Sra.: …………………………………… declara aceptar el 
                alcance de este convenio en todos sus términos.----------------------------------
                Leído, se firma de conformidad dos ejemplares del mismo tenor. --------------------------
            </p>
        </div>
    </div>
    <div class="firmas">
        <p>Presidente Secretaria/o Interesado</p>
    </div>
</div>