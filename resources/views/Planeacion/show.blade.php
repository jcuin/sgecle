@extends('layout')

@section('contenido')
	<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Planeación</h3>
            </div>
            <div class="panel-body">
            	@if (session('info'))
                            <strong>
                              <div class="alert alert-success alert-dismissable fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  {{ session('info') }}
                              </div>
                            </strong>
                          @endif
                          @if (session('error'))
                            <strong>
                              <div class="alert alert-danger alert-dismissable fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  {{ session('error') }}
                              </div>
                            </strong>
                          @endif
              <div class="row">
                <div class="col-lg-3 col-lg-3 " align="center"> <a href="{{ route('downloadFile', $planeacion -> id_planeacion.'-1') }}" class="btn btn-primary">Descargar</a>
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                    	<tr>
	                        <td>Semana:</td>
	                        <td>
	                        	@if($planeacion -> anual == 1) 
	                        		Anual 
	                        	@else 
	                        		{{ $planeacion -> semana }} 
	                        	@endif
	                        </td>
	                    </tr>
                        <tr>
	                        <td>Comentarios:</td>
	                        <td>{{ $planeacion -> comentarios }}</td>
	                    </tr>
	                    <tr>
	                        <td>Entregado el:</td>
	                        <td>{{ $planeacion -> created_at }}</td>
	                    </tr>
	                    <tr>
	                        <td>Estatus:</td>
	                        <td>
	                        	@if($planeacion -> enviar == 1)
	                        		Enviada el {{ $planeacion -> enviado_el }}
	                        	@else
	                        		Pendiente de envío
	                        	@endif
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td colspan="2">
	                    		<a href="{{ route('editPlaneacion', $planeacion -> id_planeacion) }}" class="btn btn-primary pull-right">Editar</a>
	                    	</td>
	                    </tr>
	                </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-anexos" align="center">Anexos</h3>
                <div id="panel-anexos"> 
                  <table class="table table-user-information">
                    <tbody>
                      @if(count($anexos) > 0)
	                    @foreach($anexos as $anexo)
						  <tr>
						  	<td>Número de Copias Solicitadas:</td>
						  	<td>{{ $anexo -> numero_copias }}</td>
						  </tr>
						  <tr>
						  	<td>Fecha de Uso:</td>
						  	<td>{{ $anexo -> fecha_de_uso }}</td>
						  </tr>	
						  <tr>
					       	<td colspan="2"><a href="{{ route('downloadFile', $anexo -> id_anexo.'-2') }}" class="btn btn-primary">Descargar</a></td>
		                   </tr>
			   			@endforeach
			   			 <tr>
	                    	<td colspan="2">
	                    		<a href="{{ route('editAnexo', $planeacion -> id_planeacion) }}" class="btn btn-primary pull-right">Editar</a>
	                    	</td>
	                    </tr>
		   			  @else
						  <tr>
						  	<td colspan="2" align="center">Sin anexos</td>
						  </tr>
					  @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-propuestas" align="center">Propuestas</h3>
                <div id="panel-propuestas"> 
                  <table class="table table-user-information">
                    <tbody>
                    	@if(count($propuestas) > 0)
	                    	@foreach($propuestas as $propuesta)
		                      <tr>
		                        <td>Fecha de Uso:</td>
		                        <td>{{ $propuesta -> fecha_de_uso }}</td>
		                      </tr>
		                      <tr>
		                        <td>Observaciones:</td>
		                        <td>{{ $propuesta -> detalles }}</td>
		                      </tr>
		                      <tr>
		                      	@if($propuesta -> archivo  === 'ninguno')
		                    		<td colspan="2">
		                    			Sin archivo
		                    		</td>
		                    	@else
		                    	<td colspan="2"><a href="{{ route('downloadFile', $propuesta -> id_propuesta.'-3') }}" class="btn btn-primary">Descargar</a></td>
		                    	@endif
		                      </tr>
                    		@endforeach
                    		<tr>
	                    	<td colspan="2">
	                    		<a href="{{ route('editPropuesta', $planeacion -> id_planeacion) }}" class="btn btn-primary pull-right">Editar</a>
	                    	</td>
	                    </tr>
		   			  	@else
						  <tr>
						  	<td colspan="2" align="center">Sin propuestas</td>
						  </tr>
						  <tr>
	                    	<td colspan="2">
	                    		<a href="{{ route('createPropuesta', $planeacion -> id_planeacion) }}" class="btn btn-primary pull-right">Crear Propuesta</a>
	                    	</td>
	                      </tr>
						@endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td>
                			<div style="width: 35px"></div>
                		</td>
                		<td><form method="POST" action="{{ route('Planeacion.destroy', $planeacion -> id_planeacion)}}">
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
                    			<a href="{{ route('Planeacion.index') }}" class="btn btn-primary">Regresar</a>
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
		$('#titulo-anexos').css('cursor', 'pointer');
    	$('#titulo-propuestas').css('cursor', 'pointer');
		$('#panel-anexos').hide();
		$('#panel-propuestas').hide();
		$("#titulo-anexos").click(function(){
			$('#panel-anexos').slideToggle( "slow" );
		});
		$("#titulo-propuestas").click(function(){
			$('#panel-propuestas').slideToggle( "slow" );
		});
	});
</script>
@endsection