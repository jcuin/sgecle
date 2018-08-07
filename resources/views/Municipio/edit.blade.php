@extends('layout')

@section('contenido')
	<form method="POST" action="{{ route('Municipio.update', $municipio -> id_estado_municipio)}}">
		{!! method_field('PUT') !!}
		{!! csrf_field() !!}
		<div class="container">
		    <h1 align="center">Edición de Municipio</h1>
			<div class="col-lg-12 well">
				<div class="col-sm-12">
					<div class="row" align="center">
						<label for="estado">
							Estado<br>
							<select name="id_estado">
								<option value="0">Seleccione un Estado</option>
								<@foreach($estados as $estado)
									@if($estado -> id_estado == $municipio -> id_estado)
										<option value="{{ $estado -> id_estado }}" selected="selected">{{ $estado -> estado}}	
										</option>
									@else
										<option value="{{ $estado -> id_estado }}">{{ $estado -> estado}}	
										</option>
									@endif	
								@endforeach
							</select>
							{{ $errors -> first('id_estado') }}
							</label>
						<label for="municipio">
							Municipio
								<input type="text" name="municipio" value="{{ $municipio -> municipio}}" class="form-control">
								{{ $errors -> first('municipio') }}
							</label>
					</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Municipio.index') }}" class="btn btn-primary">Regresar</a>
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