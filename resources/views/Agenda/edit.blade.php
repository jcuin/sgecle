@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Agenda.update', $evento -> id_agenda) }}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Eventos</h1>
		<div class="col-lg-12 well">
			<div class="row" align="center">
			<table class='tabla-evento'>
				<tr id="evento">
					<td>
						<div class="col-lg-12">
							<div class="row" align="center">
								<label for="evento">
									Evento<br>
									<input type="text" name="evento" id="evento" value="{{ $evento -> evento }}">
									{{ $errors -> first('evento') }}
								</label> 
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row" align="center">
								<label for="descripcion">
									Descripcion<br>
									<textarea name="descripcion" id="descripcion" rows="4" cols="50" placeholder="Describa aquí su evento...">{{ $evento -> descripcion }}</textarea>	
									{{ $errors -> first('descripcion') }}
								</label>
							</div>
							<div class="row" align="center">
								<label for="fecha_evento">
									Fecha del Evento<br>
									<input type="date" name="fecha_evento" id="fecha_evento" value="{{ $evento -> fecha_evento }}" min="{{ date("Y-m-d") }}">	
									{{ $errors -> first('fecha_evento') }}
								</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<button type="submit" id="boton_registrar_alumno" class="btn btn-primary">Enviar<i class="fa fa-paper-plane-o ml-2"></i></button>
					<a href="{{ route('Agenda.index') }}" class="btn btn-primary">Regresar</a>
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
<script>
	$(document).ready(function(){
	});
</script>
@endsection