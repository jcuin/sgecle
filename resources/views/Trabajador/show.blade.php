@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Empleado(a): {{ $trabajador -> nombre }} {{ $trabajador -> a_paterno }} {{ $trabajador -> a_materno }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-3 col-lg-3 " align="center"> <img width="130px" src="{{ Storage::url($trabajador -> foto) }}"> 
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>CURP:</td>
                        <td>{{ $trabajador -> curp }}</td>
                      </tr>
                      <tr>
                        <td>RFC:</td>
                        <td>{{ $trabajador -> rfc }}</td>
                      </tr>
                      <tr>
                        <td>Fecha de Nacimiento:</td>
                        <td>{{ substr($trabajador -> curp,8,2) }}/{{ substr($trabajador -> curp,6,2) }}/{{substr($trabajador -> curp,4,2) }}</td>
                      </tr>
                      <tr>
                        <td>Género:</td>
                        <td>{{ substr($trabajador -> curp,10,1) }}</td>
                      </tr>
                      <tr>
                        <td>RFC:</td>
                        <td>{{ $trabajador -> rfc }}</td>
                      </tr>
                      <tr>
                        <td>Seguro Social:</td>
                        <td>{{ $trabajador -> seguro_social}}</td>
                      </tr>
                      <tr>
                        <td>Estado Civil:</td>
                        <td>{{ $trabajador -> estadoCivil -> estado_civil }}</td>
                      </tr>	
                      <tr>
                        <td>Dirección:</td>
                        <td>{{ $trabajador -> calle }} {{ $trabajador -> numero_interior }}
							{{ $trabajador -> numero_exterior }}<br>{{ $trabajador -> colonia }}<br>
							{{ $trabajador -> cp }}<br>
							{{ $trabajador -> municipio -> municipio }}<br>
							{{ $trabajador -> extranjero }}<br></td>
                      </tr>
                      <tr>
                        <td>Teléfono de Contacto:</td>
                        <td>{{ $trabajador -> telefono }}</td>
                      </tr>
                      <tr>
                        <td>Correo Electrónico:</td>
                        <td>{{ $trabajador -> email }}</td> 
                      </tr>
                      <tr>
                        <td>Religión:</td>
                        <td>{{ $trabajador -> religion -> religion }}</td> 
                      </tr>
                      <tr>
                        <td>Grado Académico:</td>
                        <td>{{ $trabajador -> gradoAcademico -> grado_academico }} {{ $trabajador -> area_conocimiento }}</td> 
                      </tr>
                      <tr>
                        <td>Tipo de Sangre:</td>
                        <td>{{ $trabajador -> tipo_sangre }}</td> 
                      </tr>
                      <tr>
                        <td>Rol:</td>
                        <td>{{ $trabajador -> user -> roles[0] -> rol }}</td> 
                      </tr>
                     </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-conyuge" align="center">Conyuge</h3>
                <div id="panel-conyuge"> 
                  <table class="table table-user-information">
                    <tbody>
                      @if($conyuge != null)
                        <tr>
                          <td>Nombre:</td>
                          <td>{{ $conyuge -> nombre }}</td> 
                        </tr>
                        <tr>
                          <td>Apellidos:</td>
                          <td>{{ $conyuge -> a_paterno }} {{ $conyuge -> a_materno }}</td> 
                        </tr>
  						          @if($conyuge_x_trabajador -> es_trabajador == 1)
  							          <tr>
  	                        <td colspan="2">Labora con nosotros</td>
  	                      </tr>	
  						          @else
  						            <tr>
  						              <td>Labora en:</td>	
  	                        <td>{{ $conyuge -> lugar_labora }}</td>
  	                      </tr>
  						          @endif
					            @else
                        <tr>
                            <td colspan="2">Ninguno(a).</td> 
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-antecedentes" align="center">Antecedentes Laborales</h3>
                <div id="panel-antecedentes"> 
                  <table class="table table-user-information">
                    <tbody>
                    @if($antecedente -> sin_experiencia == 1)
                      <tr>
                        <td colspan="2">Sin experiencia laboral previa.</td>
                      </tr>
                    @else
                      <tr>
                        <td>Trabajo Anterior:</td>
                        <td>{{ $antecedente -> trabajo_anterior }}</td>
                      </tr>
                      <tr>
                        <td>Puesto Desempeñado:</td>
                        <td>{{ $antecedente -> puesto }}</td>
                      </tr>
                      <tr>
                        <td>Fecha de Inicio:</td>
                        <td>{{ $antecedente -> inicio }}</td>
                      </tr>
                      <tr>
                        <td>Fecha de Término:</td>
                        <td>{{ $antecedente -> termino }}</td>
                      </tr>
                    @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-padecimientos" align="center">Padecimientos</h3>
                <div id="panel-padecimientos"> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Alergias:</td>
                        <td>{{ $padecimiento -> alergia }}</td>
                      </tr>
                      <tr>
                        <td>Enfermedades:</td>
                        <td>{{ $padecimiento -> enfermedad }}</td>
                      </tr>
                      <tr>
                        <td>Medicamentos:</td>
                        <td>{{ $padecimiento -> medicina }}</td>
                      </tr>
                      <tr>
                        <td>Cirugias:</td>
                        <td>{{ $padecimiento -> cirugia }}</td>
                      </tr>
                      <tr>
                        <td>Médico Tratante:</td>
                        <td>{{ $padecimiento -> medico }}</td>
                      </tr>
                      <tr>
                        <td>Tel. Médico Tratante:</td>
                        <td>{{ $padecimiento -> tel_medico }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-familiares" align="center">Familiares</h3>
                <div id="panel-familiaress"> 
                  <table class="table table-user-information">
                    <tbody>
                    @if(count($familiares) == 0)
                      <tr>
                        <td colspan="2">Sin familiares registrados.</td>
                      </tr>
                    @else
                      @for($i = 0; $i < count($familiares); $i++)
                        <tr>
                          <td>Nombre:</td>
                          <td>{{ $familiares[$i] -> nombre }} {{ $familiares[$i] -> a_paterno }} {{ $familiares[$i] -> a_materno }}</td>
                        </tr>
                        <tr>
                          <td>Prentesco:</td>
                          <td>{{ $familiares[$i] -> parentesco -> parentesco }}</td>
                        </tr>
                        <tr>
                          <td>Fecha de Nacimiento:</td>
                          <td>{{ $familiares[$i] -> fecha_nacimiento }}</td>
                        </tr>
                        <tr>
                          <td>Estado Civil:</td>
                          <td>{{ $familiares[$i] -> estadoCivil -> estado_civil }}</td>
                        </tr>
                        <tr>
                          <td>Ocupación:</td>
                          <td>{{ $familiares[$i] -> ocupacion }}</td>
                        </tr>
                        <tr>
                          <td>¿Vive?:</td>
                          <td>{{ $familiares[$i] -> vive == 1 ? 'Si' : 'No'}}</td>
                        </tr>
                      @endfor
                    @endif
                    </tbody>
                  </table>
                </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('Trabajador.edit', $trabajador-> id_trabajador) }}" class="btn btn-primary">Editar</a>
                		</td>
                		<td><form method="POST" action="{{ route('Trabajador.destroy', $trabajador -> id_trabajador)}}">
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
                    			<a href="{{ route('Trabajador.index') }}" class="btn btn-primary">Regresar</a>
                			</span>
                		</td>
                	</tr>
                </table>         
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
		$('#titulo-conyuge').css('cursor', 'pointer');
    $('#titulo-antecedentes').css('cursor', 'pointer');
    $('#titulo-padecimientos').css('cursor', 'pointer');
    $('#titulo-familiares').css('cursor', 'pointer');
		$('#panel-conyuge').hide();
    $('#panel-padecimientos').hide();
    $('#panel-antecedentes').hide();
    $('#panel-familiaress').hide();
		$("#titulo-conyuge").click(function(){
			$('#panel-conyuge').slideToggle( "slow" );
		});
    $("#titulo-padecimientos").click(function(){
      $('#panel-padecimientos').slideToggle( "slow" );
    });
    $("#titulo-antecedentes").click(function(){
      $('#panel-antecedentes').slideToggle( "slow" );
    });
    $("#titulo-familiares").click(function(){
      $('#panel-familiaress').slideToggle( "slow" );
    });
	});
</script>   
@endsection