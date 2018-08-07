@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Rol.update', $rol -> id_rol)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Rol</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="rol_key">
						Rol
						<input type="text" name="rol_key" value="{{$rol -> rol_key}}" class="form-control" placeholder="Dirección, docencia, intendencia, etc...">
						{{ $errors -> first('rol_key') }}
					</label>
					<label for="rol">
						Rol
						<input type="text" name="rol" value="{{$rol -> rol}}" class="form-control" placeholder="Dirección, docencia, intendencia, etc...">
						{{ $errors -> first('rol') }}
					</label>
					<label for="descripcion">
						Funciones
						<input type="text" name="descripcion" value="{{$rol -> descripcion}}" class="form-control" placeholder="Dirección, docencia, intendencia, etc...">
						{{ $errors -> first('descripcion') }}
					</label>
				</div>
			</div>
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