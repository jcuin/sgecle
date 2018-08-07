@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Rol.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Roles</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="rol_key">
					Palabra Clave 
						<input type="text" name="rol_key" value="{{old('rol_key')}}" class="form-control" placeholder="Dirección, docencia, intendencia, etc...">
						{{ $errors -> first('rol_key') }}
					</label>
					<label for="rol">
					Rol
						<input type="text" name="rol" value="{{old('rol')}}" class="form-control" placeholder="Dirección, docencia, intendencia, etc...">
						{{ $errors -> first('rol') }}
					</label>
				</div>
				<div class="row" align="center">
					<label for="descripcion">
					Descripción de sus Funciones 
						<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Director de sección...">
						{{ $errors -> first('descripcion') }}
					</label>
				</div>
				
			</div>
		<!--/div>
		<!--<div class="col-lg-12 well">
		<h3 align="center">
			Permisos
		</h3>
		<div class="row">
			<div class="col-sm-2 form-group">
				<label for="alumno">
				Alumnos<br>
					<input type="checkbox" name="permisos_alumno" value="1" @if( 1 == 1 ) checked @endif>Agrega<br>
					<input type="checkbox" name="permisos_alumno" value="1" @if( 1 == 1 ) checked @endif>Elimina<br>
					<input type="checkbox" name="permisos_alumno" value="1" @if( 1 == 1 ) checked @endif>Edita<br>
					<input type="checkbox" name="permisos_alumno" value="1" @if( 1 == 1 ) checked @endif>Consulta
				</label>
			</div>
			<div class="col-sm-2 form-group">
				<label for="trabajador">
				Trabajadores<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Agrega<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Elimina<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Edita<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Consulta
				</label>
			</div>
			<div class="col-sm-2 form-group">
				<label for="trabajador">
				Trabajadores<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Agrega<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Elimina<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Edita<br>
					<input type="checkbox" name="permisos_trabajador" value="1" @if( 1 == 1 ) checked @endif>Consulta
				</label>
			</div>
		</div>-->
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Rol.index') }}" class="btn btn-primary">Regresar</a>
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
@endsection