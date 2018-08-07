@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Municipios
			<a href="{{ route('Municipio.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Municipio','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaMunicipio">
			<thead>
				<tr>
					<th>
						@sortablelink('id_estado_municipio')
					</th>
					<th>
						@sortablelink('id_estado')
					</th>
					<th>
						Estado
					</th>
					<th>
						@sortablelink('id_municipio')
					</th>
					<th>
						@sortablelink('municipio')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($municipios -> isEmpty())
				<tr>
					<td colspan="5" align="center">No hay datos para mostrar.</td>
				</tr>
			@else
				@foreach($municipios as $municipio)
					<tr>
						<td>
							{{ $municipio -> id_estado_municipio }}
						</td>
						<td>
							{{ $municipio -> id_estado }}
						</td>
						<td>
							<a href="{{ route('Municipio.show', $municipio -> estado -> id_estado)}}"> {{ $municipio -> estado -> estado}}</a>
						</td>
						<td>
							{{ $municipio -> id_municipio }}
						</td>
						<td>
							{{ $municipio -> municipio }}
						</td>
						<td>
							<a href="{{ route('Municipio.show', $municipio -> id_estado_municipio)}}" class="btn btn-primary">Ver</a>
						</td>
						<td>
							<a href="{{ route('Municipio.edit', $municipio -> id_estado_municipio)}}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form method="POST" action="{{ route('Municipio.destroy', $municipio -> id_estado_municipio)}}">
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
		{!! $municipios->appends(\Request::except('page'))->render() !!}
		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
