@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Estados Civiles
			<a href="{{ route('EstadoCivil.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'EstadoCivil','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
						@sortablelink('id_estado_civil')
					</th>
					<th>
						@sortablelink('estado_civil')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($estados_civiles -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($estados_civiles as $estado_civil)
						<tr>
							<td>
								{{ $estado_civil -> id_estado_civil }}
							</td>
							<td>
								{{ $estado_civil -> estado_civil }}
							</td>
							<td>
								<a href="{{ route('EstadoCivil.show', $estado_civil -> id_estado_civil)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('EstadoCivil.edit', $estado_civil -> id_estado_civil)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('EstadoCivil.destroy', $estado_civil-> id_estado_civil)}}">
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
		{!! $estados_civiles->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection
