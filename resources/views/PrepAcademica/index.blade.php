@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Grados Acacémicos
			<a href="{{ route('PrepAcademica.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'PrepAcademica','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaPrepAcademica">
			<thead>
				<tr>
					<th>
						@sortablelink('id_prep_academica')
					</th>
					<th>
						@sortablelink('grado_academico')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($prepacademicas -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($prepacademicas as $prepacademica)
						<tr>
							<td>
								{{ $prepacademica -> id_prep_academica }}
							</td>
							<td>
								{{ $prepacademica -> grado_academico }}
							</td>
							<td>
								<a href="{{ route('PrepAcademica.show', $prepacademica -> id_prep_academica)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('PrepAcademica.edit', $prepacademica -> id_prep_academica)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('PrepAcademica.destroy', $prepacademica-> id_prep_academica)}}">
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
		{!! $prepacademicas->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
