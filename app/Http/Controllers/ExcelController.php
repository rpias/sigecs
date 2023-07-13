<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Exporter;

class ExcelController extends Controller
{
    private $exporter;
    public function __construct(Exporter $exporter)
    {
        $this->exporter = $exporter;
    }

    public function import(){

        return $this->importer->import(new importacion, 'C:\Users\rpias\Desktop\Morosidad.xls');
    }

}