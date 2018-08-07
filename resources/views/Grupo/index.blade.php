@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Grupos
			<a href="{{ route('Grupo.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	@if (session('materias_asociadas'))
    		<strong>
    			<div class="alert alert-success alert-dismissable fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			{{ session('materias_asociadas') }}
    			</div>
    		</strong>
    	@endif
    	@if (session('error_materias'))
    		<strong>
    			<div class="alert alert-success alert-dismissable fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			{{ session('error_materias') }}
    			</div>
    		</strong>
    	@endif
    	{!! Form::open(['method'=>'GET','url'=>'Grupo','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
						@sortablelink('id_periodo')
					</th>
					<th>
						Periodo
					</th>
					<th>
						@sortablelink('id_escolaridad')
					</th>
					<th>
						Escolaridad
					</th>
					<th>
						@sortablelink('id_grupo')
					</th>
					<th>
						@sortablelink('grupo')
					</th>
					<th>
						Capacidad
					</th>
					<th colspan="4">
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
								{{ $grupo -> id_periodo }}
							</td>
							<td>
								{{ $grupo -> periodo -> periodo }}
							</td>
							<td>
								{{ $grupo -> id_escolaridad }}
							</td>
							<td>
								{{ $grupo -> escolaridad -> escolaridad }}
							</td>
							<td>
								{{ $grupo -> id_grupo }}
							</td>
							<td>
								{{ $grupo -> grupo }}
							</td>
							<td>
								{{ $grupo -> capacidad }}
							</td>
							<td>
								<a href="{{ route('Grupo.show', $grupo -> id_grupo)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Grupo.edit', $grupo -> id_grupo)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<a href="{{ route('GrupoAsocia', $grupo -> id_grupo)}}" class="btn btn-primary">Asociar Materias</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Grupo.destroy', $grupo-> id_grupo)}}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-primary">Eliminar</button>
								</form>
							</td>
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
		</style>
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection
