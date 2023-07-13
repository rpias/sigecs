<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\RegistroSuceso;

class Controller extends BaseController
{
    
    // CONSTANTES GLOBALES

    const RECIBOS_GASTOS_COMUNES = 1;
    const RECIBOS_CONVENIO = 2;
    const RECIBOS_ANULADOS = 3;
    const RECIBOS_GASTOS_COMUNES_INTERESES = 4;
    const FACTURAS_ANULADAS = 5;
    const RECIBOS_GASTOS_COMUNES_DIFERENCIA_NO_COBRADA = 6;
    const RECIBOS_convenios_DIFERENCIA_NO_COBRADA = 7;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUserIpAddr()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function getMenuPorRol($id_rol)
    {

        $sql = "call SP_ListarMenuPadresPorRol(?)";
        $dt_menu_padres = DB::select($sql, array($id_rol));
        
        //session(['menu_padres' => count($dt_menu_padres)]);

        $str_menu = "";
        $str_menu .= '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';

        foreach ($dt_menu_padres as $menu_padres) {
            $str_menu .= '<li class="nav-item has-treeview">';
            $str_menu .= '  <a href="" class="nav-link">
                                <i class="' . $menu_padres->icono . '"></i>
                                    <p>
                                        ' . $menu_padres->menu . '
                                         <i class="right fa fa-angle-left"></i>
                                    </p>
                            </a>
                        <ul class="nav nav-treeview">';

            $sql = "call SP_ListarMenuHijosPorRol(?,?)";
            $dt_menu_hijos = DB::select($sql, array($id_rol, $menu_padres->id_menu));

            foreach ($dt_menu_hijos as $menu_hijo) {
                $str_menu .= '<li class="nav-item">
                                <a href="' . $menu_hijo->ruta . '" class="nav-link">
                                    <i class="' . $menu_hijo->icono . '"></i>
                                    <p>' . $menu_hijo->menu . '</p>
                                </a>
                              </li>';
            }
            $str_menu .= '</ul></li>';
        }
        $str_menu .= '</ul>';

        return $str_menu;
    }

    public function guardarLog($id_usuario, $descripcion, $parametros)
    {
        $registro = new RegistroSuceso();
        $registro->id_usuario = $id_usuario;
        $registro->SP = $descripcion;
        $registro->parametros = $parametros;
        $registro->ip = $this->getUserIpAddr();
        $registro->save();
    }

      //FUNCIONES PARA PASAR NUMEROS A TEXTO
    //PRE CONDICIONES: El numero debe ser mayor a cero
    //POST CONDICIONES: Devuelve el numero en letras junto con la palabra de la moneda
    public function numerosATexto($numeros, $moneda)
    {
        if(is_numeric($numeros))//Si es un numero
        {
            return $this->millones((int)$numeros) . " " . $moneda;
        }
        return "";
    }

    private function unidades($numero)//Para el caso de un solo digito
    {
        switch ($numero)
        {
            case 1:
                return "UN";
            case 2:
                return "DOS";
            case 3:
                return "TRES";
            case 4:
                return "CUATRO";
            case 5:
                return "CINCO";
            case 6:
                return "SEIS";
            case 7:
                return "SIETE";
            case 8:
                return "OCHO";
            case 9:
                return "NUEVE";
        }
        return "";
    }

    private function decenas($numero)//Para el caso de las decenas
    {
        $decena = floor($numero / 10);
        $unidad = $numero - ($decena * 10);

        switch ($decena)
        {
            case 0:
                return $this->unidades($unidad);
            case 1:
                switch($unidad)
                {
                    case 0:
                        return "DIEZ";
                    case 1:
                        return "ONCE";
                    case 2:
                        return "DOCE";
                    case 3:
                        return "TRECE";
                    case 4:
                        return "CATORCE";
                    case 5:
                        return "QUINCE";
                    default:
                        return "DIECI" . $this->unidades($unidad);
                }
            case 2:
                switch($unidad)
                {
                    case 0:
                        return "VEINTE";
                    default:
                        return "VEINTI" . $this->unidades($unidad);
                }
            case 3:
                return $this->decenasY("TREINTA", $unidad);
            case 4:
                return $this->decenasY("CUARENTA", $unidad);
            case 5:
                return $this->decenasY("CINCUENTA", $unidad);
            case 6:
                return $this->decenasY("SESENTA", $unidad);
            case 7:
                return $this->decenasY("SETENTA", $unidad);
            case 8:
                return $this->decenasY("OCHENTA", $unidad);
            case 9:
                return $this->decenasY("NOVENTA", $unidad);
        }
    }

    private function decenasY($strSin, $numUnidades)//Concatena las palabras en caso de que la decena sea mayor o igual a treinta
    {
        if ($numUnidades > 0)
        {
            return $strSin . " Y " . $this->unidades($numUnidades);
        }
        return $strSin;
    }

    private function centenas($numero)//Para el caso de las centenas
    {
        $centena = floor($numero / 100);//Obtiene las centenas
        $decena = $numero - ($centena * 100);//Obtiene las decenas

        switch ($centena)
        {
            case 0:
                return $this->decenas($decena);//Llama a decenas
            case 1:
                if ($decena > 0)
                {
                    return "CIENTO " . $this->decenas($decena);
                }
                return "CIEN ";
            case 2:
                return "DOSCIENTOS " . $this->decenas($decena);
            case 3:
                return "TRESCIENTOS " . $this->decenas($decena);
            case 4:
                return "CUATROCIENTOS " . $this->decenas($decena);
            case 5:
                return "QUINIENTOS " . $this->decenas($decena);
            case 6:
                return "SEISCIENTOS " . $this->decenas($decena);
            case 7:
                return "SETECIENTOS " . $this->decenas($decena);
            case 8:
                return "OCHOCIENTOS " . $this->decenas($decena);
            case 9:
                return "NOVECIENTOS " . $this->decenas($decena);
            default:
                return "";
        }
    }

    private function miles($numero)//Para el caso de los miles
    {
        $divisor = 1000;
        $cientos = floor($numero / $divisor);
        $resto = $numero - ($cientos * $divisor);
        
        //Esta variable almacena el principio de la cadena en caso de que la variable cientos sea mayor a 2
        $strPrincipio = '';
        
        $strMiles = $this->seccion($numero, $divisor, "UN MIL", "MIL");
        $strCentenas = $this->centenas($resto);

        if($strMiles == "")
        {
            return $strCentenas;
        }

        return $strPrincipio . " " . $strMiles . " " . $strCentenas;
    }

    private function millones($numero)//Para el caso de los millones
    {
        $divisor = 1000000;
        $cientos = floor($numero / $divisor);
        $resto = $numero - ($cientos * $divisor);

        $strMillones = $this->seccion($numero, $divisor, "UN MILLON DE", "MILLONES DE");
        $strMiles = $this->miles($resto);

        if($strMillones == "")
        {
            return $strMiles;
        }

        return $strMillones . " " . $strMiles;
    }

    private function seccion($numero, $divisor, $strSingular, $strPlural)
    {
        $cientos = floor($numero / $divisor);
        $resto = $numero - ($cientos * $divisor);

        $letras = "";

        if($cientos > 0)
        {
            if($cientos > 1)
            {
                $letras = $this->centenas($cientos) . " " . $strPlural;
            }
            else
            {
                $letras = $strSingular;
            }
        }
        
        if($resto > 0)
        {
            $letras .= "";
        }

        return $letras;
    }

    //FIN DE FUNCIONES PARA PASAR NUMEROS A TEXTO


}