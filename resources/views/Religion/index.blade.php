@extends('layout')

@section('contenido')
	<div class="col-sm-8" > 
		<h1>
			Catálogo de Religiones
			<a href="{{ route('Religion.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Religion','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaReligion">
			<thead>
				<tr>
					<th>
						@sortablelink('id_religion')
					</th>
					<th>
						@sortablelink('religion')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($religiones -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($religiones as $religion)
						<tr>
							<td>
								{{ $religion -> id_religion }}
							</td>
							<td>
								{{ $religion -> religion }}
							</td>
							<td>
								<a href="{{ route('Religion.show', $religion -> id_religion)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Religion.edit', $religion -> id_religion)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Religion.destroy', $religion-> id_religion)}}">
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
		{!! $religiones->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection
