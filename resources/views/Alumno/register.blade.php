@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('AlumnoRegistered') }}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Alumnos en Grupo</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<input type="text" name="id_alumno" value="{{ $alumno -> id_alumno }}" hidden="hidden">
					<input type="text" name="id_periodo" id="id_periodo" value="{{ $periodo[0] -> id_periodo }}" hidden="hidden">
					<input type="text" name="ya_inscrito" value="{{ $ya_inscrito }}" hidden="hidden">
					<label for="periodo">
					Periodo Vigente 
						<h3>{{ $periodo[0] -> periodo }}</h3>
					</label>
				</div>
			</div>
			<div class="row" align="center">
					@if($ya_inscrito == true)
						<div class="col-sm-12">
						<h3>Alumno ya inscrito en el grupo: {{ $periodo_inscrito[0] -> grupo}}</h3><br>
							<input type="submit" value="Dar de Baja" class="btn btn-primary pull-right">
							<a href="{{ route('Alumno.index') }}" class="btn btn-primary pull-right" >Regresar</a> 						
					@else
					<div class="col-sm-6 form-group">
						<label for="escolaridad">
							Escolaridad<br>
							<select name="id_escolaridad" id="id_escolaridad">
								<option value="0">Seleccione una Escolaridad</option>
								@foreach($escolaridades as $escolaridad)
									<option value="{{ $escolaridad -> id_escolaridad }}" @if(old('id_escolaridad') == $escolaridad -> id_escolaridad) selected @endif>{{ $escolaridad -> escolaridad}}	
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_escolaridad') }}
							</label>
				</div>
				<div class="col-sm-6 form-group">
					<label for="grupo">
					Grupo<br>
						<select name="id_grupo" id="id_grupo">
							<option value="0">Seleccione un Grupo</option>
							@foreach($grupos as $grupo)
								<option value="{{ $grupo -> id_grupo }}" @if(old('id_grupo') == $grupo -> id_grupo) selected @endif>{{ $grupo -> grupo}}	
								</option>	
							@endforeach
						</select>
						{{ $errors -> first('id_grupo') }}
						</label>
				</div>
			</div>
				<div class="row">
					<div class="form-group pull-right">
						<input type="submit" value="Enviar" class="btn btn-primary">
						<a href="{{ route('Alumno.index') }}" class="btn btn-primary">Regresar</a>
					@endif
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
	$('#id_escolaridad').on('change', function(e){
		var periodo = $('#id_periodo').val();
		var escolaridad = e.target.value;
		$.get('/ajax-getGrupo?id_periodo='+periodo+'&id_escolaridad='+escolaridad, function(data){
			$('#id_grupo').empty();
			$('#id_grupo').append('<option value="0">Seleccione un Grupo</option>');
			$.each(data, function(create, grupo){
				$('#id_grupo').append('<option value="'+grupo.id_grupo+'">'+grupo.grupo+'</option>');
			});
		});
	});
</script>
@endsection