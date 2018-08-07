@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Escolaridad.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Escolaridad</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="escolaridad">
						Escolaridad
						<input type="text" name="escolaridad" value="{{old('escolaridad')}}" class="form-control" placeholder="prescolar, primaria, etc...">
						{{ $errors -> first('escolaridad') }}
					</label>
					<label for="nomenclatura_grupos">
						Nomenclatura
						<input type="text" name="nomenclatura_grupos" value="{{old('nomenclatura_grupos')}}" class="form-control" placeholder="Presco, Prim, Sec, etc...">
						{{ $errors -> first('nomenclatura_grupos') }}
					</label>
					<label for="horario">
						Horario
						<input type="text" name="horario" value="{{old('horario')}}" class="form-control" placeholder="8 am a 12 pm">
						{{ $errors -> first('horario') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Escolaridad.index') }}" class="btn btn-primary">Regresar</a>
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