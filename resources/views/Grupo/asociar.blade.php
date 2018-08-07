@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('GrupoGuardar') }}">
	{!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Asociación de Materias</h1>
		<div class="col-lg-12 well" align="center">
			<label for="id_periodo">
				<h4>Grupo {{ $grupo -> grupo }}
				De {{ $grupo -> escolaridad -> escolaridad }}
				Perteneciente al Periodo
				{{ $grupo -> periodo -> periodo }}</h4>
					</label>
			<div class="col-sm-12">
				<div class="row">
					<input type="text" name="id_grupo" value="{{$grupo -> id_grupo}}" hidden="">
						<label for="id_materia">
							<table>
							Seleccione Materias Disponibles y Quien(es) la(s) Impartirá(n)<br>
							<?php $seleccionado = false ?>
							@foreach($materias as $materia)
								<tr>
									<td><input type="checkbox" name="materias[]" id="materia-{{ $materia -> id_materia }}" value="{{ $materia -> id_materia }}"
								{{ $grupo -> materias -> pluck('id_materia') -> contains($materia -> id_materia) ? 'checked' : '' }}
								> {{ $materia -> materia }}
									</td>
									<td>
										<select name="trabajadores[]" id="id_trabajador">
											<option value="0">Seleccione un Profesor</option>
											@foreach($trabajadores as $trabajador)
												@for($i = 0; $i < count($profesores_asignados); $i++)
													@if($materia -> id_materia == $profesores_asignados[$i] -> id_materia && $profesores_asignados[$i] -> id_trabajador == $trabajador -> id_trabajador)
														<?php $seleccionado = true; ?>
													@endif
												@endfor
												<option value="{{ $trabajador -> id_trabajador }}" @if($seleccionado) selected @endif id='trabajador-{{ $trabajador -> id_trabajador }}'>{{ $trabajador -> nombre }}{{ $trabajador -> a_paterno }}{{ $trabajador -> a_materno }}
												</option>
												<?php $seleccionado = false; ?>
											@endforeach
										</select>
									</td>
								</tr>
							@endforeach
							</table>
						</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Grupo.index') }}" class="btn btn-primary">Regresar</a>
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
</style>
<script>
	$(function(){
    	$('#es_empleado').click(function() {
			if(this.checked){
				deshabilitarConyuge();
				$("#id_conyuge").val('0');
				$("#conyuges").hide();
			}else{
				habilitarConyuge();
				$("#contenedor_conyuge").show();
				$("#conyuges").show();	
				$.get('/ajax-getMaxTrabajador', function(data){
						$("#id_conyuge").val(data);
				});
			}
		});

		$('#sin_experiencia').click(function() {
			if(this.checked){
				deshabilitarAntecedentes();
			}else{
				habilitarAntecedentes();
			}
		});

		
	});
</script>
@endsection