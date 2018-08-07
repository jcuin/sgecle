@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updatePlaneacion')}}" id="registrar_planeacion" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="id_planeacion" value="{{ $planeacion -> id_planeacion }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Planeaciones</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Planeación
			</h3> 
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-6 form-group">
						<label for="semana">
						Semana<br>
						<select name="semana" id="semana">
							<option value="0">Seleccione un Semana</option>
							<?php 
							$start_date = $semanas -> inicio;
							$end_date = $semanas -> termino;
							$next_date = $start_date;
							$i = 1;
		      				while(strtotime($next_date) <= strtotime($end_date))
							{
							?>
							    <option value="{{ $next_date }}" @if($planeacion -> semana == $next_date) selected @endif>Semana {{ $i }} - Del {{ $next_date }} Al: {{ date ("Y-m-d", strtotime("+ 5 day", strtotime($next_date))) }}</option>
							    <?php 
							    	$next_date = date ("Y-m-d", strtotime("+ 7 day", strtotime($next_date))); 
							    	$i++;
							    ?>
							<?php
							}
							?>
						</select>
						{{ $errors -> first('semana') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-group">
						<?php 
							$archivo = explode('/',Storage::url($planeacion -> archivo));
							$archivo = end($archivo);
						?>
						Archivo Actual: <b>{{ $archivo }}</b>
						<br>
						<a href="{{ route('downloadFile', $planeacion -> id_planeacion.'-1') }}" class="btn btn-primary">Descargar</a>
	                	<br><br>
						<label for="archivo">
						Nuevo Archivo de la Planeación
							<input type="file" name="archivo" id="{{ $planeacion -> id_planeacion }}">
							{{ $errors -> first('archivo') }}
						</label>
						<label for="comentarios">
						Comentarios
							<textarea name="comentarios" id="comentarios" rows="4" cols="50" placeholder="Comentarios sobre la planeación">{{ $planeacion -> comentarios }}</textarea>	
							<span class="help-block">
								{{ $errors -> first('comentarios') }}
							</span>
						</label>
					</div>					
				</div>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Planeacion.show', $planeacion -> id_planeacion) }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
    	
	});
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
	tr:nth-child(even) {background: #CCC}
	tr:nth-child(odd) {background: #FFF}
</style>
@endsection