@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Parentesco.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Parentesco</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="parentesco">
						Parentesco
						<input type="text" name="parentesco" value="{{old('parentesco')}}" class="form-control" placeholder="padre, madre, hijo, etc...">
						{{ $errors -> first('parentesco') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Parentesco.index') }}" class="btn btn-primary">Regresar</a>
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