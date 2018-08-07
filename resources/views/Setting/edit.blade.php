@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Setting.update', $setting -> id)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	<h1 align="center">Edición de Configuración</h1>
		<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="clave_preescolar">
						Clave Preescolar
						<input type="text" name="clave_preescolar" value="{{ $setting -> clave_preescolar}}" class="form-control" placeholder="CVE45GGHT">
						{{ $errors -> first('clave_preescolar') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="clave_primaria">
						Clave Primaria
						<input type="text" name="clave_primaria" value="{{ $setting -> clave_primaria}}" class="form-control" placeholder="CVE45GGHT">
						{{ $errors -> first('clave_primaria') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="clave_secundaria">
						Clave Secundaria
						<input type="text" name="clave_secundaria" value="{{ $setting -> clave_secundaria}}" class="form-control" placeholder="CVE45GGHT">
						{{ $errors -> first('clave_secundaria') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="zona_escolar">
						Zona Escolar
						<input type="text" name="zona_escolar" value="{{ $setting -> zona_escolar}}" class="form-control" placeholder="Centro-Occidente">
						{{ $errors -> first('zona_escolar') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="rfc_colegio">
						RFC
						<input type="text" name="rfc_colegio" value="{{ $setting -> rfc_colegio }}" class="form-control" placeholder="COFL150202G66">
						{{ $errors -> first('rfc_colegio') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="razon_social">
						Razón Social
						<input type="text" name="razon_social" value="{{ $setting -> razon_social}}" class="form-control" placeholder="COFERLI S.A. de C.V.">
						{{ $errors -> first('razon_social') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="domicilio">
						Domicilio
						<input type="text" name="domicilio" value="{{ $setting -> domicilio}}" class="form-control" placeholder="Av. Madero Poniente">
						{{ $errors -> first('domicilio') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="telefono_contacto">
						Teléfono
						<input type="text" name="telefono_contacto" value="{{ $setting -> telefono_contacto}}" class="form-control" placeholder="(443) 3151515">
						{{ $errors -> first('telefono_contacto') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="correo_electronico">
						Correo Electrónico
						<input type="email" name="correo_electronico" value="{{ $setting -> correo_electronico}}" class="form-control" placeholder="coferli@mail.com">
						{{ $errors -> first('correo_electronico') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">		
					<label for="id_periodo">
						Periodo<br>
						<select name="id_periodo">
							<option value="0">Seleccione un Periodo</option>
							<@foreach($periodos as $periodo)
								<option value="{{ $periodo -> id_periodo }}" @if($setting -> id_periodo == $periodo -> id_periodo ) selected @endif>{{ $periodo -> periodo}}
								</option>	
							@endforeach
						</select>
						{{ $errors -> first('id_periodo') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">	
					<label for="direccion_general">
						Dirección General
						<input type="text" name="direccion_general" value="{{ $setting -> direccion_general}}" class="form-control" placeholder="LEP Susana Tarragó Webber">
						{{ $errors -> first('direccion_general') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="direccion_preescolar">
						Dirección Preescolar
						<input type="text" name="direccion_preescolar" value="{{ $setting -> direccion_preescolar}}" class="form-control" placeholder="LEP Susana Tarragó Webber">
						{{ $errors -> first('direccion_preescolar') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="direccion_primaria">
						Dirección Primaria
						<input type="text" name="direccion_primaria" value="{{ $setting -> direccion_primaria}}" class="form-control" placeholder="LEP Susana Tarragó Webber">
						{{ $errors -> first('direccion_primaria') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="direccion_secundaria">
						Dirección Secundaria
						<input type="text" name="direccion_secundaria" value="{{ $setting -> direccion_secundaria}}" class="form-control" placeholder="LEP Susana Tarragó Webber">
						{{ $errors -> first('direccion_secundaria') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="direccion_ingles">
						Dirección Inglés
						<input type="text" name="direccion_ingles" value="{{ $setting -> direccion_ingles}}" class="form-control" placeholder="LEP Susana Tarragó Webber">
						{{ $errors -> first('direccion_ingles') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="costo_colegiatura">
						Costo de Colegiatura
						<input type="text" name="costo_colegiatura" value="{{ $setting -> costo_colegiatura}}" class="form-control" placeholder="2,300.00 pesos">
						{{ $errors -> first('costo_colegiatura') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<button type="submit" id="boton_editar_setting" class="btn btn-primary">Enviar</button>
					<a href="{{ route('Setting.index') }}" class="btn btn-primary">Regresar</a>
				</div>
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
<script >
	$("#boton_editar_setting").click(function(){
    	$("#editar_setting").submit();
    });
</script>
@endsection