<!DOCTYPE html>
<html>
	<head>
		<title>SGE_CLE</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- CSS -->
	    <link rel="stylesheet" href="{{ URL::asset('bootsnav-master/css/bootstrap.min.css') }}">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
	    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	    <link href="{{ URL::asset('bootsnav-master/css/animate.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('bootsnav-master/css/bootsnav.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('bootsnav-master/css/style.css') }}" rel="stylesheet">
	    <!--<link href="bootsnav-master/css/animate.css" rel="stylesheet">
	    <link href="bootsnav-master/css/bootsnav.css" rel="stylesheet">
	    <link href="bootsnav-master/css/style.css" rel="stylesheet">-->

	     <!-- Bootstrap CSS 
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    </head>

	<body>
		<!-- Start Navigation -->
    <nav class="navbar navbar-default navbar-sticky bootsnav">

        <div class="container">            
            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <!--li class="side-menu"><a href="#"><i class="fa fa-bars"></i></a></li-->
                    <li style="min-height: 78px;"></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->

            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('inicio') }}"><img src="{{ URL::asset('images/logo.png') }}" class="logo" alt="Colegio Fernández de Lizardi"></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                @guest
                @else 
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }}  <img width="20px" height="20px" src="{{ Storage::url(Auth::user()->photo) }}"> 
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="active"><a href="{{route('Panel.index')}}">Inicio</a></li>
                    <!--<li><a href="#">About Us</a></li>
                    <li class="dropdown megamenu-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Megamenu</a>
                        <ul class="dropdown-menu megamenu-content" role="menu">
                            <li>
                                <div class="row">
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Title Menu One</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- end col-3 -->
                                    <!--<div class="col-menu col-md-3">
                                        <h6 class="title">Title Menu Two</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- end col-3 -->
                                    <!--<div class="col-menu col-md-3">
                                        <h6 class="title">Title Menu Three</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div>    
                                    <div class="col-menu col-md-3">
                                        <h6 class="title">Title Menu Four</h6>
                                        <div class="content">
                                            <ul class="menu-col">
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                                <li><a href="#">Custom Menu</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- end col-3 -->
                                <!--</div><!-- end row -->
                            <!--</li>
                        </ul>
                    </li>-->
                    @if( auth() -> user() -> hasRoles(['dir_general']) )
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Catálogos</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Académico</a>
                                <ul class="dropdown-menu">
                                    @if( auth() -> user() -> hasRoles(['dir_general']) )
                                        <li><a href="{{ route('Escolaridad.index') }}">Escolaridades</a></li>
                                    @endif
                                    @if( auth() -> user() -> hasRoles(['dir_general','director']) )
                                        <li><a href="{{ route('Grupo.index') }}">Grupos</a></li>
                                        <li><a href="{{ route('Materia.index') }}">Materias</a></li>
                                        <li><a href="{{ route('Planeacion.index') }}">Planeaciones</a></li>
                                    @endif
                                    @if( auth() -> user() -> hasRoles(['dir_general']) )
                                        <li><a href="{{ route('Periodo.index') }}">Periodos</a></li>
                                    @endif    
                                    <!--<li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Sub Menu</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Custom Menu</a></li>-->
                                </ul>
                            </li>
                            @if( auth() -> user() -> hasRoles(['dir_general']) )
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Administrativo</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('Rol.index') }}">Roles</a></li>
                                    <!--<li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Sub Menu</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Custom Menu</a></li>-->
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Geográfico</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('Estado.index') }}">Estados</a></li>
                                    <li><a href="{{ route('Municipio.index') }}">Municipios</a></li>
                                    <li><a href="{{route('paginaEstadistica')}}">Estadísticas</a></li>
                                    <!--<li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Sub Menu</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Custom Menu</a></li>-->
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Otros</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('EstadoCivil.index') }}">Estados Civiles</a></li>
                                    <li><a href="{{ route('PrepAcademica.index') }}">Grados Académicos</a></li>
                                    <li><a href="{{ route('Parentesco.index') }}">Parentescos</a></li>
                                    <li><a href="{{ route('Religion.index') }}">Religiones</a></li>
                                    <li class="active"><a href="">Página</a></li>
                                    <li class="active"><a href="{{ route('Notificacion.index') }}">Notificaciones</a></li>
                                    <li class="active"><a href="{{ route('Planeacion.index') }}">Planeaciones</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Página</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('Pagina.index') }}">Configuración</a></li>
                                            <li><a href="{{route('paginaEstadistica')}}">Estadísticas</a></li>
                                            <!--<li><a href="#">Custom Menu</a></li>
                                            <li><a href="#">Custom Menu</a></li>-->
                                        </ul>
                                    </li>
                                    <!--<li><a href="#">Custom Menu</a></li>-->
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    
                    @if( auth() -> user() -> hasRoles(['dir_general','director']) )
                        <li class="active"><a href="{{ route('Alumno.index') }}">Alumnos</a></li>
                        <li class="active"><a href="{{ route('Trabajador.index') }}">Trabajadores</a></li>
                        <li class="active"><a href="{{ route('Inscripcion.index') }}">Grupos</a></li>
                        <li class="active"><a href="{{ route('Informe.index') }}">Informes - {{ Auth::user()->roles->count() }}</a></li>
                        <li class="active"><a href="{{ route('Agenda.index') }}">Calendario</a></li>
                    @endif
                    @if( auth() -> user() -> hasRoles(['profesor']) )
                        <li class="active"><a href="{{ route('Inscripcion.index') }}">Grupos</a></li>
                        <li class="active"><a href="{{ route('Planeacion.index') }}">Planeaciones</a></li>
                        <li class="active"><a href="{{ route('Calendario') }}">Calendario</a></li>
                    @endif
                </ul>
                @endguest
            </div><!-- /.navbar-collapse -->
        </div>   

        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <div class="widget">
                <h6 class="title">Custom Pages</h6>
                <ul class="link">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="{{ route('Estado.index') }}">Portfolio</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="widget">
                <h6 class="title">Additional Links</h6>
                <ul class="link">
                    <li><a href="#">Retina Homepage</a></li>
                    <li><a href="#">New Page Examples</a></li>
                    <li><a href="#">Parallax Sections</a></li>
                    <li><a href="#">Shortcode Central</a></li>
                    <li><a href="#">Ultimate Font Collection</a></li>
                </ul>
            </div>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->

    <div style="min-height: 350px;">
		@yield('contenido')
	</div>

	<!-- START JAVASCRIPT -->
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>

    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ URL::asset('bootsnav-master/js/bootstrap.min.js') }}"></script>
    
    <!-- Bootsnavs -->
    <script src="{{ URL::asset('bootsnav-master/js/bootsnav.js') }}"></script>
    <!--<script src="bootsnav-master/js/bootsnav.js"></script>-->

    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- App scripts -->
    @push('scripts')
    @stack('scripts')
    
    
