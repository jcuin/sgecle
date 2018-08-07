@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Religion.update', $religion -> id_religion)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Religión</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="religion">
						Religión
						<input type="text" name="religion" value="{{$religion -> religion}}" class="form-control" placeholder="católico, cristiano, etc...">
						{{ $errors -> first('religion') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Religion.index') }}" class="btn btn-primary">Regresar</a>
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