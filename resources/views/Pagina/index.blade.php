@extends('layout')

@section('contenido')
	<div class="col-sm-6"> 
		<h1>
			Listado de Páginas
			<a href="{{ route('Pagina.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Pagina','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaPagina">
			<thead>
				<tr>
					<th>
						desde
					</th>
					<th>
						hasta
					</th>
					<th>
						@sortablelink('descripcion')
					</th>
					<th colspan="3" align="center">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
				@if($paginas -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($paginas as $pagina)
						<tr>
							<td>
								{{ $pagina -> desde }}
							</td>
							<td>
								{{ $pagina -> hasta }}
							</td>
							<td>
								{{ $pagina -> descripcion }}
							</td>
							<td>
								@if( $pagina -> activo == 0 )
									<a href="{{ route('PaginaUse', $pagina -> id) }}" class="btn btn-primary">Publicar</a>
								@else
									Publicado
								@endif
							</td>
							<td>
								<a href="{{ route('Pagina.show', $pagina -> id) }}" class="btn btn-primary">Ver</a>
							</td>
							<td colspan="2">
								@if( $pagina -> activo == 0 )
									<form method="POST" action="{{ route('Pagina.destroy', $pagina-> id)}}">
										{!! method_field('DELETE') !!}
									 	{!! csrf_field() !!}
										<button type="submit" class="btn btn-primary">Eliminar</button>
									</form>
								@else
									Imposible eliminar
								@endif					
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $paginas->appends(\Request::except('page'))->render() !!}
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
