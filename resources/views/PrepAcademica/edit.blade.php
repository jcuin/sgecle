@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('PrepAcademica.update', $prepacademica -> id_prep_academica)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Grado Académico</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="grado_academico">
						Grado Académico
						<input type="text" name="grado_academico" value="{{$prepacademica -> grado_academico}}" class="form-control" placeholder="Primaria, Secundaria, etc...">
						{{ $errors -> first('grado_academico') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('PrepAcademica.index') }}" class="btn btn-primary">Regresar</a>
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