@extends('layout')

@section('contenido')
	<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Alumno(a): {{ $alumno -> nombre }} {{ $alumno -> a_paterno }} {{ $alumno -> a_materno }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-3 col-lg-3 " align="center"> <img width="130px" src="{{ Storage::url($alumno -> foto) }}"> 
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>CURP:</td>
                        <td>{{ $alumno -> curp }}</td>
                      </tr>
                      <tr>
                        <td>Fecha de Nacimiento:</td>
                        <td>{{ $alumno -> fecha_nacimiento }}</td>
                      </tr>
                      <tr>
                        <td>Sexo:</td>
                        <td>{{ $alumno -> sexo }}</td>
                      </tr>
                      <tr>
                        <td>Teléfono de Contacto:</td>
                        <td>{{ $alumno -> telefono }}</td>
                      </tr>
                      <tr>
                        <td>Correo Electrónico:</td>
                        <td>{{ $alumno -> email }}</td> 
                      </tr>
                      <tr>
                        <td>Observaciones:</td>
                        <td>{{ $alumno -> padecimientos }}</td> 
                      </tr>
                      <tr>
                        <td>Padre o Tutor:</td>
                        <td>{{ $alumno -> padre_o_tutor }}</td> 
                      </tr>
                      <tr>
                        <td>Trabajador:</td>
                        <td>@if($alumno -> trabajador == false) No @else Sí @endif</td> 
                      </tr>
                      <tr>
                        <td>Hijo de Trabajador:</td>
                        <td>@if($alumno -> hijo_trabajador == false) No @else Sí @endif</td> 
                      </tr>
                      <tr>
                        <td>Número de Control:</td>
                        <td>{{ $alumno -> no_control }}</td> 
                      </tr>
                      <tr>
                        <td>Carrera:</td>
                        <td>{{ $alumno -> carrera -> nombre_carrera }}</td> 
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('Alumno.edit', $alumno-> id_alumno) }}" class="btn btn-primary">Editar</a>
                		</td>
                		<td><form method="POST" action="{{ route('Alumno.destroy', $alumno -> id_alumno)}}">
								{!! method_field('DELETE') !!}
				 				{!! csrf_field() !!}
								<button type="submit" class="btn btn-primary">Eliminar</button>
							</form>
                		</td>
                		<td>
                			<div style="width: 285px"></div>
                		</td>
                		<td>
                			<span class="pull-right">
                    			<a href="{{ route('Alumno.index') }}" class="btn btn-primary">Regresar</a>
                			</span>
                		</td>
                	</tr>
                </table>         
            </div>       
          </div>
        </div>
    </div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.panel-heading {
  		background-color: #20193D !important;
	}
	.panel-title {
		color: #D10F20 !important;
	}
</style>
<script>
	$(function(){
		$('#panel-padres').hide();
		$('#panel-contactos').hide();
		$('#panel-padecimientos').hide();
		$('#panel-expediente').hide();
		$('#titulo-padres').css('cursor', 'pointer');
		$('#titulo-contactos').css('cursor', 'pointer');
		$('#titulo-padecimientos').css('cursor', 'pointer');
		$('#titulo-expediente').css('cursor', 'pointer');
		$("#titulo-padres").click(function(){
			$('#panel-padres').slideToggle( "slow" );
		});
		$("#titulo-padecimientos").click(function(){
			$('#panel-padecimientos').slideToggle( "slow" );
		});
		$("#titulo-contactos").click(function(){
			$('#panel-contactos').slideToggle( "slow" );
		});
		$("#titulo-expediente").click(function(){
			$('#panel-expediente').slideToggle( "slow" );
		});
	});
</script>
@endsection