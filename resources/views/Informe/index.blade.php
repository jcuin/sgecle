@extends('layout')

@section('contenido')
	<div class="col-sm-8"> 
		<h1>
			Informes
			<a href="{{ route('Informe.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Informe','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
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
						@sortablelink('id')
					</th>
					<th>
						@sortablelink('nombre')
					</th>
					<th>
						@sortablelink('email')
					</th>
					<th>
						@sortablelink('telefono')
					</th>
					<th>
						@sortablelink('asunto')
					</th>
					<th colspan="2">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($informes -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay informes pendientes.</td>
					</tr>
				@else
					@foreach($informes as $informe)
						<tr>
							<td>
								{{ $informe -> id }}
							</td>
							<td>
								{{ $informe -> nombre }}
							</td>
							<td>
								{{ $informe -> email }}
							</td>
							<td>
								{{ $informe -> telefono }}
							</td>
							<td>
								{{ $informe -> asunto }}
							</td>
							<td>
								<a href="{{ route('Informe.show', $informe -> id)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<form method="POST" action="{{ route('InformeAttention') }}">
									{!! method_field('POST') !!}
									{!! csrf_field() !!}
									<input type="text" name="id_informe" id="id_informe" hidden="hidden" value="{{ $informe -> id }}">		
									@if( $informe -> atendido == 0 )
										<button type="submit" class="btn btn-primary">Atender</button>
									@elseif( $informe -> atendido == 1 )
										Resuelto
									@endif
								</form>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $informes -> appends(\Request::except('page'))->render() !!}		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
