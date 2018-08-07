@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Catálogo de Periodos
			<a href="{{ route('Periodo.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Periodo','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
						@sortablelink('id_periodo')
					</th>
					<th>
						@sortablelink('periodo')
					</th>
					<th>
						Trimestre Prescolar
					</th>
					<th>
						Bimestre Primaria
					</th>
					<th>
						Bimestre Secundaria
					</th>
				</tr>
			</thead>
			<tbody>
			@if($periodos -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($periodos as $periodo)
						<tr>
							<td>
								{{ $periodo -> id_periodo }}
							</td>
							<td>
								{{ $periodo -> periodo }}
							</td>
							<td>
								{{ $periodo -> trimestre_preescolar }}
							</td>
							<td>
								{{ $periodo -> bimestre_primaria }}
							</td>
							<td>
								{{ $periodo -> bimestre_secundaria }}
							</td>
							<td>
								<a href="{{ route('Periodo.show', $periodo -> id_periodo)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Periodo.edit', $periodo -> id_periodo)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Periodo.destroy', $periodo-> id_periodo)}}">
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
		{!! $periodos->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
			.btn-primary{
				background-color: #20193D !important;
			}
		</style>@endsection
