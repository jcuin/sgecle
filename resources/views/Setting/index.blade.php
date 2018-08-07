@extends('layout')

@section('contenido')
	<div style=" overflow: scroll;"> 
		<h1 align="center">
			Configuración del Sistema
		</h1>
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
		<table class="table table-hover table-striped" id="tablaPeriodo">
			<thead>
				<tr>
					<th>
						Clave Preescolar
					</th>
					<th>
						Clave Primaria
					</th>
					<th>
						Clave Secundaria
					</th>
					<th>
						Zona Escolar
					</th>
					<th>
						RFC
					</th>
					<th>
						Razón Social
					</th>
					<th>
						Domicilio
					</th>
					<th>
						Teléfono
					</th>
					<th>
						Correo Electrónico
					</th>
					<th>
						Periodo
					</th>
					<th>
						Dirección General
					</th>
					<th>
						Dirección Preescolar
					</th>
					<th>
						Dirección Primaria
					</th>
					<th>
						Dirección Secundaria
					</th>
					<th>
						Dirección Inglés
					</th>
					<th>
						Costo Colegiatura
					</th>
				</tr>
			</thead>
			<tbody>
			@if($setting == null)
					<tr>
						<td colspan="16" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					
						<tr>
							<td>
								{{ $setting -> clave_preescolar }}
							</td>
							<td>
								{{ $setting -> clave_primaria }}
							</td>
							<td>
								{{ $setting -> clave_secundaria }}
							</td>
							<td>
								{{ $setting -> zona_escolar }}
							</td>
							<td>
								{{ $setting -> rfc_colegio }}
							</td>
							<td>
								{{ $setting -> razon_social }}
							</td>
							<td>
								{{ $setting -> domicilio }}
							</td>
							<td>
								{{ $setting -> telefono_contacto }}
							</td>
							<td>
								{{ $setting -> correo_electronico }}
							</td>
							@if($setting -> periodo != null)
								<td>
									{{ $setting -> periodo -> periodo }}
								</td>
							@endif
							<td>
								{{ $setting -> direccion_general }}
							</td>
							<td>
								{{ $setting -> direccion_preescolar }}
							</td>
							<td>
								{{ $setting -> direccion_primaria }}
							</td>
							<td>
								{{ $setting -> direccion_secundaria }}
							</td>
							<td>
								{{ $setting -> direccion_ingles }}
							</td>
							<td>
								{{ $setting -> costo_colegiatura }}
							</td>
							<td>
								<a href="{{ route('Setting.edit', $setting -> id)}}" class="btn btn-primary">Editar</a>
							</td>
						</tr>
				@endif
			</tbody>
		</table>
	</div>		
	<a href="{{ route('Panel.index') }}" class="btn btn-primary pull-right">Regresar</a>	
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
