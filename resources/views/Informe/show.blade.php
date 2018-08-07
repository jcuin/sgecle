@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Mostrando...</h3>
            </div>
            <div class="panel-body">
              	<div class="row">
                	<h3 class="panel-title" align="center">
                		Enviado por: {{ $informe -> nombre }}
                	</h3>
              	</div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    Datos de Contacto: 
                  </h3>
                  <h4 class="panel-title" align="center">
                    E-mail: {{ $informe -> email }} <br>
                    Teléfono: {{ $informe -> telefono }} 
                  </h4>
                </div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    Asunto: {{ $informe -> asunto }}
                  </h3>
                </div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    Mensaje: {{ $informe -> mensaje }}
                  </h3>
                </div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                    <td>
                      <form method="POST" action="{{ route('InformeAttention') }}">
                        {!! method_field('POST') !!}
                        {!! csrf_field() !!}
                        <input type="text" name="id_informe" id="id_informe" hidden="hidden" value="{{ $informe -> id }}">    
                        @if( $informe -> atendido == 0 )
                          <button type="submit" class="btn btn-primary">Atender</button>
                        @elseif( $informe -> atendido == 1 )
                          <div style="width: 45px;"></div>
                        @endif
                      </form>
                    </td>
                		<td>
                      <form method="POST" action="{{ route('Informe.destroy', $informe -> id) }}">
        								{!! method_field('DELETE') !!}
        							 	{!! csrf_field() !!}
        								<button type="submit" class="btn btn-primary">Eliminar</button>
        							</form>
                		</td>
                		<td>
		           			<div style="width: 280px"></div>
		           		</td>
		           		<td>
		           			<span class="pull-right">
                      <a href="{{ route('Informe.index') }}" class="btn btn-primary">Regresar</a>
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
@endsection