<script>
	$(function () {
        $('#tablaEstado').DataTable({
            bJQueryUI: true,
            sPaginationType: "full_numbers",
            processing: true,
            serverSide: false,
            language: {
            	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        	},
            ajax: '{!! url('datatables') !!}',
            aoColumnDefs: [
		   		{
			        aTargets: [2],
			        mData: null,
			        mRender: function (data, type, full) {
			            return '<a class="Ver">Ver</a>';
			        }
		    	},
		    	{
			        aTargets: [3],
			        mData: null,
			        mRender: function (data, type, full) {
			            return '<a class="Editar">Editar</a>';
			        }
		    	},
		    	{
			        aTargets: [4],
			        mData: null,
			        mRender: function (data, type, full) {
			            return '<a class="Borrar">Borrar</a>';
			        }
		    	}

		 	],
            /*"columnDefs": [
            	{
                	"targets": [ 0 ],
                	"visible": false,
                	"searchable": false
            	}
        	],*/
            columns: [
                { data: 'id_estado', name: 'id_estado' },
            	{ data: 'estado', name: 'estado' }
            ]
        });
    });
	
	/*$('#tablaEstado').on( 'click', 'tbody tr', function () {
		
		//alert($(this).find('td:eq(0)').text());
		//alert($(this).first().text());
		alert($('tbody tr').find('td:eq(0)').text());
		//window.location.href = 'Estado/'+$(this).find('td:eq(0)').text()+'/edit';
	} );*/
	$('#tablaEstado').on( 'click', 'tbody tr td a', function () {
		link = $(this).closest('tr').find('td:eq(0)').text();
		clase = $(this).text();
		if( clase == 'Editar' ){
			$(this).attr('href','Estado/'+link+'/edit');
		}else if( clase == 'Borrar' ){
			if(confirm("¿Está seguro(a) de que desea borrar éste registro?")){
				$.ajax({
			    	url: '/Estado/'+link,
			    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			    	type: 'DELETE',
			    	statusCode: {
	    				405: function() {
	      					window.location.reload();
	    			  	}
	  				},
			    	success: function(result) {
			        	alert('Borrado con Éxito.');
			    	}
				});
			}
		}else{
    		$(this).attr('href','Estado/'+link);
		}
	} );
</script>
	</body>
</html>