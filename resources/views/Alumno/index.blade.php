@extends('layout')

@section('contenido')
	<div class="col-med-8" align="center"> 
		<h1>
			Listado de Alumnos
			<a href="{{ route('Alumno.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Alumno','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaTrabajador">
			<thead>
				<tr>
					<th>
						@sortablelink('id_alumno')
					</th>
					<th>
						@sortablelink('nombre')
					</th>
					<th>
						@sortablelink('a_paterno')
					</th>
					<th>
						@sortablelink('a_materno')
					</th>
					<th>
						@sortablelink('telefono')
					</th>
					<th>
						@sortablelink('email')
					</th>
					<th colspan="3" align="center">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($alumnos-> isEmpty())
					<tr>
						<td colspan="18" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($alumnos as $alumno)
						<tr>
							<td>
								{{ $alumno -> id_alumno }}
							</td>
							<td>
								{{ $alumno -> nombre }}
							</td>
							<td>
								{{ $alumno -> a_paterno }}
							</td>
							<td>
								{{ $alumno -> a_materno }}
							</td>
							<td>
								{{ $alumno -> telefono }}
							</td>
							<td>
								{{ $alumno -> email }}
							</td>
							<td>
								<a href="{{ route('AlumnoRegister', $alumno -> id_alumno) }}" class="btn btn-primary">Inscribir</a>
							</td>
							<td>
								<a href="{{ route('Alumno.show', $alumno -> id_alumno) }}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Alumno.edit', $alumno -> id_alumno) }}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Alumno.destroy', $alumno-> id_alumno)}}">
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
	{!! $alumnos->appends(\Request::except('page'))->render() !!}		
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
@endsection
