@extends('layout')

@section('contenido')

<form method="POST" action="{{ route('Estado.update', $estado -> id_estado)}}">
	 {!! method_field('PUT') !!}
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Edición de Estado</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="estado">
						Estado
						<input type="text" name="estado" value="{{$estado -> estado}}" class="form-control">
						{{ $errors -> first('estado') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Estado.index') }}" class="btn btn-primary">Regresar</a>
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