<?php

namespace App\Http\Controllers;

use App\Http\Requests\procesarMensualCategoria;
use App\Http\Requests\procesarMensualPersonal;
use App\Http\Requests\procesarMensualServicio;
use App\Repositories\CategoriaAdversoRespository;
use App\Repositories\FichaRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\PersonalRepository;
use App\Repositories\ProblemaRepository;
use App\Repositories\ServicioRepository;
use App\Repositories\TipoEventoRepository;
use App\Repositories\TipoIncidenteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Khill\Lavacharts\Lavacharts;

class ReportesController extends Controller
{

    private $pacienteRepo;
    private $tipoIncidenteRepo;
    private $tipoEventoRepo;
    private $categoriaAdversoRepo;
    private $fichaRepo;
    private $servicioRepo;
    private $problemaRepo;
    private $personalRepo;

    public function __construct(PacienteRepository $pacienteRepository,
                                TipoIncidenteRepository $tipoIncidenteRepository,
                                TipoEventoRepository $tipoEventoRespository,
                                CategoriaAdversoRespository $categoriaAdversoRepository,
                                FichaRepository $fichaRepository,
                                ServicioRepository $servicioRepository,
                                 ProblemaRepository $problemaRepository,
                                PersonalRepository $personalRepository)
    {
        $this->middleware('auth');
        $this->pacienteRepo = $pacienteRepository;
        $this->tipoIncidenteRepo= $tipoIncidenteRepository;
        $this->tipoEventoRepo = $tipoEventoRespository;
        $this->categoriaAdversoRepo = $categoriaAdversoRepository;
        $this->fichaRepo = $fichaRepository;
        $this->servicioRepo = $servicioRepository;
        $this->problemaRepo = $problemaRepository;
        $this->personalRepo = $personalRepository;
    }

    public function mensualServicio()
    {
        $tipoIncidentes = $this->tipoIncidenteRepo->getAll();
        $tipoIncidenteSelect = $tipoIncidentes->pluck('nom_incidente', 'id');
        return view('reportes/mensual_servicio', compact('tipoIncidenteSelect'));
    }

    public function procesarMensualServicio(procesarMensualServicio $request)
    {

//        dd($request->all());
        $fecha_inicio = $request->get('fecha_inicio');
     //   dd($fecha_inicio);
        $fecha_fin = $request->get('fecha_fin');
        $tipo_incidente_id = $request->get('tipo_incidente_id');
       // dd($tipo_incidente_id);
        $fecha = [$fecha_inicio, $fecha_fin];


        $tipo_incidentes = $this->tipoIncidenteRepo->findOrFail($tipo_incidente_id);
       // dd($tipo_incidentes);
        $servicios = $this->servicioRepo->getAll();
        //dd($fecha);

        $totalServicio_primer = $this->fichaRepo->r_num_incidentes($fecha, $tipo_incidente_id);


        $i = 0;
        foreach($servicios as $servicio)
        {
            $total_primer[$i]['nombre'] = $servicio->nom_servicio;
            $total_primer[$i]['total'] = $this->fichaRepo->r_num_incidentes_servicio($servicio->id, $fecha, $tipo_incidente_id);
            if($totalServicio_primer > 0){

                $porcentaje_primer = ($total_primer[$i]['total'] * 100) / $totalServicio_primer;
            }else{
                $porcentaje_primer = 0;
            }

            $total_primer[$i]['porcentaje'] = $porcentaje_primer;



//            $total_segundo[$i]['nombre'] = $servicio->nom_servicio;
//            $total_segundo[$i]['total'] = $this->fichaRepo->r_num_incidentes_servicio($servicio->id, $fecha_1_b);
//            $porcentaje_segundo = ($total_segundo[$i]['total'] * 100) / $totalServicio_segundo;
//            $total_segundo[$i]['porcentaje'] = $porcentaje_segundo;
            $i++;
        }
        /// chart

        $lava = new Lavacharts;

        $r_serv = $lava->DataTable();

        $r_serv->addStringColumn('Servicios')
                ->addNumberColumn('Percent');

        foreach($total_primer as $t)
        {
            $r_serv->addRow([ $t['nombre'], $t['total'] ]);
        }
        $lava->DonutChart('r_serv', $r_serv, [
            'title' => 'Reporte de '.$tipo_incidentes->nom_incidente.' por servicio',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 16
            ],
            'pieSliceText' => 'percentage',
            'pieSliceColor' => 'red',
            'pieSliceTextStyle' => [
                'fontSize' => 18
            ],
             //'is3D' => true,
            'pieHole' => 0.4,
            'sliceVisibilityThreshold' => .02,
        ]);
        //end chart


