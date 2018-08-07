@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Grupo.update', $grupo -> id_grupo)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<p><label for="grupo">
		Estado Civil
		<input type="text" name="grupo" value="{{$grupo -> grupo}}" class="form-control" placeholder="soltero, casado, etc...">
		{{ $errors -> first('grupo') }}
	</label></p>
	<p><label for="capacidad">
		Capacidad
		<input type="text" name="capacidad" value="{{$grupo -> capacidad}}" class="form-control" placeholder="15, 20, etc...">
		{{ $errors -> first('capacidad') }}
	</label></p>
	<p>
		<input type="submit" value="Enviar" class="btn btn-primary">
	</p>
</form>
<a href="{{ route('Grupo.index') }}" class="btn btn-primary">Regresar</a>
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection