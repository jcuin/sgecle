@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h2 class="panel-title" align="center">Bienvenido(a) {{ Auth::user()->name }}</h2>
            </div>
            <div class="panel-body">
              	<div class="row">
                  @if( count($mensajes_roles) > 0 || count($mensajes_individuales) > 0 )
                   <h2 class="panel-title" align="center">Avisos Vigentes</h2>
                  @endif
                  @if($mensajes_roles != null) 
                      @foreach($mensajes_roles as $mensaje_rol)
                        <strong>
                          <div class="alert alert-warning alert-dismissable fade in">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <i>{{ $mensaje_rol -> nombre }} {{ $mensaje_rol -> a_paterno }} te ha notificado que:</i><br> {{ $mensaje_rol -> mensaje }}
                             <div align="right" style="font-size: 10px;"><i>Mensaje grupal</i></div>
                          </div>
                        </strong>
                      @endforeach
                    @endif
                    @if($mensajes_individuales != null)
                      @foreach($mensajes_individuales as $mensaje_individual)
                        <strong>
                          <div class="alert alert-success alert-dismissable fade in">
                              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <i>{{ $mensaje_individual -> emisor -> nombre }} te ha notificado que: </i><br>{{ $mensaje_individual -> mensaje }}
                             <div align="right" style="font-size: 10px;"><i>Mensaje individual</i></div>
                          </div>
                        </strong>
                      @endforeach
                    @endif
                </div>
                <div class="row">
                	<h2 class="panel-title" align="center">Matrícula Registrada</h2>
                	<h3 align="center">{{ $matricula -> inscritos }}</h3>
              	</div>
              	<div class="row">
                  @if($periodo != null)
                	   <h2 class="panel-title" align="center">Grupos en el Periodo {{ $periodo -> periodo}}</h2>
                     <h3 align="center">{{ $grupos -> grupos }}</h3>
                  @else
                      <h2 class="panel-title" align="center">No existe periodo activo</h2>
                  @endif
              	</div>
              	<div class="row">
                	<h2 class="panel-title" align="center">Colaboradores</h2>
                	<h3 align="center">{{ $colaboradores -> trabajadores }}</h3>
              	</div>
            </div>
            <div class="panel-footer" align="center">  
              <a href="{{ route('Setting.index') }}" class="btn btn-primary">Modificar Configuración</a>      
            </div>       
          </div>
        </div>
    </div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.panel-heading {
  		background-color: #20193D !important;
	}
	.panel-title {
		color: #D10F20 !important;
	}
</style>
@endsection