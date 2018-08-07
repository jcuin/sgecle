@extends('layout')

@section('contenido')
<form method="POST" id="registrar_planeacion" enctype="multipart/form-data" action="{{ route('Planeacion.store') }}">
	{!! csrf_field() !!}
	<input type="number" name="anual" value="1" hidden="hidden">
	<div class="container">
    <h1 align="center">Registro de Planeación Anual</h1>
    <div class="col-lg-12 well">
		<h3 align="center">
			Grupo
		</h3>
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="grupo">
					Grupo<br>
					<select name="grupo" id="grupo">
						<option value="0">Seleccione un Grupo</option>
						@foreach($grupos as $grupo)
							<option value="{{ $grupo -> id_grupo }}" @if(old('grupo') == $grupo -> id_grupo) selected @endif>{{ $grupo -> grupo}}	
							</option>	
						@endforeach
					</select>
					{{ $errors -> first('grupo') }}
					</label>
				</div>
				<div class="col-sm-6 form-group">
					<b>Periodo Actual: {{ $periodo_actual -> periodo -> periodo }}</b>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<h3 align="center">
			Planeaciones
		</h3>
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="archivo">
						Archivo
						<input type="file" name="archivo" value="{{old('archivo')}}">
						<span class="help-block">
							{{ $errors -> first('archivo') }}
						</span>
					</label>
				</div>
				<div class="col-sm-6 form-group">
					<label for="comentarios">
						Comentarios
						<textarea name="comentarios" id="comentarios" rows="4" cols="50" placeholder="Comentarios sobre la planeación">{{ old('comentarios') }}</textarea>	
						<span class="help-block">
							{{ $errors -> first('comentarios') }}
						</span>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<h3 align="center">
			Anexos
		</h3>
		<table id='tabla-anexos'>
			<tr>
				<td>
					<button class="delete_anexo pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-4 form-group">
								<label for="anexo">
									Archivo
									<input type="file" name="anexo[]">
									<span class="help-block">
										{{ $errors -> first('anexo[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-4 form-group">
								<label for="num_copias">
									Número de Copias Requeridas(s)
									<input type="number" name="num_copias[]" class="form-control" placeholder="# de copias">
									<span class="help-block">
										{{ $errors -> first('num_copias[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-4 form-group">
								<label for="fecha_de_uso2">
									Fecha de Utilización
									<input type="date" name="fecha_de_uso[]" id="fecha_de_uso" class="form-control" min="{{ date("Y-m-d") }}">
									<span class="help-block">
										{{ $errors -> first('fecha_de_uso[]') }}
									</span>
								</label>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
			<div class="col-sm-12 form-group">
				<a id="boton_anexos" class="btn btn-primary pull-right">Agregar Anexo</a>
			</div>
	</div>
	<div class="col-lg-12 well">
		<h3 align="center">
			Propuestas
		</h3>
		<div class="col-sm-12">
			<table id='tabla-propuestas'>
				<tr>
					<td>
						<button class="delete pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="propuesta">
									Archivo
									<input type="file" name="propuesta[]">
									<span class="help-block">
										{{ $errors -> first('propuesta[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-6 form-group">
								<label for="fecha_de_uso2">
									Fecha de Utilización
									<input type="date" name="fecha_de_uso2[]" class="form-control" min="{{ date("Y-m-d") }}">
									<span class="help-block">
										{{ $errors -> first('fecha_de_uso2[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-6 form-group">
								<label for="detalles">
									Observaciones
									<textarea name="detalles[]" id="detalles" rows="4" cols="50" placeholder="Observaciones de la propuesta..."></textarea>	
									{{ $errors -> first('detalles[]') }}
								</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="col-sm-12 form-group">
				<a id="boton_propuestas" class="btn btn-primary pull-right">Agregar Propuesta</a>
			</div>
		</div>
	</div>

	<div class="col-lg-12 well">
		<div class="row">
			<div class="form-group pull-right">
				<button type="submit" id="boton_registrar_planeacion" class="btn btn-primary">Enviar</button>
				<a href="{{ route('Planeacion.index') }}" class="btn btn-primary">Regresar</a>
			</div>
		</div>		
	</div>
</div>
</form>

<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="file"] {
    	width: 500px;
	}
	textarea {
		resize: none;
	}
</style>
<script>
	$(function(){
    // your logic here`enter code here`
		$('#boton_anexos').click(function() {
			var $tableBody = $('#tabla-anexos').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_anexo").show();
			$trNew.find(".delete_anexo").attr("id", "delete_anexo-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});

		$('#boton_propuestas').click(function() {
			var $tableBody = $('#tabla-propuestas').find("tbody");
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete").show();
			$trNew.find(".delete").attr("id", "delete-"+(Number($auxvalor)+1));
			nuevoId = 'archi-'+(Number($auxvalor)+1);
			$trNew.find(".arch").attr("id", nuevoId);
			$trLast.after($trNew);
		});

		$('#registrar_planeacion').submit(function() {
			valor = '';
			$("input[name='propuesta[]']").each( function(){
		  		if(this.value !== ''){
		  			idvar = this.id.split("-");
		  			idvar = idvar[1];
		  			valor = valor+idvar+'-';
		  			$('#resumen_propuestas').attr('value', valor);
		  		}
		 	});
		  	return true;
		});

		$('.delete').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});

		$('.delete_anexo').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
@endsection