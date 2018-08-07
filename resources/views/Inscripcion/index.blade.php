@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Inscripciones
			<!--<a href="{{ route('Inscripcion.create') }}" class="btn btn-primary pull-right">Nuevo</a>-->
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
    	{!! Form::open(['method'=>'GET','url'=>'Inscripcion','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaEstadoCivil">
			<thead>
				<tr>
					<th>
						@sortablelink('id_grupo')
					</th>
					<th>
						@sortablelink('grupo')
					</th>
					<th>
						Capacidad
					</th>
					<th>
						Alumnos Inscritos
					</th>
					<th colspan="3">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($grupos -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($grupos as $grupo)
						<tr>
							<td>
								{{ $grupo -> id_grupo }}
							</td>
							<td>
								{{ $grupo -> grupo }}
							</td>
							<td>
								{{ $grupo -> capacidad }}
							</td>
							
								@for($i = 0; $i < count($inscritos_por_grupo); $i++)
									@if(($inscritos_por_grupo[$i] -> id_grupo == $grupo -> id_grupo))
										<td>
											{{ $inscritos_por_grupo[$i] -> inscritos }}
										</td>
										<td>
											<a href="{{ route('Calificacion.show', $grupo -> id_grupo)}}" class="btn btn-primary">Subir Calificaciones</a>
										</td>
										<td>
											<a href="{{ route('InscripcionList', $grupo -> id_grupo)}}" class="btn btn-primary">Ver Listas</a>
										</td>
										@if( auth() -> user() -> hasRoles(['dir_general', 'director']) )
											<td>
												<a href="{{ route('InscripcionBoleta', $grupo -> id_grupo)}}" class="btn btn-primary">Generar Boleta</a>
											</td>
											<td>
												<a href="{{ route('GrupoEstad', $grupo -> id_grupo."-".$inscritos_por_grupo[$i] -> inscritos)}}" class="btn btn-primary">Estadísticas</a>
											</td>
										@endif		
									@endif
								@endfor
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $grupos->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.unselectable{
    	background-color: #ddd;
    	cursor: not-allowed;
	}
</style>
@endsection
