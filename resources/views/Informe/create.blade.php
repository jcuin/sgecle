@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Periodo.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Periodo</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="periodo">
						Periodo
						<input type="text" name="periodo" value="{{old('periodo')}}" class="form-control" placeholder="febrero - agosto 2018, etc...">
						{{ $errors -> first('periodo') }}
					</label>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="trimestre_preescolar">
							Trimestre Preescolar<br>
							<select name="trimestre_preescolar" id="trimestre_preescolar">
								<option value="1" @if(old('trimestre_preescolar') == 1 ) selected @endif>1er Trimestre</option>
								<option value="2" @if(old('trimestre_preescolar') == 2 ) selected @endif>2do Trimestre</option>
								<option value="3" @if(old('trimestre_preescolar') == 3 ) selected @endif>3er Trimestre</option>
							</select>
							{{ $errors -> first('trimestre_preescolar') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="bimestre_primaria">
							Bimestre Primaria<br>
							<select name="bimestre_primaria" id="bimestre_primaria">
								<option value="1" @if(old('bimestre_primaria') == 1 ) selected @endif>1er Bimestre</option>
								<option value="2" @if(old('bimestre_primaria') == 2 ) selected @endif>2do Bimestre</option>
								<option value="3" @if(old('bimestre_primaria') == 3 ) selected @endif>3er Bimestre</option>
								<option value="4" @if(old('bimestre_primaria') == 4 ) selected @endif>4to Bimestre</option>
								<option value="5" @if(old('bimestre_primaria') == 5 ) selected @endif>5to Bimestre</option>
							</select>
							{{ $errors -> first('bimestre_primaria') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="bimestre_secundaria">
							Bimestre secundaria<br>
							<select name="bimestre_secundaria" id="bimestre_secundaria">
								<option value="1" @if(old('bimestre_secundaria') == 1 ) selected @endif>1er Bimestre</option>
								<option value="2" @if(old('bimestre_secundaria') == 2 ) selected @endif>2do Bimestre</option>
								<option value="3" @if(old('bimestre_secundaria') == 3 ) selected @endif>3er Bimestre</option>
								<option value="4" @if(old('bimestre_secundaria') == 4 ) selected @endif>4to Bimestre</option>
								<option value="5" @if(old('bimestre_secundaria') == 5 ) selected @endif>5to Bimestre</option>
							</select>
							{{ $errors -> first('bimestre_secundaria') }}
						</label>
					</div>
				</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Periodo.index') }}" class="btn btn-primary">Regresar</a>
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
