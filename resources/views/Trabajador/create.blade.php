@extends('layout')

@section('contenido')
<form method="POST" id="registrar_trabajador" enctype="multipart/form-data" action="{{ route('Trabajador.store') }}">
	{!! csrf_field() !!}
<div class="container">
    <h1 align="center">Registro de Trabajador(a)</h1>
	<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12 form-group" align="center"> 
						 <label for="foto" class="label-foto">
							Foto del Trabajador
							<input type="file" name="foto" id="foto" value="{{old('foto')}}" placeholder="foto(s) del Trabajador" accept="image/*">
							{{ $errors -> first('foto') }}
						</label>
						<div class="preview">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group"> 
						<label for="nombre">
							Nombre(s)
							<input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre(s) del trabajador">
							{{ $errors -> first('nombre') }}
						</label>
					</div>
					<div class="col-sm-4 form-group"> 
						<label for="a_paterno">
							Apellido Paterno
							<input type="text" name="a_paterno" value="{{old('a_paterno')}}" class="form-control" placeholder="Apellido del trabajador">
							{{ $errors -> first('a_paterno') }}
						</label>
					</div>
					<div class="col-sm-4 form-group"> 
						<label for="a_materno">
							Apellido Materno
							<input type="text" name="a_materno" value="{{old('a_materno')}}" class="form-control" placeholder="Apellido del trabajador">
							{{ $errors -> first('a_materno') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group"> 
						<label for="curp">
							CURP
							<input type="text" name="curp" id="curp" value="{{old('curp')}}" class="form-control" placeholder="CURP del trabajador">
							{{ $errors -> first('curp') }}
						</label>
					</div>
					<div class="col-sm-4 form-group"> 
						<label for="rfc">
							RFC
							<input type="text" name="rfc" id="rfc" value="{{old('rfc')}}" class="form-control" placeholder="RFC del trabajador">
							{{ $errors -> first('rfc') }}
						</label>
					</div>
					<div class="col-sm-4 form-group"> 
						<label for="seguro_social">
							Número de Seguro Social	
							<input type="text" name="seguro_social" value="{{old('seguro_social')}}" class="form-control" placeholder="Número de Seguro Social del trabajador">
							{{ $errors -> first('seguro_social') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group"> 
						<label for="id_estado_civil">
							Estado Civil<br>
							<select name="id_estado_civil" id='id_estado_civil'>
								<option value="0">Seleccione un Estado Civil</option>
								<@foreach($estadosciviles as $estadocivil)
									<option value="{{ $estadocivil -> id_estado_civil }}" @if(old('id_estado_civil') == $estadocivil -> id_estado_civil ) selected @endif>{{ $estadocivil -> estado_civil}}	
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_estado_civil') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group"> 
						<label for="id_estado">
							Estado<br>
							<select name="id_estado" id="id_estado">
								<option value="0">Seleccione un Estado</option>
								<@foreach($estados as $estado)
									<option value="{{ $estado -> id_estado }}" @if(old('id_estado') == $estado -> id_estado ) selected @endif>{{ $estado -> estado}}	
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
									<option value="{{ $municipio-> id_estado_municipio }}" @if(old('id_estado_municipio') == $municipio -> id_estado_municipio ) selected @endif>{{ $municipio -> municipio}}	
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_estado_municipio') }}
							</label>
					</div>
					<div class="col-sm-4 form-group"> 
						<label for="extranjero">
							Otro
							<input type="text" name="extranjero" value="{{old('extranjero')}}" class="form-control" placeholder="Lugar de Origen del trabajador">
							{{ $errors -> first('extranjero') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="calle">
							Calle	
							<input type="text" name="calle" value="{{old('calle')}}" class="form-control" placeholder="Domicilio del trabajador">
							{{ $errors -> first('calle') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="numero_interior">
							Número Interior
							<input type="text" name="numero_interior" value="{{old('numero_interior')}}" class="form-control" placeholder="Número interior">
							{{ $errors -> first('numero_interior') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="numero_exterior">
							Número Exterior
							<input type="text" name="numero_exterior" value="{{old('numero_exterior')}}" class="form-control" placeholder="Número exterior">
							{{ $errors -> first('numero_exterior') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="colonia">
							Colonia	
							<input type="text" name="colonia" value="{{old('colonia')}}" class="form-control" placeholder="Domicilio del trabajador">
							{{ $errors -> first('colonia') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="cp">
							Código Postal
							<input type="text" name="cp" value="{{old('cp')}}" class="form-control" placeholder="Código postal del trabajador">
							{{ $errors -> first('cp') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="telefono">
							Número(s) de Teléfono	
							<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Domicilio del trabajador">
							{{ $errors -> first('telefono') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="email">
							Correo Electrónico	
							<input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="mail@algo.com">
							{{ $errors -> first('email') }}
						</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="confrimaemail">
							Confirmación Correo Electrónico	
							<input type="email" name="confirmaemail" id="confirmaemail" value="{{old('confirmaemail')}}" class="form-control" placeholder="mail@algo.com">
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
									<option value="{{ $religion -> id_religion }}" @if(old('id_religion') == $religion -> id_religion ) selected @endif>{{ $religion -> religion }}
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_religion') }}
							</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="tipo_sangre">
							Tipo de Sangre	
							<input type="text" name="tipo_sangre" value="{{old('tipo_sangre')}}" class="form-control" placeholder="O positivo, O negativo, etc...">
							{{ $errors -> first('tipo_sangre') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="id_prep_academica">
							Grado Académico<br>
							<select name="id_prep_academica">
								<option value="0">Seleccione un Grado</option>
								<@foreach($prep_academicas as $prep_academica)
									<option value="{{ $prep_academica -> id_prep_academica }}" @if(old('id_prep_academica') == $prep_academica -> id_prep_academica ) selected @endif>{{ $prep_academica -> grado_academico }}
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_prep_academica') }}
							</label>
					</div>
					<div class="col-sm-4 form-group">
						<label for="area_conocimiento">
							Área del Conocimiento	
							<input type="text" name="area_conocimiento" value="{{old('area_conocimiento')}}" class="form-control" placeholder="Administración, física, etc...">
							{{ $errors -> first('area_conocimiento') }}
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 form-group">
						<label for="id_rol">
							Rol<br>
							<select name="id_rol" id="id_rol">
								<option value="0">Seleccione un Rol</option>
								<@foreach($roles as $rol)
									<option value="{{ $rol -> id_rol }}" @if(old('id_rol') == $rol -> id_rol ) selected @endif>{{ $rol -> rol}}
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_rol') }}
							</label>
						</div>
					<div class="col-sm-4 form-group">
						<label for="id_escolaridad">
							Área de Adscripción<br>
							<select name="id_escolaridad" id="id_escolaridad">
								<option value="0">Todas</option>
								@foreach($escolaridades as $escolaridad)
									<option value="{{ $escolaridad -> id_escolaridad }}" @if(old('id_escolaridad') == $escolaridad -> id_escolaridad ) selected @endif>{{ $escolaridad -> escolaridad}}
									</option>	
								@endforeach
							</select>
							{{ $errors -> first('id_escolaridad') }}
							</label>
					</div>
					</div>
				</div>
			</div>
	<div class="col-lg-12 well" id="contenedor_conyuge">
		<h3 align="center">
			Conyuge
		</h3>
		<div class="row">
			<div class="col-lg-12 form-group" align="center">
				<p id="p_es_empleado">
					<input type="checkbox" name="es_empleado" id="es_empleado" value="1" @if(old('es_empleado')==1) checked @endif data-toggle="toggle">El conyuge es trabajador<br>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 form-group" align="center">
				<div id="campo_trabajador" hidden>
					<label for="id_conyuge">
					Trabajador
					<select name="id_conyuge" id="id_conyuge">
						<option value="-1" style="display:none">Oculto</option>
						<option value="0">Seleccione un trabajador</option>
						@foreach($trabajadoresactivos as $trabajadoractivo)
							<option value="{{ $trabajadoractivo -> id_trabajador }}" @if(old('id_conyuge') == $trabajadoractivo -> id_trabajador ) selected @endif>{{ $trabajadoractivo -> nombre}}	
							</option>	
						@endforeach
					</select>
					{{ $errors -> first('id_conyuge') }}
					</label>
				</div>
			</div>
		</div>
		<div id='conyuges'>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="nombre_conyuge">
						Nombre(s) del Conyuge
						<input type="text" name="nombre_conyuge" id="nombre_conyuge" value="{{old('nombre_conyuge')}}" class="form-control" placeholder="Nombre(s) del conyuge">
							{{ $errors -> first('nombre_conyuge') }}
						</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="a_paterno_conyuge">
						Apellido Paterno del Conyuge
						<input type="text" name="a_paterno_conyuge" id="a_paterno_conyuge" value="{{old('a_paterno_conyuge')}}" class="form-control" placeholder="Apellido paterno del conyuge">
						{{ $errors -> first('a_paterno_conyuge') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="a_materno_conyuge">
						Apellido Materno del Conyuge
						<input type="text" name="a_materno_conyuge" id="a_materno_conyuge" value="{{old('a_materno_conyuge')}}" class="form-control" placeholder="Apellido materno del conyuge">
						{{ $errors -> first('a_materno_conyuge') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<label for="genero_conyuge">
						Género del Conyuge<br>
						<select name="genero_conyuge" id="genero_conyuge">
							<option value="NA">Seleccione un género</option>
							<option value="Masculino" @if(old('genero_conyuge') == 'Masculino' ) selected @endif>Masculino</option>
							<option value="Femenino" @if(old('genero_conyuge') == 'Femenino' ) selected @endif>Femenino</option>	
						</select>
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="fecha_de_nacimiento_conyuge">
						Fecha de Nacimiento del Conyuge
						<input type="date" name="fecha_de_nacimiento_conyuge" id="fecha_de_nacimiento_conyuge" value="{{old('fecha_de_nacimiento_conyuge')}}" class="form-control">
						{{ $errors -> first('fecha_de_nacimiento_conyuge') }}
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<label for="lugar_labora_conyuge">
						Lugar Donde Labora el Conyuge
						<input type="text" name="lugar_labora_conyuge" id="lugar_labora_conyuge" value="{{old('lugar_labora_conyuge')}}" class="form-control" placeholder="Lugar donde labora el conyuge">
						{{ $errors -> first('lugar_labora_conyuge') }}
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
					<input type="text" name="alergia" id="alergia" value="{{old('alergia')}}" class="form-control" placeholder="Alergia">
					{{ $errors -> first('alergia') }}
				</label>
			</div>
			<div class="col-sm-4 form-group">
				<label for="enfermedad">
					Enfermedad
					<input type="text" name="enfermedad" id="enfermedad" value="{{old('enfermedad')}}" class="form-control" placeholder="Enfermedad">
					{{ $errors -> first('enfermedad') }}
				</label>
			</div>
			<div class="col-sm-4 form-group">
				<label for="medicina">
					Medicamento
					<input type="text" name="medicina" id="medicina" value="{{old('medicina')}}" class="form-control" placeholder="Medicamento que toma">
					{{ $errors -> first('medicina') }}
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="cirugia">
					Cirugia
					<input type="text" name="cirugia" id="cirugia" value="{{old('cirugia')}}" class="form-control" placeholder="Cirugia">
					{{ $errors -> first('cirugia') }}
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="medico">
					Médico que le Atiende
					<input type="text" name="medico" id="medico" value="{{old('medico')}}" class="form-control" placeholder="Médico que le atiende">
					{{ $errors -> first('medico') }}
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="telefono_medico">
					Teléfono del Médico que le Atiende
					<input type="text" name="telefono_medico" id="telefono_medico" value="{{old('telefono_medico')}}" class="form-control" placeholder="Teléfono del Médico que le atiende">
					{{ $errors -> first('telefono_medico') }}
				</label>		
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="nombre_referencia1">
					Nombre de Alguna Referencia Personal
					<input type="text" name="nombre_referencia1" id="nombre_referencia1" value="{{old('nombre_referencia1')}}" class="form-control" placeholder="Referencia 1">
					{{ $errors -> first('nombre_referencia1') }}
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="telefono_referencia1">
					Teléfono de Alguna Referencia Personal
					<input type="text" name="telefono_referencia1" id="telefono_referencia1" value="{{old('telefono_referencia1')}}" class="form-control" placeholder="Teléfono de Referencia 1">
					{{ $errors -> first('telefono_referencia1') }}
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label for="nombre_referencia2">
					Nombre de una Segunda Referencia Personal
					<input type="text" name="nombre_referencia2" id="nombre_referencia2" value="{{old('nombre_referencia2')}}" class="form-control" placeholder="Referencia 1">
					{{ $errors -> first('nombre_referencia2') }}
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="telefono_referencia2">
					Teléfono de una Segunda Referencia Personal
					<input type="text" name="telefono_referencia2" id="telefono_referencia2" value="{{old('telefono_referencia2')}}" class="form-control" placeholder="Teléfono de Referencia 1">
					{{ $errors -> first('telefono_referencia2') }}
				</label>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<h3 align="center">
			Atecedentes Laborales
		</h3>
		<div class="row">
			<div class="col-lg-12 form-group" align="center">
				<p id="id_experiencia">
					<input type="checkbox" name="sin_experiencia" id="sin_experiencia" value="1" @if(old('sin_experiencia')==1) checked @endif>Sin Experiencia Previa<br>
				</p>
			</div>
		</div>
		<div class="row" id="sin_antecedentes">
			<div class="col-sm-6 form-group">
				<label for="trabajo_anterior">
					Trabajo Anterior
					<input type="text" name="trabajo_anterior" id="trabajo_anterior" value="{{old('trabajo_anterior')}}" class="form-control" placeholder="Trabajo anterior">
					{{ $errors -> first('trabajo_anterior') }}
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="puesto">
					Puesto
					<input type="text" name="puesto" id="puesto" value="{{old('puesto')}}" class="form-control" placeholder="Puesto">
					{{ $errors -> first('puesto') }}
				</label>
			</div>
		</div>
		<div class="row" id="sin_antecedentes2">
			<div class="col-sm-6 form-group">
				<label for="fecha_inicio">
					Fecha de Inicio
					<input type="date" name="fecha_inicio" id="fecha_inicio" value="{{old('fecha_inicio')}}" class="form-control" placeholder="01/01/2001">
					{{ $errors -> first('fecha_inicio') }}
				</label>
			</div>
			<div class="col-sm-6 form-group">
				<label for="fecha_termino">
					Fecha de Término
					<input type="date" name="fecha_termino" id="fecha_termino" value="{{old('fecha_termino')}}" class="form-control" placeholder="01/01/2001">
					{{ $errors -> first('fecha_termino') }}
				</label>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<h3 align="center">
			Familiares
		</h3>
		<div class="row">
			<div class="col-lg-12 form-group" align="center">
				<table id='tabla-familiares'>
					<tr>
						<td>
							<div>
								<label for="nombre_familiar">
									Nombre(s)
									<input type="text" name="nombre_familiar[]"  class="form-control" placeholder="Nombre(s)" style="width: 200px;">
									{{ $errors -> first('nombre_familiar[]') }}
								</label>
								<label for="a_paterno_familiar">
									Apellido Paterno
									<input type="text" name="a_paterno_familiar[]"  class="form-control" placeholder="Apellido paterno" style="width: 200px;">
									{{ $errors -> first('a_paterno_familiar[]') }}
								</label>
								<label for="a_materno_familiar">
									Apellido Materno
									<input type="text" name="a_materno_familiar[]"  class="form-control" placeholder="Apellido materno" style="width: 200px;">
									{{ $errors -> first('a_materno_familiar[]') }}
								</label>
								<label for="id_parentesco_familiar">
									Prentesco<br>
									<select name="id_parentesco_familiar[]">
										@foreach($parentescos as $parentesco)
											<option value="{{ $parentesco -> id_parentesco }}" >{{ $parentesco -> parentesco }}	
											</option>	
										@endforeach
									</select>
									{{ $errors -> first('id_parentesco_familiar[]') }}
								</label>
								<br>				
								<label for="fecha_nacimiento_familiar">
									Fecha de Nacimiento<br>
									<input type="date" name="fecha_nacimiento_familiar[]"  placeholder="01/01/01">
									{{ $errors -> first('fecha_nacimiento_familiar[]') }}
								</label>
								<label for="ocupacion_familiar">
									Ocupación
									<input type="text" name="ocupacion_familiar[]"  class="form-control" placeholder="Empleado, etc..." style="width: 200px;">
									{{ $errors -> first('ocupacion_familiar[]') }}
								</label>
								<label for="id_estado_civil_familiar">
								Estado Civil<br>
									<select name="id_estado_civil_familiar[]" value="{{old('telefono')}}">
										<option value="0">Seleccione un Estado Civil</option>
										<@foreach($estadosciviles as $estadocivil)
											<option value="{{ $estadocivil -> id_estado_civil }}" >{{ $estadocivil -> estado_civil}}	
											</option>	
										@endforeach
									</select>
									{{ $errors -> first('id_estado_civil_familiar[]') }}
								</label>
								<label for="vive_familiar">
									<input type="checkbox" name="vive_familiar[]" value="1" >Vive<br>
								</label>
							</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row" align="center">
			<div class="col-sm-4 form-group">
				<a id="boton_familiares" class="btn btn-primary">Agregar Registro</a>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="form-group pull-right">
				<button type="submit" id="boton_registrar_trabajador" class="btn btn-primary">Enviar</button>
				<a href="{{ route('Trabajador.index') }}" class="btn btn-primary">Regresar</a>
			</div>
		</div>		
	</div>
</div>
</form>

<script>
	$(function(){
    	////////logica onload
    	var estadocivil = null;
    	estadocivil = $('#id_estado_civil').find('option:selected').text();
    	if((estadocivil.substring(0,4)=='Solt') || (estadocivil.substring(0,4)=='Viud') || (estadocivil.substring(0,4)=='Divo')){
			$(document).ready(function(){
    			deshabilitarConyuge();
				$('#p_es_empleado').hide();
				$('#campo_trabajador').hide();
				$("#id_conyuge").val('-1');
				$("#contenedor_conyuge").hide();
			});
		}else{
			$(document).ready(function(){
    			if($('#es_empleado').is(':checked')){
					deshabilitarConyuge();
				}else{
					$('#p_es_empleado').show();
					habilitarConyuge();
					$.get('/ajax-getMaxTrabajador', function(data){
						$("#id_conyuge").val(data);
					});
				}
			});
		}

		$(document).ready(function(){
    		if($('#sin_experiencia').is(':checked')){
				deshabilitarAntecedentes();
			}else{
				habilitarAntecedentes();
			}
		});

    	///////////logica en cambios
    	$("#boton_registrar_trabajador").click(function(){
    		$("#registrar_trabajador").submit();
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

		$('#id_estado_civil').change( function (){
			estadocivil = $(this).find('option:selected').text();
			if((estadocivil.substring(0,4)=='Solt') || (estadocivil.substring(0,4)=='Viu') || (estadocivil.substring(0,4)=='Divor')){
				deshabilitarConyuge();
				$('#p_es_empleado').hide();
				$('#campo_trabajador').hide();
				$("#id_conyuge").val('-1');
				$("#contenedor_conyuge").hide();
			}else{
				$('#p_es_empleado').show();
				if($('#es_empleado').is(':checked')){
					deshabilitarConyuge();
					$("#id_conyuge").val('0');
					$("#conyuges").hide();
				}else{
					habilitarConyuge();
					$("#contenedor_conyuge").show();
					$("#conyuges").show();		
					$.get('/ajax-getMaxTrabajador', function(data){
						$("#id_conyuge").val(data);
					});
				}
			}
		});

		$('#curp').keyup(function(){
			var curp = $('#curp').val();
			if(curp.length < 11)
				$('#rfc').val($('#curp').val());
		});

		$('#es_empleado').click(function() {
			if(this.checked){
				deshabilitarConyuge();
				$("#id_conyuge").val('0');
				$("#conyuges").hide();
			}else{
				habilitarConyuge();
				$("#contenedor_conyuge").show();
				$("#conyuges").show();	
				$.get('/ajax-getMaxTrabajador', function(data){
					$("#id_conyuge").val(data);
				});
			}
		});

		$('#sin_experiencia').click(function() {
			if(this.checked){
				deshabilitarAntecedentes();
			}else{
				habilitarAntecedentes();
			}
		});

		$('#boton_familiares').click(function() {
			var $tableBody = $('#tabla-familiares').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$trNew = $trLast.clone();
			$trLast.after($trNew);
		});

		$('#sin_experiencia').click(function() {
			if(this.checked){
				deshabilitarAntecedentes();
			}else{
				habilitarAntecedentes();
			}
		});
	
	});

	function deshabilitarConyuge(){
		$("#nombre_conyuge").val('NA');
		$("#a_paterno_conyuge").val('NA');
		$("#a_materno_conyuge").val('NA');
		$("#genero_conyuge").val('NA');
		$("#fecha_de_nacimiento_conyuge").val('NA');
		$("#lugar_labora_conyuge").val('NA');
		$("#fecha_de_nacimiento_conyuge").val('2000-01-01');
		$("#genero_conyuge").val('Masculino');
		$("#campo_trabajador").show();
		$("#campo_trabajador").val('0');		
	}
	function habilitarConyuge(){
		$("#nombre_conyuge").prop( "disabled", false );
		if($("#nombre_conyuge").val()=='NA')
			$("#nombre_conyuge").val('');
		$("#a_paterno_conyuge").prop( "disabled", false );
		if($("#a_paterno_conyuge").val()=='NA')
			$("#a_paterno_conyuge").val('');
		$("#a_materno_conyuge").prop( "disabled", false );
		if($("#a_materno_conyuge").val()=='NA')
			$("#a_materno_conyuge").val('');
		$("#genero_conyuge").prop( "disabled", false );
		$("#genero_conyuge select").val("Masculino");
		$("#fecha_de_nacimiento_conyuge").prop( "disabled", false );
		if($("#fecha_de_nacimiento_conyuge").val()=='2000-01-01')
			$("#fecha_de_nacimiento_conyuge").val('');
		$("#lugar_labora_conyuge").prop( "disabled", false );
		if($("#lugar_labora_conyuge").val()=='NA')
			$("#lugar_labora_conyuge").val('');
		$("#campo_trabajador").hide();
	}

	function deshabilitarAntecedentes(){
		$("#trabajo_anterior").val('NA');
		$("#puesto").val('NA');
		$("#fecha_inicio").val('2000-01-01');
		$("#fecha_termino").val('2001-01-01');
		$("#sin_antecedentes").hide();
		$("#sin_antecedentes2").hide();
	}
	
	function habilitarAntecedentes(){
		$("#trabajo_anterior").prop( "disabled", false );
		if($("#trabajo_anterior").val()=='NA')
			$("#trabajo_anterior").val('');
		$("#puesto").prop( "disabled", false );
		if($("#puesto").val()=='NA')
			$("#puesto").val('');
		$("#fecha_inicio").prop( "disabled", false );
		if($("#fecha_inicio").val()=='2000-01-01')
			$("#fecha_inicio").val('');
		$("#fecha_termino").prop( "disabled", false );
		if($("#fecha_termino").val()=='2001-01-01')
			$("#fecha_termino").val('');
		$("#sin_antecedentes").show();
		$("#sin_antecedentes2").show();
	}

	var input = document.querySelector('#foto');
	var preview = document.querySelector('.preview');

input.style.opacity = 0;input.addEventListener('change', updateImageDisplay);function updateImageDisplay() {
  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  var curFiles = input.files;
  if(curFiles.length === 0) {
    var para = document.createElement('p');
    para.textContent = 'Sin archivo seleccionado.';
    preview.appendChild(para);
  } else {
    var list = document.createElement('ol');
    preview.appendChild(list);
    for(var i = 0; i < curFiles.length; i++) {
      var listItem = document.createElement('ul');
      var para = document.createElement('p');
      if(validFileType(curFiles[i])) {
        var image = document.createElement('img');
        image.src = window.URL.createObjectURL(curFiles[i]);

        listItem.appendChild(para);
        listItem.appendChild(image);

      } else {
        para.textContent = 'Archivo: ' + curFiles[i].name + ': No tiene formato válido.';
        listItem.appendChild(para);
      }

      list.appendChild(listItem);
    }
  }
}
var fileTypes = [
  'image/jpeg',
  'image/pjpeg',
  'image/png'
]

function validFileType(file) {
  for(var i = 0; i < fileTypes.length; i++) {
    if(file.type === fileTypes[i]) {
      return true;
    }
  }
  return false;
}
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
	
	form .label-foto {
	  padding: 5px 10px;
	  border-radius: 5px;
	  border: 1px ridge black;
	  background-color: #20193D !important;
	  height: 40px;
	  color: white;
	  cursor: pointer;
	}
	form ol {
	  padding-left: 0;
	}
	form img {
	  height: 100px;
	  order: -1;
	}
</style>
@endsection