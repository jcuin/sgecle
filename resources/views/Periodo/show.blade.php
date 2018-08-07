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
                		{{ $periodo -> periodo }}
                	</h3>
              	</div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    De: {{ $periodo -> inicio }}  A: {{ $periodo -> termino }} 
                  </h3>
                </div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    Trimestre Preescolar Activo: {{ $periodo -> trimestre_preescolar }}
                  </h3>
                </div>
                <div class="row">
                  <h3 class="panel-title" align="center">
                    Bimestre Primaria Activo: {{ $periodo -> bimestre_primaria }}
                  </h3>
                </div>
                <div class="row">
                  <h3 class="panel-title" id="titulo-padres" align="center">
                    Bimestre Secundaria Activo: {{ $periodo -> bimestre_secundaria }}
                  </h3>
                </div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('Periodo.edit', $periodo-> id_periodo)}}" class="btn btn-primary">Editar</a>
                		</td>
                		<td><form method="POST" action="{{ route('Periodo.destroy', $periodo -> id_periodo)}}">
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
		               			<a href="{{ route('Periodo.index') }}" class="btn btn-primary">Regresar</a>
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