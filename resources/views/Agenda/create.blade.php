@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Agenda.store') }}">
	{!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Eventos</h1>
		<div class="col-lg-12 well">
			<div class="row" align="center">
			<table class='tabla-evento'>
				<tr id="evento">
					<td>
						<button class="delete_evento pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
						<input type="text" name="evento_oculto[]" id="evento_oculto" class="oculto" value="0" hidden="hidden">
						<div class="col-lg-12">
							<div class="row" align="center">
								<label for="evento">
									Evento<br>
									<input type="text" name="evento[]" id="evento" value="{{ old('evento[]') }}">
									{{ $errors -> first('evento[]') }}
								</label> 
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row" align="center">
								<label for="descripcion">
									Descripcion<br>
									<textarea name="descripcion[]" id="descripcion" rows="4" cols="50" placeholder="Describa aquí su evento...">{{ old('descripcion[]') }}</textarea>	
									{{ $errors -> first('descripcion[]') }}
								</label>
							</div>
							<div class="row" align="center">
								<label for="fecha_evento">
									Fecha del Evento<br>
									<input type="date" name="fecha_evento[]" id="fecha_evento" value="{{ old('fecha_evento[]') }}" min="{{ date("Y-m-d") }}">	
									{{ $errors -> first('fecha_evento[]') }}
								</label>
							</div>
							<div class="row" align="center">
								<label for="hora_inicio">
									Hora de Incio<br>
									<input type="time" name="hora_inicio[]" id="hora_inicio" value="{{ old('hora_inicio[]') }}">	
									{{ $errors -> first('hora_inicio[]') }}
								</label>
								<label for="hora_fin">
									Hora de Término<br>
									<input type="time" name="hora_fin[]" id="hora_fin" value="{{ old('hora_fin[]') }}">	
									{{ $errors -> first('hora_fin[]') }}
								</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-sm-4 form-group pull-right">
			<a id="boton_evento" class="btn btn-primary">Agregar Evento</a>
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
		$('#boton_evento').click(function() {
			var $tableBody = $('.tabla-evento').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_evento").show();
			$trNew.find(".delete_evento").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});

		$('.delete_evento').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
@endsection