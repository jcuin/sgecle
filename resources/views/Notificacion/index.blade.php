@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Notificaciones
			<a href="{{ route('Notificacion.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Notificacion','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaNotificacion">
			<thead>
				<tr>
					<th>
						@sortablelink('id_notificacion')
					</th>
					<th>
						Emisor
					</th>
					<th>
						Destinatario
					</th>
					<th>
						Grupo
					</th>
					<th>
						Materia
					</th>
					<th>
						Alumno
					</th>
					<th>
						Rol
					</th>
					<th>
						@sortablelink('mensaje')
					</th>
					<th>
						@sortablelink('caducidad')
					</th>
					<th colspan="4">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($notificaciones -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($notificaciones as $notificacion)
						<tr>
							<td>
								{{ $notificacion -> id_notificacion }}
							</td>
							<td>
								{{ $notificacion -> emisor -> nombre }}
							</td>
							<td>
								@if($notificacion -> trabajador != null )
									{{ $notificacion -> trabajador -> nombre }} {{ $notificacion -> trabajador -> a_paterno }} {{ $notificacion -> trabajador -> a_materno }}
								@else
									NA
								@endif
							</td>
							<td>
								@if($notificacion -> grupo != null )
									{{ $notificacion -> grupo -> grupo }}
								@else
									NA
								@endif
							</td>
							<td>
								@if($notificacion -> materia != null )
									{{ $notificacion -> materia -> materia }}
								@else
									NA
								@endif
							</td>
							<td>
								@if($notificacion -> alumno != null )
									{{ $notificacion -> alumno -> nombre }} {{ $notificacion -> alumno -> a_paterno }} {{ $notificacion -> alumno -> a_materno }}
								@else
									NA
								@endif
							</td>
							<td>
								@if($notificacion -> rol != null )
									{{ $notificacion -> rol -> rol_key }}
								@else
									NA
								@endif
							</td>
							<td>
								{{ substr($notificacion -> mensaje,0,15) }}...
							</td>
							<td>
								{{ $notificacion -> caducidad }}
							</td>
							<td>
								<a href="{{ route('Notificacion.show', $notificacion -> id_notificacion) }}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Notificacion.edit', $notificacion -> id_notificacion) }}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Notificacion.destroy', $notificacion-> id_notificacion)}}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-primary">Eliminar</button>
								</form>
							</td>
							@if( auth() -> user() -> hasRoles(['dir_general', 'director']) )
								<td>
									<form method="POST" action="{{ route('NotificacionPublish') }}">
										{!! method_field('POST') !!}
									 	{!! csrf_field() !!}
									 	<input type="text" name="id_notificacion" id="id_notificacion" hidden="hidden" value="{{ $notificacion -> id_notificacion }}">
										<button type="submit" class="btn btn-primary">
											@if( $notificacion -> publicar == 0 )
												Publicar
											@elseif( $notificacion -> publicar == 1 )
												Suspender Publicación
											@endif
										</button>
									</form>
								</td>
							@endif
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $notificaciones -> appends(\Request::except('page'))->render() !!}		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
