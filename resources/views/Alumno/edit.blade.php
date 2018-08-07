@extends('layout')

@section('contenido')
<form method="POST" id="editar_alumno" enctype="multipart/form-data" action="{{ route('Alumno.update', $alumno -> id_alumno) }}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
    <h1 align="center">Edición de Alumno(a)</h1>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="row">
				<div class="form-group" align="center">
					<label for="foto">
						<img width="130px" src="{{ Storage::url($alumno -> foto) }}"><input type="file" name="foto" value="{{ old('foto') }}" accept="image/*">
						{{ $errors -> first('foto') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="nombre">
						Nombre(s)
						<input type="text" name="nombre" value="{{ $alumno -> nombre }}" class="form-control" placeholder="Nombre(s) del Alumno">
						{{ $errors -> first('nombre') }}
					</label>	
				</div>
				<div class="col-sm-4 form-group">
					<label for="a_paterno">
						Apellido Paterno
						<input type="text" name="a_paterno" value="{{ $alumno -> a_paterno }}" class="form-control" placeholder="Apellido del Alumno">
						{{ $errors -> first('a_paterno') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="a_materno">
						Apellido Materno
						<input type="text" name="a_materno" value="{{ $alumno -> a_materno }}" class="form-control" placeholder="Apellido del Alumno">
						{{ $errors -> first('a_materno') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="curp">
						CURP
						<input type="text" name="curp" id="curp" value="{{ $alumno -> curp }}" class="form-control" placeholder="CURP del Alumno">
						{{ $errors -> first('curp') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="id_estado">
						Estado<br>
						<select name="id_estado" id="id_estado">
							<option value="0">Seleccione un Estado</option>
							@foreach($estados as $estado)
								<option value="{{ $estado -> id_estado }}" @if(($alumno -> id_estado_municipio == $estado -> municipios[0] -> id_estado_municipio)) selected @endif>{{ $estado -> estado}}	
								</option>			
							@endforeach
						</select>
						{{ $errors -> first('id_estado') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="id_estado_municipio">
						Municipio<br>
						<select name="id_estado_municipio" id="id_estado_municipio">
							<option value="0">Seleccione un Municipio</option>
							<@foreach($municipios as $municipio)
								<option value="{{ $municipio-> id_estado_municipio }}" @if( $alumno -> id_estado_municipio == $municipio -> id_estado_municipio ) selected @endif>{{ $municipio -> municipio}}	
								</option>	
							@endforeach
						</select>
						{{ $errors -> first('id_estado_municipio') }}
						</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="extranjero">
						Otro
						<input type="text" name="extranjero" value="{{ $alumno -> extranjero }}" class="form-control" placeholder="Lugar de Origen del Alumno">
						{{ $errors -> first('extranjero') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="calle">
						Calle	
						<input type="text" name="calle" value="{{ $alumno -> calle }}" class="form-control" placeholder="Domicilio del Alumno">
						{{ $errors -> first('calle') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="numero_interior">
						Número Interior
						<input type="text" name="numero_interior" value="{{ $alumno -> numero_interior }}" class="form-control" placeholder="Número interior">
						{{ $errors -> first('numero_interior') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="numero_exterior">
						Número Exterior
						<input type="text" name="numero_exterior" value="{{ $alumno -> numero_exterior }}" class="form-control" placeholder="Número exterior">
						{{ $errors -> first('numero_exterior') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">		
					<label for="colonia">
						Colonia	
						<input type="text" name="colonia" value="{{ $alumno -> colonia }}" class="form-control" placeholder="Domicilio del Alumno">
						{{ $errors -> first('colonia') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">	
					<label for="cp">
						Código Postal
						<input type="text" name="cp" value="{{ $alumno -> cp }}" class="form-control" placeholder="Código postal del Alumno">
						{{ $errors -> first('cp') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">	
					<label for="telefono">
						Número(s) de Teléfono	
						<input type="text" name="telefono" value="{{ $alumno -> telefono }}" class="form-control" placeholder="Domicilio del Alumno">
						{{ $errors -> first('telefono') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="email">
						Correo Electrónico	
						<input type="email" name="email" id="email" value="{{ $alumno -> email }}" class="form-control" placeholder="mail@algo.com">
						{{ $errors -> first('email') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="confirmaemail">
						Confirmación Correo Electrónico	
						<input type="email" name="confirmaemail" id="confirmaemail" value="{{ $alumno -> email }}" class="form-control" placeholder="mail@algo.com">
						{{ $errors -> first('confirmaemail') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="id_religion">
						Religión<br>
						<select name="id_religion">
							<option value="0">Seleccione una Religión</option>
							<@foreach($religiones as $religion)
								<option value="{{ $religion -> id_religion }}" @if( $alumno -> id_religion == $religion -> id_religion ) selected @endif>{{ $religion -> religion}}
								</option>	
							@endforeach
						</select>
						{{ $errors -> first('id_religion') }}
						</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="tipo_sangre">
						Tipo de Sangre	
						<input type="text" name="tipo_sangre" value="{{ $alumno -> tipo_sangre }}" class="form-control" placeholder="O positivo, O negativo, etc...">
						{{ $errors -> first('tipo_sangre') }}
					</label>
				</div>
			</div>
		</div>
	</div>

		<div class="col-lg-12 well">
			<div class="row">
				<div class="col-sm-6 form-group">
					<h3 align="center">
						Padre o Tutor
					</h3>
				</div>
				<div class="col-sm-6 form-group">
					<h3 align="center">
						Madre o Tutora
					</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<p id="papa_es_empleado">
					<select name="id_papa" id="id_papa">
						<option value="0">Seleccione una opción</option>
						<option value="1" @if( $papa_trabajador != 0 ) selected @endif>El padre es trabajador del colegio</option>
						<option value="2" @if( !empty($papa_externo) ) selected @endif>El padre es externo</option>
						<option value="3" @if( empty($papa_externo) && ($papa_trabajador == 0) ) selected @endif>No aplica</option>
					</select>
					</p>
				</div>
				<div class="col-sm-6 form-group">
					<p id="mama_es_empleada">
						<select name="id_mama" id="id_mama">
							<option value="0">Seleccione una opción</option>
							<option value="1" @if( $mama_trabajadora != 0 ) selected @endif>La madre es trabajadora del colegio</option>
							<option value="2" @if( !empty($mama_externa) ) selected @endif>La madre es externa</option>
							<option value="3" @if( empty($mama_externa) && ($mama_trabajadora == 0) ) selected @endif>No aplica</option>
						</select>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<div id="campo_padre_trabajador" >
						<label for="id_padre_trabajador">
						Trabajador<br>
						<select name="id_padre_trabajador" id="id_padre_trabajador">
						<!--<option value="-1" style="display:none" selected>Oculto</option>-->
							<option value="0">Seleccione un trabajador</option>
							@foreach($trabajadores as $trabajador)
								@if(substr($trabajador -> curp, 10, 1) == 'H')	
									<option value="{{ $trabajador -> id_trabajador }}" @if( $papa_trabajador == $trabajador -> id_trabajador ) selected @endif>{{ $trabajador -> nombre}}	
									</option>	
								@endif
							@endforeach
						</select>
						{{ $errors -> first('id_padre_trabajador') }}
						</label>
					</div>
				</div>
				<div class="col-sm-6 form-group">
					<div id="campo_madre_trabajadora" >
						<label for="id_madre_trabajadora">
						Trabajadora<br>
						<select name="id_madre_trabajadora" id="id_madre_trabajadora">
							<!--<option value="-1" style="display:none" selected>Oculto</option>-->
							<option value="0">Seleccione un trabajador</option>
							@foreach($trabajadores as $trabajador)
								@if(substr($trabajador -> curp, 10, 1) == 'M')
									<option value="{{ $trabajador -> id_trabajador }}" @if( $mama_trabajadora == $trabajador -> id_trabajador ) selected @endif>{{ $trabajador -> nombre}}	
									</option>
								@endif	
							@endforeach
						</select>
						{{ $errors -> first('id_madre_trabajadora') }}
						</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<div id='papa'>
						<label for="nombre_padre">
						Nombre(s) del Padre
							<input type="text" name="nombre_padre" id="nombre_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> nombre : 'NA' }}" class="form-control" placeholder="Nombre(s) del padre">
						{{ $errors -> first('nombre_padre') }}
						</label>
						<label for="a_paterno_padre">
						Apellido Paterno del Padre
							<input type="text" name="a_paterno_padre" id="a_paterno_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> a_paterno : 'NA' }}" class="form-control" placeholder="Apellido paterno del padre">
							{{ $errors -> first('a_paterno_padre') }}
						</label>
						<label for="a_materno_padre">
						Apellido Materno del Padre
							<input type="text" name="a_materno_padre" id="a_materno_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> a_materno : 'NA' }}" class="form-control" placeholder="Apellido materno del padre">
							{{ $errors -> first('a_materno_madre') }}
							</label>
						<label for="curp_padre">
						CURP
							<input type="text" name="curp_padre" id="curp_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> curp : 'NANANANANANANANANA' }}" class="form-control" placeholder="CURP del padre">
							{{ $errors -> first('curp_padre') }}
							</label>
						<label for="empleo_padre">
						Lugar Donde Labora el Padre
								<input type="text" name="empleo_padre" id="empleo_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> empleo : 'NA' }}" class="form-control" placeholder="Lugar donde labora el padre">
								{{ $errors -> first('empleo_padre') }}
							</label>
						<label for="puesto_padre">
						Puesto Laboral del Padre
							<input type="text" name="puesto_padre" id="puesto_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> puesto : 'NA' }}" class="form-control" placeholder="Puesto del padre">
							{{ $errors -> first('puesto_padre') }}
							</label>
						<label for="direccion_laboral_padre">
						Dirección Laboral del Padre
							<input type="text" name="direccion_laboral_padre" id="direccion_laboral_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> direccion : 'NA' }}"" class="form-control" placeholder="Dirección donde labora el padre">
							{{ $errors -> first('direccion_laboral_padre') }}
							</label>
						<label for="telefono_laboral_padre">
						Teléfono Laboral del Padre
							<input type="text" name="telefono_laboral_padre" id="telefono_laboral_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> tel_trabajo : '11111' }}" class="form-control" placeholder="Teléfono laboral del padre">
							{{ $errors -> first('telefono_laboral_padre') }}
							</label>
						<label for="celular_padre">
						Teléfono Celular del Padre
							<input type="text" name="celular_padre" id="celular_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> celular : '11111' }}" class="form-control" placeholder="Teléfono celular del padre">
							{{ $errors -> first('celular_padre') }}
							</label>
						<label for="nextel_padre">
						Nextel del Padre
							<input type="text" name="nextel_padre" id="nextel_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> nextel : '11111' }}" class="form-control" placeholder="Nextel del padre">
							{{ $errors -> first('nextel_padre') }}
							</label>
						<label for="email_padre">
						Correo Electrónico del Padre
							<input type="email" name="email_padre" id="email_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> email : 'NA@GMAIL.COM' }}" class="form-control" placeholder="Correo electrónico">
							{{ $errors -> first('email_padre') }}
							</label>
						<label for="confirmar_email_padre">
							Confirmar Correo Electrónico del Padre
							<input type="email" name="confirmar_email_padre" id="confirmar_email_padre" value="{{ ($papa_externo != null) ? $papa_externo[0] -> email : 'NA@GMAIL.COM' }}" class="form-control" placeholder="Confirmar correo electrónico">
							{{ $errors -> first('confirmar_email_padre') }}
							</label>
					</div>
				</div>
				<div class="col-sm-6 form-group">
					<div id='mama'>
						<label for="nombre_madre">
						Nombre(s) de la Madre
							<input type="text" name="nombre_madre" id="nombre_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> nombre : 'NA' }}" class="form-control" placeholder="Nombre(s) de la madre">
							{{ $errors -> first('nombre_madre') }}
							</label>
						<label for="a_paterno_madre">
						Apellido Paterno de la Madre
							<input type="text" name="a_paterno_madre" id="a_paterno_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] ->  a_paterno : 'NA' }}" class="form-control" placeholder="Apellido paterno de la madre">
							{{ $errors -> first('a_paterno_madre') }}
							</label>
						<label for="a_materno_madre">
						Apellido Materno de la Madre
							<input type="text" name="a_materno_madre" id="a_materno_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] ->  a_materno : 'NA' }}" class="form-control" placeholder="Apellido materno de la madre">
							{{ $errors -> first('a_materno_madre') }}
							</label>
						<label for="curp_madre">
						CURP de la Madre
							<input type="text" name="curp_madre" id="curp_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> curp : 'NANANANANANANANANA' }}" class="form-control" placeholder="CURP de la madre">
							{{ $errors -> first('curp_madre') }}
							</label>
						<label for="empleo_madre">
							Lugar Donde Labora la Madre
								<input type="text" name="empleo_madre" id="empleo_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> empleo : 'NA' }}" class="form-control" placeholder="Lugar donde labora la madre">
							{{ $errors -> first('empleo_madre') }}
							</label>
						<label for="puesto_madre">
							Puesto Laboral de la Madre
								<input type="text" name="puesto_madre" id="puesto_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> puesto : 'NA' }}" class="form-control" placeholder="Puesto de la madre">
								{{ $errors -> first('puesto_madre') }}
							</label>
						<label for="direccion_laboral_madre">
						Dirección Laboral de la Madre
							<input type="text" name="direccion_laboral_madre" id="direccion_laboral_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> direccion : 'NA' }}" class="form-control" placeholder="Dirección donde labora la madre">
							{{ $errors -> first('direccion_laboral_madre') }}
							</label>
						<label for="telefono_laboral_madre">
						Teléfono Laboral de la Madre
							<input type="text" name="telefono_laboral_madre" id="telefono_laboral_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> tel_trabajo : '11111' }}" class="form-control" placeholder="Teléfono laboral de la madre">
							{{ $errors -> first('telefono_laboral_madre') }}
							</label>
						<label for="celular_madre">
						Teléfono Celular de la Madre
							<input type="text" name="celular_madre" id="celular_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> celular : '11111' }}" class="form-control" placeholder="Teléfono celular de la madre">
							{{ $errors -> first('celular_madre') }}
							</label>
						<label for="nextel_madre">
						Nextel de la Madre
							<input type="text" name="nextel_madre" id="nextel_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> nextel : '11111' }}" class="form-control" placeholder="Nextel de la madre">
							{{ $errors -> first('nextel_madre') }}
							</label>
						<label for="email_madre">
						Correo Electrónico de la Madre
							<input type="email" name="email_madre" id="email_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> email : 'NA@GMAIL.COM' }}" class="form-control" placeholder="Correo electrónico">
							{{ $errors -> first('email_madre') }}
							</label>
						<label for="confirmar_email_madre">
						Confirmar Correo Electrónico de la Madre
							<input type="email" name="confirmar_email_madre" id="confirmar_email_madre" value="{{ ($mama_externa != null) ? $mama_externa[0] -> email : 'NA@GMAIL.COM' }}" class="form-control" placeholder="Confirmar correo electrónico">
							{{ $errors -> first('confirmar_email_madre') }}
							</label>
					</div>
				</div>
			</div>
		</div>
	

	<div class="col-lg-12 well">
		<h3 align="center">
			Atecedentes Médicos
		</h3>
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="alergia">
				Alergia
					<input type="text" name="alergia" id="alergia" value="{{ $padecimiento -> alergia }}" class="form-control" placeholder="Alergia">
					{{ $errors -> first('alergia') }}
					</label>
			</div>
			<div class="col-sm-4 form-group">
				<label for="enfermedad">
				Enfermedad
					<input type="text" name="enfermedad" id="enfermedad" value="{{ $padecimiento -> enfermedad }}" class="form-control" placeholder="Enfermedad">
					{{ $errors -> first('enfermedad') }}
					</label>
			</div>
			<div class="col-sm-4 form-group">
				<label for="medicina">
				Medicamento
					<input type="text" name="medicina" id="medicina" value="{{ $padecimiento -> medicina }}" class="form-control" placeholder="Medicamento que toma">
					{{ $errors -> first('medicina') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="cirugia">
					Cirugia
					<input type="text" name="cirugia" id="cirugia" value="{{ $padecimiento -> cirugia }}" class="form-control" placeholder="Cirugia">
					{{ $errors -> first('cirugia') }}
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="medico">
					Médico que le Atiende
						<input type="text" name="medico" id="medico" value="{{ $padecimiento -> medico }}" class="form-control" placeholder="Médico que le atiende">
						{{ $errors -> first('medico') }}
					</label>
			</div>
			<div class="col-sm-4 form-group">
				<label for="telefono_medico">
					Teléfono del Médico que le Atiende
						<input type="text" name="telefono_medico" id="telefono_medico" value="{{ $padecimiento -> tel_medico }}" class="form-control" placeholder="Teléfono del Médico que le atiende">
						{{ $errors -> first('telefono_medico') }}
					</label>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="nombre_referencia1">
					Nombre de Alguna Referencia Personal
						<input type="text" name="nombre_referencia1" id="nombre_referencia1" value="{{ $padecimiento -> ref1_nombre }}" class="form-control" placeholder="Referencia 1">
						{{ $errors -> first('nombre_referencia1') }}
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="telefono_referencia1">
					Teléfono de Alguna Referencia Personal
						<input type="text" name="telefono_referencia1" id="telefono_referencia1" value="{{ $padecimiento -> ref1_tel }}" class="form-control" placeholder="Teléfono de Referencia 1">
						{{ $errors -> first('telefono_referencia1') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="nombre_referencia2">
					Nombre de una Segunda Referencia Personal
						<input type="text" name="nombre_referencia2" id="nombre_referencia2" value="{{ $padecimiento -> ref2_nombre }}" class="form-control" placeholder="Referencia 1">
						{{ $errors -> first('ref2_nombre') }}
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="telefono_referencia2">
					Teléfono de una Segunda Referencia Personal
						<input type="text" name="telefono_referencia2" id="telefono_referencia2" value="{{ $padecimiento -> ref2_tel }}" class="form-control" placeholder="Teléfono de Referencia 1">
						{{ $errors -> first('ref2_tel') }}	
					</label>	
			</div>
		</div>
	</div>

	<div class="col-lg-12 well">
		<h3 align="center">
			Expediente
		</h3>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="acta_nacimiento">
				Acta de Nacimiento<br>
					<input type="radio" name="acta_nacimiento" value="1" @if( $expediente -> acta_nacimiento == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="acta_nacimiento" value="2" @if( $expediente -> acta_nacimiento == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="acta_nacimiento" value="3" @if( $expediente -> acta_nacimiento == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_acta_nacimiento">
				Observaciones sobre acta de nacimiento<br>
					<input type="text" name="obs_acta_nacimiento" id="obs_acta_nacimiento" value="{{ $expediente -> obs_acta }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_acta_nacimiento') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="impresion_curp">
				CURP Impresa<br>
					<input type="radio" name="impresion_curp" value="1" @if( $expediente -> curp == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="impresion_curp" value="2" @if( $expediente -> curp == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="impresion_curp" value="3" @if( $expediente -> curp == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_impresion_curp">
				Observaciones sobre CURP impresa<br>
					<input type="text" name="obs_impresion_curp" id="obs_impresion_curp" value="{{ $expediente -> obs_curp }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_impresion_curp') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="cartilla_vacunacion">
				Cartilla de Vacunación<br>
					<input type="radio" name="cartilla_vacunacion" value="1" @if( $expediente -> cartilla_vacunacion == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="cartilla_vacunacion" value="2" @if( $expediente -> cartilla_vacunacion == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="cartilla_vacunacion" value="3" @if( $expediente -> cartilla_vacunacion == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_cartilla_vacunacion">
				Observaciones sobre Cartilla de Vacunación<br>
						<input type="text" name="obs_cartilla_vacunacion" id="obs_cartilla_vacunacion" value="{{ $expediente -> obs_cartilla }}" class="form-control" placeholder="Observaciones">
						{{ $errors -> first('obs_cartilla_vacunacion') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="certificado_medico">
				Certificado Médico<br>
					<input type="radio" name="certificado_medico" value="1" @if( $expediente -> certificado_medico == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="certificado_medico" value="2" @if( $expediente -> certificado_medico == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="certificado_medico" value="3" @if( $expediente -> certificado_medico == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_certificado_medico">
				Observaciones sobre Certificado Médico<br>
					<input type="text" name="obs_certificado_medico" id="obs_certificado_medico" value="{{ $expediente -> obs_cert_medico }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_certificado_medico') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="constancia_estudios">
				Constancia de Estudios<br>
					<input type="radio" name="constancia_estudios" value="1" @if( $expediente -> constancia_estudios == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="constancia_estudios" value="2" @if( $expediente -> constancia_estudios == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="constancia_estudios" value="3" @if( $expediente -> constancia_estudios == 3 ) checked @endif>No Aplica
						</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_constancia_estudios">
				Observaciones sobre Constancia de Estudios<br>
					<input type="text" name="obs_constancia_estudios" id="obs_constancia_estudios" value="{{ $expediente -> obs_constancia }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_constancia_estudios') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="curp_padre_alumno">
				CURP Impresa del Padre o Tutor<br>
					<input type="radio" name="curp_padre_alumno" value="1" @if( $expediente -> curp_padre == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="curp_padre_alumno" value="2" @if( $expediente -> curp_padre == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="curp_padre_alumno" value="3" @if( $expediente -> curp_padre == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_curp_padre_alumno">
				Observaciones sobre CURP impresa del Padre o Tutor<br>
					<input type="text" name="obs_curp_padre_alumno" id="obs_curp_padre_alumno" value="{{ $expediente -> obs_curp_padre }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_curp_padre_alumno') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="curp_madre_alumno">
				CURP Impresa de la Madre o Tutora<br>
					<input type="radio" name="curp_madre_alumno" value="1" @if( $expediente -> curp_madre == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="curp_madre_alumno" value="2" @if( $expediente -> curp_madre == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="curp_madre_alumno" value="3" @if( $expediente -> curp_madre == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_curp_madre_alumno">
				Observaciones sobre CURP impresa de la Madre o Tutora<br>
					<input type="text" name="obs_curp_madre_alumno" id="obs_curp_madre_alumno" value="{{ $expediente -> obs_curp_madre}}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_curp_madre_alumno') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="ife_padre_alumno">
				Copia de IFE/INE del Padre o Tutor<br>
					<input type="radio" name="ife_padre_alumno" value="1" @if( $expediente -> ife_padre == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="ife_padre_alumno" value="2" @if( $expediente -> ife_padre == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="ife_padre_alumno" value="3" @if( $expediente -> ife_padre == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_ife_padre_alumno">
				Observaciones sobre Copia de IFE/INE del Padre o Tutor<br>
					<input type="text" name="obs_ife_padre_alumno" id="obs_ife_padre_alumno" value="{{ $expediente -> obs_ife_padre }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_ife_padre_alumno') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="ife_madre_alumno">
				Copia de IFE/INE de la Madre o Tutora<br>
					<input type="radio" name="ife_madre_alumno" value="1" @if( $expediente -> ife_madre == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="ife_madre_alumno" value="2" @if( $expediente -> ife_madre == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="ife_madre_alumno" value="3" @if( $expediente -> ife_madre == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_ife_madre_alumno">
				Observaciones sobre Copia de IFE/INE de la Madre o Tutora<br>
					<input type="text" name="obs_ife_madre_alumno" id="obs_ife_madre_alumno" value="{{ $expediente -> obs_ife_madre }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_ife_madre_alumno') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="comprobante_domicilio">
				Comprobante de Domicilio<br>
					<input type="radio" name="comprobante_domicilio" value="1" @if( $expediente -> comp_domicilio == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="comprobante_domicilio" value="2" @if( $expediente -> comp_domicilio == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="comprobante_domicilio" value="3" @if( $expediente -> comp_domicilio == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_comprobante_domicilio">
				Observaciones sobre Comprobante de Domicilio<br>
					<input type="text" name="obs_comprobante_domicilio" id="obs_comprobante_domicilio" value="{{ $expediente -> obs_comp_domicilio }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_comprobante_domicilio') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="boleta_inmediata_anterior">
				Boleta Inmediata Anterior<br>
					<input type="radio" name="boleta_inmediata_anterior" value="1" @if( $expediente -> boleta_anterior == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="boleta_inmediata_anterior" value="2" @if( $expediente -> boleta_anterior == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="boleta_inmediata_anterior" value="3" @if( $expediente -> boleta_anterior == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_boleta_inmediata_anterior">
				Observaciones sobre Boleta Inmediata Anterior<br>
					<input type="text" name="obs_boleta_inmediata_anterior" id="obs_boleta_inmediata_anterior" value="{{ $expediente -> obs_boleta_anterior }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_boleta_inmediata_anterior') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="carta_buena_conducta">
				Carta de Buena Conducta<br>
					<input type="radio" name="carta_buena_conducta" value="1" @if( $expediente -> carta_conducta == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="carta_buena_conducta" value="2" @if( $expediente -> carta_conducta == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="carta_buena_conducta" value="3" @if( $expediente -> carta_conducta == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_carta_buena_conducta">
				Observaciones sobre Carta de Buena Conducta<br>
					<input type="text" name="obs_carta_buena_conducta" id="obs_carta_buena_conducta" value="{{ $expediente -> obs_carta_buena_conducta }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_carta_buena_conducta') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="certificado_primaria">
				Certificado de Primaria<br>
					<input type="radio" name="certificado_primaria" value="1" @if( $expediente -> cert_primaria == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="certificado_primaria" value="2" @if( $expediente -> cert_primaria == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="certificado_primaria" value="3" @if( $expediente -> cert_primaria == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_certificado_primaria">
				Observaciones sobre Certificado de Primaria<br>
					<input type="text" name="obs_certificado_primaria" id="obs_certificado_primaria" value="{{ $expediente -> obs_cert_primaria }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_certificado_primaria') }}
					</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="boletas_anteriores">
				Boletas Anteriores<br>
					<input type="radio" name="boletas_anteriores" value="1" @if( $expediente -> boletas_anteriores == 1 ) checked @endif>Entregó<br>
					<input type="radio" name="boletas_anteriores" value="2" @if( $expediente -> boletas_anteriores == 2 ) checked @endif>Pendiente<br>
					<input type="radio" name="boletas_anteriores" value="3" @if( $expediente -> boletas_anteriores == 3 ) checked @endif>No Aplica
					</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="obs_boletas_anteriores">
				Observaciones sobre Boletas Anteriores<br>
					<input type="text" name="obs_boletas_anteriores" id="obs_boletas_anteriores" value="{{ $expediente -> obs_boletas_anteriores }}" class="form-control" placeholder="Observaciones">
					{{ $errors -> first('obs_boletas_anteriores') }}
					</label>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="form-group pull-right">
				<button type="submit" id="boton_editar_alumno" class="btn btn-primary">Enviar</button>
				<a href="{{ route('Alumno.index') }}" class="btn btn-primary">Regresar</a>
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
	input[type="email"] {
    	width: 300px;
	}
</style>
<script>
	$(function(){
    // your logic here`enter code here`
		$("#papa").hide();
		$("#mama").hide();
		estatuspapa = $('#id_papa').find('option:selected').val();
		if(estatuspapa == 1){
			$(document).ready(function(){
				deshabilitarPadre();
			});
		}else if(estatuspapa == 3){
			$(document).ready(function(){
				deshabilitarPadre();
				$("#campo_padre_trabajador").hide();
				$("#id_padre_trabajador").val(0);
			});
		}else if(estatuspapa == 2){
			$(document).ready(function(){
				habilitarPadre();
				$("#campo_padre_trabajador").hide();
				$("#id_padre_trabajador").val(0);
			});
		}else{
			$(document).ready(function(){
				deshabilitarPadre();
				$("#campo_padre_trabajador").hide();
				$("#id_padre_trabajador").val(0);
			});
		}
		
		estatusmama = $('#id_mama').find('option:selected').val();
		if(estatusmama == 1){
			$(document).ready(function(){
				deshabilitarMadre();
			});
		}else if(estatusmama == 3){
			$(document).ready(function(){
				deshabilitarMadre();
				$("#campo_madre_trabajadora").hide();
				$("#id_madre_trabajadora").val(0);
			});
		}else if(estatusmama == 2){
			$(document).ready(function(){
				habilitarMadre();
				$("#campo_madre_trabajadora").hide();
				$("#id_madre_trabajadora").val(0);
			});
		}else{
			$(document).ready(function(){
				deshabilitarMadre();
				$("#campo_madre_trabajadora").hide();
				$("#id_madre_trabajadora").val(0);
			});
		}

    	///////////logica en cambios
    	$("#boton_editar_alumno").click(function(){
    		$("#editar_alumno").submit();
    	});

		$('#id_estado').on('change', function(e){
			var estado = e.target.value;
			$.get('/ajax-getMunicipio?id_estado='+estado, function(data){
				$('#id_estado_municipio').empty();
				$('#id_estado_municipio').append('<option value="0">Seleccione un Municipio</option>');
				$.each(data, function(create, municipio){
					$('#id_estado_municipio').append('<option value="'+municipio.id_estado_municipio+'">'+municipio.municipio+'</option>');
				});
			});
		});

		$('#id_papa').change( function (){
			estatuspapa = $(this).find('option:selected').val();
			if(estatuspapa == 1){
				deshabilitarPadre();
				$("#id_padre_trabajador").val(0);
			}else if(estatuspapa == 3){
				deshabilitarPadre();
				$("#campo_padre_trabajador").hide();
				$("#id_padre_trabajador").val(0);
			}else if(estatuspapa == 2){
				habilitarPadre();
				$("#campo_padre_trabajador").hide();
				$("#id_padre_trabajador").val(0);
			}else{
				$(document).ready(function(){
					deshabilitarPadre();
					$("#campo_padre_trabajador").hide();
					$("#id_padre_trabajador").val(0);
				});
			}
		});

		$('#id_mama').change( function (){
			estatusmama = $(this).find('option:selected').val();
			if(estatusmama == 1){
				deshabilitarMadre();
				$("#id_madre_trabajadora").val(0);
			}else if(estatusmama == 3){
				deshabilitarMadre();
				$("#campo_madre_trabajadora").hide();
				$("#id_madre_trabajadora").val(0);
			}else if(estatusmama == 2){
				habilitarMadre();
				$("#campo_madre_trabajadora").hide();
				$("#id_madre_trabajadora").val(0);
			}else{
				$(document).ready(function(){
					deshabilitarMadre();
					$("#campo_madre_trabajadora").hide();
					$("#id_madre_trabajadora").val(0);
				});
			}
		});
	});

	function deshabilitarPadre(){
		$("#nombre_padre").val('NA');
		$("#a_paterno_padre").val('NA');
		$("#a_materno_padre").val('NA');
		$("#curp_padre").val('NANANANANANANANANA');
		$("#empleo_padre").val('NA');
		$("#puesto_padre").val('NA');
		$("#direccion_laboral_padre").val('NA');
		$("#telefono_laboral_padre").val('11111');
		$("#celular_padre").val('11111');
		$("#nextel_padre").val('11111');
		$("#email_padre").val('NA@GMAIL.COM');
		$("#confirmar_email_padre").val('NA@GMAIL.COM');
		$("#campo_padre_trabajador").show();
		//$("#id_padre_trabajador").val('0');
		$("#papa").hide();
	}
	function deshabilitarMadre(){
		$("#nombre_madre").val('NA');
		$("#a_paterno_madre").val('NA');
		$("#a_materno_madre").val('NA');
		$("#curp_madre").val('NANANANANANANANANA');
		$("#empleo_madre").val('NA');
		$("#puesto_madre").val('NA');
		$("#direccion_laboral_madre").val('NA');
		$("#telefono_laboral_madre").val('11111');
		$("#celular_madre").val('11111');
		$("#nextel_madre").val('11111');
		$("#email_madre").val('NA@GMAIL.COM');
		$("#confirmar_email_madre").val('NA@GMAIL.COM');
		$("#campo_madre_trabajadora").show();
		//$("#id_madre_trabajadora").val('0');
		$("#mama").hide();
	}
	function habilitarPadre(){
		if($("#nombre_padre").val()=='NA')
			$("#nombre_padre").val('');
		if($("#a_paterno_padre").val()=='NA')
			$("#a_paterno_padre").val('');
		if($("#a_materno_padre").val()=='NA')
			$("#a_materno_padre").val('');
		if($("#curp_padre").val()=='NANANANANANANANANA')
			$("#curp_padre").val('');
		if($("#empleo_padre").val()=='NA')
			$("#empleo_padre").val('');
		if($("#puesto_padre").val()=='NA')
			$("#puesto_padre").val('');
		if($("#direccion_laboral_padre").val()=='NA')
			$("#direccion_laboral_padre").val('');
		if($("#telefono_laboral_padre").val()=='11111')
			$("#telefono_laboral_padre").val('');
		if($("#celular_padre").val()=='11111')
			$("#celular_padre").val('');
		if($("#nextel_padre").val()=='11111')
			$("#nextel_padre").val('');
		if($("#email_padre").val()=='NA@GMAIL.COM')
			$("#email_padre").val('');
		if($("#confirmar_email_padre").val()=='NA@GMAIL.COM')
			$("#confirmar_email_padre").val('');
		$("#id_padre_trabajador").val('0');
		$("#papa").show();	
	}
	function habilitarMadre(){
		if($("#nombre_madre").val()=='NA')
			$("#nombre_madre").val('');
		if($("#a_paterno_madre").val()=='NA')
			$("#a_paterno_madre").val('');
		if($("#a_materno_madre").val()=='NA')
			$("#a_materno_madre").val('');
		if($("#curp_madre").val()=='NANANANANANANANANA')
			$("#curp_madre").val('');
		if($("#empleo_madre").val()=='NA')
			$("#empleo_madre").val('');
		if($("#puesto_madre").val()=='NA')
			$("#puesto_madre").val('');
		if($("#direccion_laboral_madre").val()=='NA')
			$("#direccion_laboral_madre").val('');
		if($("#telefono_laboral_madre").val()=='11111')
			$("#telefono_laboral_madre").val('');
		if($("#celular_madre").val()=='11111')
			$("#celular_madre").val('');
		if($("#nextel_madre").val()=='11111')
			$("#nextel_madre").val('');
		if($("#email_madre").val()=='NA@GMAIL.COM')
			$("#email_madre").val('');
		if($("#confirmar_email_madre").val()=='NA@GMAIL.COM')
			$("#confirmar_email_madre").val('');
		$("#id_madre_trabajadora").val('0');
		$("#mama").show();	
	}
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection