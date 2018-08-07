@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Inscripcion.store')}}">
	{!! csrf_field() !!}
	Grupo<br>
	{{ $grupo -> grupo}}
	
		
	
</form>
<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary">Regresar</a>
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection