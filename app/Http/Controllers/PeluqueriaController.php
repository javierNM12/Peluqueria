<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use App\Models\Clientes;
use App\Models\Servicios;
use Carbon\Carbon;
use DB;
use Dompdf\Dompdf;

class PeluqueriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('alarmas');
    }

    // cargar en index principal
    public function inicio()
    {
        $servicios = Servicios::get();

        //DB::enableQueryLog();
        $mytime = Carbon::now();
        $citas = Citas::orderBy('fecha_hora_i', 'asc')->where('fecha_hora_i', '>=', $mytime->startOfDay()->toDateTimeString())->where('fecha_hora_f', '<=', $mytime->endOfDay()->toDateTimeString())->where('finalizado', '=', '0')->get();

        $clientes = Clientes::get();
        //dd(DB::getQueryLog());
        return view("inicio", compact(['citas', 'clientes', 'servicios']));
    }

    public function formajustes()
    {
        return view("admin.form");
    }

    public function guardarajustes(Request $request)
    {
        config(['settings.PIN' => $request->pin]);
        return $this->inicio();
    }

    public function generatePDF(Request $request)
    {
        $dompdf = new Dompdf();

        $html = '<html>
                    <head>
                        <style>
                        table {
                        border-collapse: collapse;
                        width: 100%;
                        }
                        
                        table td, table th {
                        border: 1px solid black;
                        padding: 8px;
                        }
                        </style>
                    </head>
                    <body>
                    <h1>' . $request->titulo . '</h1>';
        $html .= $request->html;
        $html .= '<footer class="ps-5 py-4 border-bottom" style="margin-top: 3rem;">
                <span>Peluquería Yadira</span>
            </footer>
            </body>
        </html>
        ';
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
        // return $dompdf->stream();

        return response()->download($dompdf);
    }
}