        ///


        $lavas = new Lavacharts; // See note below for Laravel

        $finances = $lavas->DataTable();
        $finances->addStringColumn('Servicio1')
            ->addNumberColumn('Servicio2');
        foreach($total_primer as $t)
        {
            $finances->addRow([ $t['nombre'], $t['total'] ]);
        }


        $lavas->ColumnChart('Finances', $finances, [
            'title' => 'Company Performance',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'colors' => ['blue','silver','gold']
        ]);

        return view('reportes/mensual_servicio_procesado', compact('total_primer', 'totalServicio_primer', 'fecha_inicio', 'fecha_fin', 'lava', 'lavas','tipo_incidentes'));


    }

    public function IncidenteReporte()
    {

        $fecha_1_a= ['2017-01-13','2017-01-14'];
        $fecha_1_b= ['2017-01-15','2017-01-16'];
        $servicios = $this->servicioRepo->getAll();

        $totalServicio_primer = $this->fichaRepo->r_num_incidentes($fecha_1_a);

        $totalServicio_segundo  = $this->fichaRepo->r_num_incidentes($fecha_1_b);
      //  dd($totalServicio);
        $i = 0;
        foreach($servicios as $servicio)
        {
            $total_primer[$i]['nombre'] = $servicio->nom_servicio;
            $total_primer[$i]['total'] = $this->fichaRepo->r_num_incidentes_servicio($servicio->id, $fecha_1_a);
            $porcentaje_primer = ($total_primer[$i]['total'] * 100) / $totalServicio_primer;
            $total_primer[$i]['porcentaje'] = $porcentaje_primer;

            $total_primer[$i]['nombre_segundo'] = $servicio->nom_servicio;
            $total_primer[$i]['total_segundo'] = $this->fichaRepo->r_num_incidentes_servicio($servicio->id, $fecha_1_b);

            if($totalServicio_segundo > 0)
            {
                $porcentaje_segundo = ($total_primer[$i]['total_segundo'] * 100) / $totalServicio_segundo;
            }else{
                $porcentaje_segundo = 0;
            }
            $total_primer[$i]['porcentaje_segundo'] = $porcentaje_segundo;

//            $total_segundo[$i]['nombre'] = $servicio->nom_servicio;
//            $total_segundo[$i]['total'] = $this->fichaRepo->r_num_incidentes_servicio($servicio->id, $fecha_1_b);
//            $porcentaje_segundo = ($total_segundo[$i]['total'] * 100) / $totalServicio_segundo;
//            $total_segundo[$i]['porcentaje'] = $porcentaje_segundo;
            $i++;
        }
       //dd($total);


        /// chart

        $lava = new Lavacharts;

        $reasons = $lava->DataTable();

        $reasons->addStringColumn('Servicio')
                ->addNumberColumn('I Trimestre')
                ->addNumberColumn('II Trimestre');

        foreach($total_primer as $t)
        {
            $reasons->addRow([$t['nombre'], $t['total'], $t['total_segundo']]);
        }

        $ColumnChart = $lava->ColumnChart('IMDB', $reasons, [
            'title' => 'INCIDENTES ADVEROS POR SERVICIO'
        ]);

        return view('reportes/cuadro_incidentes', compact('total_primer', 'totalServicio_primer', 'totalServicio_segundo','lava'));
    }


    public function mensualCategoria()
    {
        $tipoIncidentes = $this->tipoIncidenteRepo->getAll();
        $tipoIncidenteSelect = $tipoIncidentes->pluck('nom_incidente', 'id');
        return view('reportes/mensual_categoria', compact('tipoIncidenteSelect'));
    }

    public function procesarCategoriaMensual(procesarMensualCategoria $request)
    {
       // dd($request->all());
        $tipo_incidentes = $this->tipoIncidenteRepo->findOrFail($request->get('tipo_incidente_id'));
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');

        $categorias = $this->categoriaAdversoRepo->getCategoriasProblemas();

        $problemas = $this->problemaRepo->getProblemasCategoria();
        //dd($problemas);

        $i = 0;
        foreach($categorias as $key =>$categoria)
        {
            //dd($problema);
            foreach($categoria->problemas as $keyy => $problema)
            {
                $total_problemas = $this->fichaRepo->r_num_problemas_categoria($problema->id, $fecha_inicio, $fecha_fin, $request->get('tipo_incidente_id'));
                if($total_problemas > 0)
                {
                    $problema->total =$total_problemas;
                }else{
                    unset($categoria->problemas[$keyy]);
                }
          //  dd($problemas[$key]);
            }
        }
      //  dd($categorias);

        return view('reportes/mensual_categoria_procesado', compact('total', 'categorias','tipo_incidentes','fecha_fin', 'fecha_inicio'));
    }

    public function procesarConsolidado()
    {
        $categorias = $this->categoriaAdversoRepo->getCategoriasProblemas();
        $servicios = $this->servicioRepo->getAll();
        $tipo_incidentes = $this->tipoIncidenteRepo->getAll();
        $i=0;
        $j=0;

        foreach($categorias as $categoria)
        {
            foreach($categoria->problemas as $problema)
            {
                foreach($servicios as $servicio)
                {
                    foreach($tipo_incidentes as $tipo_incidente)
                    {
                        $total_incidente[$i][$j] = $this->fichaRepo->total_consolidado_incidente($categoria->id,$problema->id,$servicio->id,$tipo_incidente->id);
                        $j++;
                    }
                }
                $i++;
            }

        }
        return view('reportes/mensual_consolidado_procesado', compact('total_incidente', 'categorias', 'tipo_incidentes', 'servicios'));





    }

    public function mensualPersonal()
    {
        return view('reportes/mensual_personal');
    }

    public function procesarMensualPersonal(procesarMensualPersonal $request)
    {
        $personals = $this->personalRepo->getAll();
        $fecha_inicio = $request->get('fecha_inicio');
        $fecha_fin = $request->get('fecha_fin');

        $total = $this->fichaRepo->r_num_total_personals($fecha_inicio, $fecha_fin);


        foreach($personals as $personal)
        {
            $total_filtrado = $this->fichaRepo->r_num_personals($personal->id, $fecha_inicio, $fecha_fin);

            $personal->total = $total_filtrado;


            $porcentaje = ($total_filtrado * 100) / $total;
            $personal->porcentaje = $porcentaje;
        }
      //  dd($personals);

        $lava = new Lavacharts; // See note below for Laravel

        $finances = $lava->DataTable();
        $finances->addStringColumn('Servicio1')
            ->addNumberColumn('Personal');
        foreach($personals as $personal)
        {
            $finances->addRow([$personal->tip_personal, $personal->total]);
        }


        $lava->DonutChart('r_serv', $finances, [
            'title' => 'Reporte de Personal',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 16
            ],
            'pieSliceText' => 'percentage',
            'pieSliceTextStyle' => [
                'fontSize' => 18
            ],
            //'is3D' => true,
            'pieHole' => 0.4,
            'sliceVisibilityThreshold' => .02,
        ]);


        return view('reportes/mensual_personal_procesado', compact('personals', 'fecha_inicio', 'fecha_fin', 'total', 'lava'));

    }

    public function inicidenteEvento()
    {
        //$q->whereMonth('created_at', '=', date('m'));
        //dd(date('m'));
       // dd(config('options.meses'));
        $tipoIncidentes = $this->tipoIncidenteRepo->getAll();
        $tipoIncidenteSelect = $tipoIncidentes->pluck('nom_incidente', 'id');

        $servicios = $this->servicioRepo->getAll();
        $serviciosSelect = $servicios->pluck('nom_servicio', 'id');
        return view('reportes/incidente_evento', compact('tipoIncidenteSelect', 'serviciosSelect'));

    }


    public function incidenteEventoServicio(){

        $servicios = $this->servicioRepo->getAll();
        $meses = config('options.meses');
        foreach($servicios as $servicio)
        {
            foreach($meses as $clave => $valor)
            {
                if($clave <= date('m'))
                {
                    $incidentes[$servicio->id][$clave] = $this->fichaRepo->r_num_incidentes_eventos_servicio($clave, '1', $servicio->id);
                    $eventos[$servicio->id][$clave] = $this->fichaRepo->r_num_incidentes_eventos_servicio($clave, '2', $servicio->id);
                }
                $total_incidentes_meses[$clave] = $this->fichaRepo->total_num_incidentes_eventos_personal_mes($clave,'1');
                $total_eventos_meses[$clave] = $this->fichaRepo->total_num_incidentes_eventos_personal_mes($clave,'2');
            }
            $servicio->total_incidente = $this->fichaRepo->total_num_incidentes_eventos_servicio('1', $servicio->id);
            $servicio->total_evento = $this->fichaRepo->total_num_incidentes_eventos_servicio('2', $servicio->id);
        }
        $total_incidentes_consolidado = $this->fichaRepo->total_num_incidentes_eventos_personal_consolidado('1');
        $total_eventos_consolidado = $this->fichaRepo->total_num_incidentes_eventos_personal_consolidado('2');
        return view('reportes/incidente_evento_servicio', compact('incidentes', 'eventos', 'servicios', 'meses', 'total_incidentes_meses', 'total_eventos_meses', 'total_incidentes_consolidado','total_eventos_consolidado'));
    }

    public function incidenteEventoPersonal()
    {
        $personals = $this->personalRepo->getAll();
        $meses = config('options.meses');
        foreach($personals as $personal)
        {
            foreach($meses as $clave => $valor)
            {
                if($clave <= date('m'))
                {
                    $incidentes[$personal->id][$clave] = $this->fichaRepo->r_num_incidentes_eventos_personal($clave, '1', $personal->id);
                    $eventos[$personal->id][$clave] = $this->fichaRepo->r_num_incidentes_eventos_personal($clave, '2', $personal->id);
                }
                $total_incidentes_meses[$clave] = $this->fichaRepo->total_num_incidentes_eventos_personal_mes($clave,'1');
                $total_eventos_meses[$clave] = $this->fichaRepo->total_num_incidentes_eventos_personal_mes($clave,'2');
            }

            $personal->total_incidente = $this->fichaRepo->total_num_incidentes_eventos_personal('1', $personal->id);
            $personal->total_evento = $this->fichaRepo->total_num_incidentes_eventos_personal('2', $personal->id);
        }

        $total_incidentes_consolidado = $this->fichaRepo->total_num_incidentes_eventos_personal_consolidado('1');
        $total_eventos_consolidado = $this->fichaRepo->total_num_incidentes_eventos_personal_consolidado('2');

        return view('reportes/incidente_evento_personal', compact('incidentes','eventos', 'personals', 'meses', 'total_eventos_meses', 'total_incidentes_meses', 'total_incidentes_consolidado', 'total_eventos_consolidado'));

    }

    public function trimestralServicio()
    {
        $servicios = $this->servicioRepo->getAll();
        $serviciosSelect = $servicios->pluck('nom_servicio', 'id');

        $tipoIncidentes = $this->tipoIncidenteRepo->getAll();
        $tipoIncidenteSelect = $tipoIncidentes->pluck('nom_incidente', 'id');

        return view('reportes/trimestral_servicio', compact('serviciosSelect', 'tipoIncidenteSelect'));
    }

    public function procesarTrimestralServicio(Request $request)
    {
        $servicio_id = $request->get('servicio_id');
        $tipo_incidente_id = $request->get('tipo_incidente_id');
        $servicio = $this->servicioRepo->findOrFail($servicio_id);
        $tipo_incidente = $this->tipoIncidenteRepo->findOrFail($tipo_incidente_id);
        $primer_trimestre = ['2017-01-01', '2017-04-30'];
        $segundo_trimestre = ['2017-05-01', '2017-08-31'];
        $tercer_trimestre = ['2017-09-01', '2017-12-31'];
        $fichas_primer = $this->fichaRepo->r_ficha_servicio($servicio_id, $primer_trimestre, $tipo_incidente_id);
        if(date('Y-m-d') <=  '2017-08-31' or date('Y-m-d') >= '2017-05-01')
        {
            $fichas_segundo = $this->fichaRepo->r_ficha_servicio($servicio_id, $segundo_trimestre, $tipo_incidente_id);
        }
        if(date('Y-m-d') <=  '2017-12-31' or date('Y-m-d') >= '2017-09-01')
        {
            $fichas_tercer = $this->fichaRepo->r_ficha_servicio($servicio_id, $tercer_trimestre, $tipo_incidente_id);

        }

       // dd($fichas_primer);

        return view('reportes/trimestral_servicio_procesado', compact('servicio','tipo_incidente' , 'fichas_primer', 'fichas_segundo', 'fichas_tercer'));
    }


}
