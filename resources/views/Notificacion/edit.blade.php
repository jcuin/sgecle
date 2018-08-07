@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Notificacion.update', $notificacion -> id_notificacion) }}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Notificaciones</h1>
	    <input type="text" name="id_periodo" id="id_periodo" hidden="hidden" value="{{ $periodo_actual }}">
	    <input type="text" name="id_trabajador" id="id_trabajador" hidden="hidden" value="{{ $trabajador_emisor }}">
	    <input type="text" name="id_rol" id="id_rol" hidden="hidden" value="{{ $usuario -> roles[0] -> rol_key }}">
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="mensaje">
						Mensaje<br>
						<textarea name="mensaje" id="mensaje" rows="4" cols="50" placeholder="Escriba aquí su mensaje...">{{ $notificacion -> mensaje }}</textarea>	
						{{ $errors -> first('mensaje') }}
					</label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="caducidad">
						Caducidad del Mensaje<br>
						<input type="date" name="caducidad" id="caducidad" value="{{ $notificacion -> caducidad }}">	
						{{ $errors -> first('caducidad') }}
					</label>
				</div>
			</div>
			<div class="row">
                  <h3 class="panel-title" id="titulo-padres" align="center">
                    Para: <br>
                    @if( $notificacion -> grupo != null )
                      Grupo: {{ $notificacion -> grupo -> grupo }} - {{ $notificacion -> materia -> materia }}<br>
                    @elseif( $notificacion -> alumno != null )
                      Alumn@: {{ $notificacion -> alumno -> nombre }} {{ $notificacion -> alumno -> a_paterno }} {{ $notificacion -> alumno -> a_materno }}<br>
                    @elseif($notificacion -> trabajador != null )
                      Trabajador@: {{ $notificacion -> trabajador -> nombre }} {{ $notificacion -> trabajador -> a_paterno }} {{ $notificacion -> trabajador -> a_materno }}<br>
                    @endif
                  </h3>
            </div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Notificacion.index') }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
	textarea {
    	resize: none;
	}
</style>
@endsection