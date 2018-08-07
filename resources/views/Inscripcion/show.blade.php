@extends('layout')

@section('contenido')
	<h3>
		Inscribir Alumnos al Grupo: {{ $grupo -> grupo}}<br>
	</h3>
	Y sus Materias: <br>
		@foreach($materias as $materia)
			{{ $materia -> materia}} <br>
		@endforeach
		<br>
	<form method="POST" action="{{ route('Inscripcion.store', $grupo -> id_grupo)}}">
	 	{!! csrf_field() !!}
		<input type="text" name="grupo" value="{{$grupo -> id_grupo}}" hidden="">
		<p id="alumnos">
	 	@foreach($inscripciones as $inscripcion)
			<input type="checkbox" name="alumnos[]" checked="checked" value="{{ $inscripcion -> alumno -> id_alumno}}"> {{$inscripcion -> alumno -> nombre}} {{ $inscripcion -> alumno -> a_paterno }} {{ $inscripcion -> alumno -> a_materno}} <br>
		@endforeach

	 	@foreach($alumnos as $alumno)
			<input type="checkbox" name="alumnos[]" value="{{ $alumno -> id_alumno}}"
			{{ $alumno -> inscripciones() -> pluck('id_alumno') -> contains($alumno -> id_alumno) ? 'checked' : '' }}
			> {{$alumno -> nombre}} {{ $alumno -> a_paterno }} {{ $alumno -> a_materno}} <br>
		@endforeach	
		</p>
		<button type="submit" class="btn btn-primary">Inscribir</button>
	</form>
	<!--<a href="{{ route('Inscripcion.edit', $grupo-> id_grupo)}}" class="btn btn-primary">Editar</a>-->
	<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary">Regresar</a>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection