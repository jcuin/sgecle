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
                	<h3 class="panel-title" id="titulo-rol" align="center">{{ $rol-> rol_key }}</h3>
              	</div>
                <div class="row">
                  <h3 class="panel-title" id="titulo-rol_key" align="center">{{ $rol-> rol }}</h3>
                </div>
                 <div class="row">
                  <h3 class="panel-title" id="titulo-rol_descripcion" align="center">{{ $rol-> descripcion }}</h3>
                </div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('Rol.edit', $rol-> id_rol)}}" class="btn btn-primary">Editar</a>
                		</td>
                		<td><form method="POST" action="{{ route('Rol.destroy', $rol-> id_rol)}}">
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
		               			<a href="{{ route('Rol.index') }}" class="btn btn-primary">Regresar</a>
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
				
			