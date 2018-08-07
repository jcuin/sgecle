@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Escolaridades
			<a href="{{ route('Escolaridad.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Escolaridad','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaEscolaridad">
			<thead>
				<tr>
					<th>
						@sortablelink('id_escolaridad')
					</th>
					<th>
						@sortablelink('escolaridad')
					</th>
					<th>
						@sortablelink('nomenclatura_grupos')
					</th>
					<th>
						@sortablelink('horario')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($escolaridades -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($escolaridades as $escolaridad)
						<tr>
							<td>
								{{ $escolaridad -> id_escolaridad }}
							</td>
							<td>
								{{ $escolaridad -> escolaridad }}
							</td>
							<td>
								{{ $escolaridad -> nomenclatura_grupos }}
							</td>
							<td>
								{{ $escolaridad -> horario }}
							</td>
							<td>
								<a href="{{ route('Escolaridad.show', $escolaridad -> id_escolaridad)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Escolaridad.edit', $escolaridad -> id_escolaridad)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Escolaridad.destroy', $escolaridad -> id_escolaridad)}}">
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
		{!! $escolaridades->appends(\Request::except('page'))->render() !!}
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
