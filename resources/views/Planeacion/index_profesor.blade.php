@extends('layout')

@section('contenido')
		<div class="col-sm-8"> 
		<h1>
			Catálogo de Planeaciones
			<a href="{{ route('Planeacion.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Materia','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaPeriodo">
			<thead>
				<tr>
					<th>
						@sortablelink('id_planeacion')
					</th>
					<th>
						@sortablelink('id_trabajador')
					</th>
					<th>
						Semana
					</th>
					<th>
						Comentarios
					</th>
					<th>
						Creado el
					</th>
					<th>
						Enviado el
					</th>
					<th>
						Anexos
					</th>
					<th>
						Propuestas
					</th>
					<th colspan="3">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($planeaciones -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($planeaciones as $planeacion)
						<tr>
							<td>
								{{ $planeacion -> id_planeacion }}
							</td>
							<td>
								{{ $planeacion -> propietario -> nombre }}
							</td>
	                        <td>
	                        	@if($planeacion -> anual == 1) 
	                        		Anual 
	                        	@else 
	                        		{{ $planeacion -> semana }} 
	                        	@endif
	                        </td>
							<td>
								{{ $planeacion -> comentarios }}
							</td>
							<td>
								{{ $planeacion -> created_at }}
							</td>
							<td>
								{{ $planeacion -> enviado_el }}
							</td>
							<td>
								{{count($planeacion -> anexos )}}
							</td>
							<td>
								{{count($planeacion -> propuestas )}}
							</td>
							<td>
								<a href="{{ route('Planeacion.show', $planeacion -> id_planeacion) }}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Planeacion.destroy', $planeacion -> id_planeacion)}}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-primary">Eliminar</button>
								</form>
							</td>
							<td>
								@if( $planeacion -> enviar == 0 )
									<form method="POST" action="{{ route('PlaneacionSend') }}">
										{!! method_field('POST') !!}
									 	{!! csrf_field() !!}
									 	<input type="text" name="id_planeacion" id="id_planeacion" hidden="hidden" value="{{ $planeacion -> id_planeacion }}">
										<button type="submit" class="btn btn-primary">Enviar</button>
									</form>
								@elseif( $planeacion -> enviar == 1 )
									Enviada
								@endif
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $planeaciones->appends(\Request::except('page'))->render() !!}		
	</div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
