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


}
