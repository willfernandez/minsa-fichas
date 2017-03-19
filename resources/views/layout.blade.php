<!DOCTYPE html>
<html lang="en">
<head>
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pageTitle', 'Minsa') - Sistema de Incidentes y Eventos</title>

    <!-- Latest compiled and minified CSS -->
    {{--{!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}--}}
    {!! Html::style('bower_components/bootstrap-material-design/dist/bootstrap-material-design.min.css') !!}
    {{--{!! Html::style('css/menu.css') !!}--}}

            <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto+Slab:300,700' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body >
<div id="notifications"></div>
<div id="app">

    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:void(0)">Menú</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li>Paciente</li>
                    <li><a href="{!!route('pacientes.listado') !!}">Buscar Paciente</a></li>
                    
                </ul>
                <ul class="nav navbar-nav">
                    <li>Reportes</li>
                    <li><a href="{!! route('reportes.mensual_categoria') !!}">X Categoria</a></li>
                    <li><a href="{!! route('reportes.mensual_personal') !!}">X Personal</a></li>
                    <li><a href="{!! route('reportes.mensual_servicio') !!}">X Servicio</a></li>
                    
                </ul>
            </div>
        </div>
    </div>

    @yield('content')
</div>


<!-- Scripts -->
<!-- Latest compiled and minified JavaScript -->
{!! Html::script('js/app.js') !!}


</body>
</html>