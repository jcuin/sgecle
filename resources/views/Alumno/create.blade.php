@extends('layout')

@section('contenido')
<form method="POST" id="registrar_alumno" enctype="multipart/form-data" action="{{ route('Alumno.store') }}">
	{!! csrf_field() !!}
	<div class="container"> 
    <h1 align="center">Registro de Alumno(a)</h1>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12 form-group" align="center">
					<label for="foto" class="label-foto">
						Foto del Alumno
						<input type="file" id="foto" name="foto" value="{{old('foto')}}" placeholder="foto(s) del Alumno" accept="image/*">
						<span class="help-block">
							{{ $errors -> first('foto') }}
						</span>
					</label>
					<div class="preview">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Nombres</span>
						<input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre(s) del Alumno">
					</div>
						<span class="help-block">
							{{ $errors -> first('nombre') }}
						</span>
					</label>
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Apellido Paterno</span>
						<input type="text" name="a_paterno" value="{{old('a_paterno')}}" class="form-control" placeholder="Apellido del Alumno">
					</div>
					{{ $errors -> first('a_paterno') }}
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Apellido Materno</span>
						<input type="text" name="a_materno" value="{{old('a_materno')}}" class="form-control" placeholder="Apellido del Alumno">
					</div>
					{{ $errors -> first('a_materno') }}
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">CURP</span>
						<input type="text" name="curp" value="{{old('curp')}}" class="form-control" placeholder="CURP del Alumno">
					</div>
					{{ $errors -> first('curp') }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-4 form-group">	
					<div class="input-group">
						<span class="input-group-addon">Teléfono</span>	
						<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono del Alumno">
					</div>
					{{ $errors -> first('telefono') }}
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Correo Electrónico</span>
						<input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="mail@algo.com">
					</div>
					{{ $errors -> first('email') }}
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Confirma Correo Electrónico</span>
						<input type="email" name="confirmaemail" id="confirmaemail" value="{{old('confirmaemail')}}" class="form-control" placeholder="mail@algo.com">
					</div>
					{{ $errors -> first('confirmaemail') }}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Fecha de Nacimiento</span>
						<input type="date" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" class="form-control" max="{{ date("Y-m-d") }}">
					</div>
					{{ $errors -> first('fecha_nacimiento') }}
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Sexo</span>
						<select name="sexo">
							<option value="F" @if(old('sexo') == 'F') selected @endif>Femenino</option>
							<option value="M"  @if(old('sexo') == 'M') selected @endif>Masculino</option>
						</select>
					</div>
					{{ $errors -> first('sexo') }}
				</div>
				<div class="col-sm-4 form-group">
					<div class="input-group">
						<span class="input-group-addon">Padre o Tutor</span>
						<input type="text" name="padre_o_tutor" value="{{old('padre_o_tutor')}}" class="form-control" placeholder="Padre o Tutor del Alumno">
					</div>
						<span class="help-block">
							{{ $errors -> first('padre_o_tutor') }}
						</span>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="col-sm-4 form-group">
				<div class="input-group">
					<span class="input-group-addon">Número de Control</span>
					<input type="text" name="no_control" value="{{old('no_control')}}" class="form-control" placeholder="Número de Control">
				</div>
				{{ $errors -> first('no_control') }}
			</div>
			<div class="col-sm-4 form-group">
				<div class="input-group">
					<span class="input-group-addon">Carrera</span>
					<select name="id_carrera">
						@foreach($carreras as $carrera)
							<option value="{{ $carrera -> id_carrera }}" @if(old('id_carrera') == $carrera -> id_carrera ) selected @endif>{{ $carrera -> nombre_reducido}}	
							</option>	
						@endforeach
					</select>
					{{ $errors -> first('id_carrera') }}
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="row">
				<div class="input-group">
					<span class="input-group-addon">Observaciones</span>
					<input type="text" name="padecimiento" value="{{old('padecimiento')}}" class="form-control" placeholder="Padecimientos(s) del Alumno">
				</div>
				{{ $errors -> first('padecimiento') }}
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="col-sm-12">
			<div class="col-sm-4 form-group">
				<div class="row">
					El Alumno es:
					<div class="input-group">	
						<input type="radio" name="extras" value="1">Trabajador ITM<br>
						<input type="radio" name="extras" value="2">Hijo de Trabajador ITM<br>
						<input type="radio" name="extras" value="0" checked="checked">Ninguno
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="form-group pull-right">
				<button type="submit" id="boton_registrar_alumno" class="btn btn-primary">Enviar<i class="fa fa-paper-plane-o ml-2"></i></button>
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
<script>
	$(function(){
    // your logic here`enter code here`

    	///////////logica en cambios
    	$("#boton_registrar_alumno").click(function(){
    		$("#registrar_alumno").submit();
    	});

	});

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
@endsection