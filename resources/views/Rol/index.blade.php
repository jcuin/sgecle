@extends('layout')

@section('contenido')
	<div class="col-sm-8" align="center"> 
		<h1>
			Catálogo de Roles
			<a href="{{ route('Rol.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Rol','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaRol">
			<thead>
				<tr>
					<th>
						@sortablelink('id_rol')
					</th>
					<th>
						@sortablelink('rol_key')
					</th>
					<th>
						@sortablelink('rol')
					</th>
					<th>
						Descripción
					</th>
				</tr>
			</thead>
			<tbody>
			@if($roles-> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($roles as $rol)
						<tr>
							<td>
								{{ $rol -> id_rol }}
							</td>
							<td>
								{{ $rol -> rol_key }}
							</td>
							<td>
								{{ $rol -> rol }}
							</td>
							<td>
								{{ $rol -> descripcion }}
							</td>
							<td>
								<a href="{{ route('Rol.show', $rol -> id_rol)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Rol.edit', $rol -> id_rol)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Rol.destroy', $rol-> id_rol)}}">
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
		{!! $roles->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection
