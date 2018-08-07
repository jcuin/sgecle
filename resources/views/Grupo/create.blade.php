@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Grupo.store') }}">
	{!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Grupo</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="id_periodo">
						Periodo<br>
						{{ $periodo -> periodo }}	
					</label>
					<label for="id_escolaridad">
						Escolaridad<br>
						<select name="id_escolaridad">
							<option value="0">Seleccione una Escolaridad</option>
							<@foreach($escolaridades as $escolaridad)
								<option value="{{ $escolaridad -> id_escolaridad }}" @if(old('id_escolaridad') == $escolaridad -> id_escolaridad) selected @endif>{{ $escolaridad -> escolaridad}}	
								</option>	
							@endforeach
						</select>
						{{ $errors -> first('id_escolaridad') }}
					</label>
				</div>
				<div class="col-sm-12">
					<div class="row" align="center">
						<label for="grupo">
							Grupo
							<input type="text" name="grupo" value="{{old('grupo')}}" class="form-control" placeholder="1o A, 1o B, etc...">
							{{ $errors -> first('grupo') }}
						</label>
						<label for="capacidad">
							Capacidad
							<input type="text" name="capacidad" value="{{old('capacidad')}}" class="form-control" placeholder="15, 20, etc...">
							{{ $errors -> first('capacidad') }}
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Grupo.index') }}" class="btn btn-primary">Regresar</a>
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