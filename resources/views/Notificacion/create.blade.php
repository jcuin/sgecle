@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Notificacion.store') }}">
	{!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Notificaciones</h1>
	    <input type="text" name="id_periodo" id="id_periodo" hidden="hidden" value="{{ $periodo_actual }}">
	    <input type="text" name="id_trabajador" id="id_trabajador" hidden="hidden" value="{{ $trabajador_emisor }}">
	    <input type="text" name="id_rol" id="id_rol" hidden="hidden" value="{{ $usuario -> roles[0] -> rol_key }}">
	    <input type="text" name="escolaridad" id="escolaridad" hidden="hidden" value="{{ $id_escolaridad }}-{{ $escolaridad }}">
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="mensaje">
						Mensaje<br>
						<textarea name="mensaje" id="mensaje" rows="4" cols="50" placeholder="Escriba aquí su mensaje...">{{ old('mensaje') }}</textarea>	
						{{ $errors -> first('mensaje') }}
					</label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="caducidad">
						Caducidad del Mensaje<br>
						<input type="date" name="caducidad" id="caducidad" value="{{ old('caducidad') }}" min="{{ date("Y-m-d") }}">	
						{{ $errors -> first('caducidad') }}
					</label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="destinatario">
						Destinatario<br>
						<select name="destinatario" id="destinatario">
							<option value="0" @if(old('destinatario') == 0 ) selected @endif>Seleccione una opción</option>
							@if( substr( $usuario -> roles[0] -> rol_key , 0, 4 ) === "dir_" ) )
								<option value="1" @if(old('destinatario') == 1 ) selected @endif>Grupo</option>
								<option value="2" @if(old('destinatario') == 2 ) selected @endif>Alumno</option>
								<option value="3" @if(old('destinatario') == 3 ) selected @endif>Trabajador</option>
								<option value="4" @if(old('destinatario') == 4 ) selected @endif>Rol</option>
							@endif
							@if( substr( $usuario -> roles[0] -> rol_key , 0, 4 ) === "dire" ) )
								<option value="1" @if(old('destinatario') == 1 ) selected @endif>Grupo</option>
								<option value="2" @if(old('destinatario') == 2 ) selected @endif>Alumno</option>
								<option value="3" @if(old('destinatario') == 3 ) selected @endif>Trabajador</option>
							@endif
							@if( substr( $usuario -> roles[0] -> rol_key , 0, 4 ) === "prof" ) )
								<option value="1" @if(old('destinatario') == 1 ) selected @endif>Grupo</option>
								<option value="2" @if(old('destinatario') == 2 ) selected @endif>Alumno</option>
							@endif
						</select>
							{{ $errors -> first('destinatario') }}
					</label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row" align="center" id='contenedor_trabajadores' style="display: none;">
					<label for="trabajadores">
						Trabajadores<br>
						<select multiple id="trabajadores" name="trabajadores[]">
						</select> 
					</label>
				</div>
				<div class="row" align="center">
					<label for="grupos" id='contenedor_grupos' style="display: none;">
						Grupos<br>
						<select multiple id="grupos" name="grupos[]">
						</select> 
					</label>
				</div>
				<div class="row" align="center" id='contenedor_alumnos' style="display: none;">
					<label for="alumnos">
						Alumnos<br>
						<select multiple id="alumnos" name="alumnos[]">	
						</select> 
					</label>
					<p>
						<input type="checkbox" name="copiar_maestro" id="copiar_maestro" value="1" @if(old('copiar_maestro')==1) checked @endif>Copiar al maestro(a)<br>
					</p>
				</div>
				<div class="row" align="center" id='contenedor_trabajadores2' style="display: none;">
					<label for="trabajadores">
						Trabajadores<br>
						<select multiple id="trabajadores2" name="trabajadores2[]">
						</select> 
					</label>
				</div>
				<div class="row" align="center" id='contenedor_roles' style="display: none;">
					<label for="roles">
						Roles<br>
						<select multiple id="roles" name="roles[]">	
						</select> 
					</label>
				</div>
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
<script>
	$(document).ready(function(){
		var destinatario = $('#destinatario').val();
		var periodo_actual = $('#id_periodo').val();
		var trabajador = $('#id_trabajador').val();
		var rol = $('#id_rol').val();
		var escolaridad = $('#escolaridad').val();
		if(destinatario == 0){
			esconderCombos();
		}
		if(destinatario == 1){
			$.get('/ajax-getGruposDeTrabajador?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
				esconderCombos();
				$('#contenedor_grupos').show();
				$.each(data, function(index, grupo){
					$('#grupos').append('<option value="'+grupo.id_grupo+'-'+grupo.id_materia+'">'+grupo.grupo+' - '+grupo.materia+'</option>');
				});
			});
		}
		if(destinatario == 2){
			if($('#copiar_maestro').is(':checked')){
				$.get('/ajax-getTrabajadores?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
					$('#contenedor_alumnos').show();
					$('#alumnos').show();
					$('#contenedor_trabajadores2').show();
					$('#trabajadores2').show();
					$.each(data, function(index, trabajador){
						$('#trabajadores2').append('<option value="'+trabajador.id_trabajador+'">'+trabajador.nombre+' '+trabajador.a_paterno+' '+trabajador.a_materno+'</option>');
					});
				});
			}else{
				$('#contenedor_alumnos').show();
				$('#alumnos').show();
				$('#contenedor_trabajadores2').hide();
				$('#trabajadores2').empty();
				$('#trabajadores2').hide();
			}
			$.get('/ajax-getAlumnosDeTrabajador?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
				esconderCombos();
				$('#contenedor_alumnos').show();
				$('#alumnos').show();
				$.each(data, function(index, alumno){
					$('#alumnos').append('<option value="'+alumno.id_alumno+'">'+alumno.nombre+' '+alumno.a_paterno+' '+alumno.a_materno+'</option>');
				});
			});
		}
		if(destinatario == 3){
			$.get('/ajax-getTrabajadores?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
				esconderCombos();
				$('#contenedor_trabajadores').show();
				$('#trabajadores').show();
				$.each(data, function(index, trabajador){
					$('#trabajadores').append('<option value="'+trabajador.id_trabajador+'">'+trabajador.nombre+' '+trabajador.a_paterno+' '+trabajador.a_materno+'</option>');
				});
			});
		}
		if(destinatario == 4){
			$.get('/ajax-getRoles?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
				esconderCombos();
				$('#contenedor_roles').show();
				$('#roles').show();
				$.each(data, function(index, rol){
					$('#roles').append('<option value="'+rol.id_rol+'">'+rol.rol+'</option>');
				});
			});
		}			
	});

	
	$(function(){
    // your logic here`enter code here`
		$('#destinatario').on('change', function(e){
			var destinatario = e.target.value;
			var periodo_actual = $('#id_periodo').val();
			var trabajador = $('#id_trabajador').val();
			var rol = $('#id_rol').val();
			var escolaridad = $('#escolaridad').val();
			if(destinatario == 0){
				esconderCombos();
			}
			if(destinatario == 1){
				$.get('/ajax-getGruposDeTrabajador?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
					esconderCombos();
					$('#contenedor_grupos').show();
					$.each(data, function(index, grupo){
						$('#grupos').append('<option value="'+grupo.id_grupo+'-'+grupo.id_materia+'">'+grupo.grupo+' - '+grupo.materia+'</option>');
					});
				});
			}
			if(destinatario == 2){
				esconderCombos();
				$.get('/ajax-getAlumnosDeTrabajador?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
					esconderCombos();
					$('#contenedor_alumnos').show();
					$('#alumnos').show();
					$.each(data, function(index, alumno){
						$('#alumnos').append('<option value="'+alumno.id_alumno+'">'+alumno.nombre+' '+alumno.a_paterno+' '+alumno.a_materno+'</option>');
					});
				});
				$('#copiar_maestro').click(function() {
					if(this.checked){
						$.get('/ajax-getTrabajadores?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
							$('#contenedor_trabajadores2').show();
							$('#trabajadores2').show();
							$.each(data, function(index, trabajador){
								$('#trabajadores2').append('<option value="'+trabajador.id_trabajador+'">'+trabajador.nombre+' '+trabajador.a_paterno+' '+trabajador.a_materno+'</option>');
							});
						});
					}else{
						$('#contenedor_alumnos').show();
						$('#alumnos').show();
						$('#contenedor_trabajadores2').hide();
						$('#trabajadores2').empty();
						$('#trabajadores2').hide();
					}
				});
			}
			if(destinatario == 3){
				$.get('/ajax-getTrabajadores?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
					esconderCombos();
					$('#contenedor_trabajadores').show();
					$('#trabajadores').show();
					$.each(data, function(index, trabajador){
						$('#trabajadores').append('<option value="'+trabajador.id_trabajador+'">'+trabajador.nombre+' '+trabajador.a_paterno+' '+trabajador.a_materno+'</option>');
					});
				});
			}
			if(destinatario == 4){
				$.get('/ajax-getRoles?id_periodo='+periodo_actual+'&id_trabajador='+trabajador+'&id_rol='+rol+'&escolaridad='+escolaridad, function(data){
					esconderCombos();
					$('#contenedor_roles').show();
					$('#roles').show();
					$.each(data, function(index, rol){
						$('#roles').append('<option value="'+rol.id_rol+'">'+rol.rol+'</option>');
					});
				});
			}
		});
	});

	function esconderCombos(){
		$('#grupos').empty();
		$('#contenedor_grupos').hide();
		$('#alumnos').empty();
		$('#contenedor_alumnos').hide();
		$('#trabajadores').empty();
		$('#contenedor_trabajadores').hide();
		$('#trabajadores2').empty();
		$('#contenedor_trabajadores2').hide();
		$('#roles').empty();
		$('#contenedor_roles').hide();
	}
</script>
@endsection