@extends('layout')

@section('contenido')
	<div align="center"> 
			<h3 align="center">
				Lista Multipropósito<br>
			</h3>
			<h4 align="center">
				Ciclo Escolar {{ $grupo -> periodo -> periodo }}<br>
				Grupo: {{ $grupo -> escolaridad -> escolaridad }} {{ $grupo -> grupo }}<br>
			</h4>
		<table class="table-striped" id="tablaPeriodo" border="2">
			<thead>
				<tr>
					<td align="center" style="font-weight: bolder;">
						Alumno(a)
					</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
				</tr>
			</thead>
			<tbody>
		@if(count($alumnos) == 0)
				<tr>
					<td colspan="5" align="center">No hay datos para mostrar.</td>
				</tr>
			</tbody>
		</table>
		@else
			@for($i = 0; $i<count($alumnos); $i++)
				<tr>
					<td width="400px">
						{{ $alumnos[$i] -> nombre }}
					
						{{ $alumnos[$i] -> a_paterno }}
					
						{{ $alumnos[$i] -> a_materno }}
					</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					<td class="espacio">&nbsp</td>
					
				</tr>
			@endfor
			</tbody>
		</table>
		<br>
		<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary pull-right">Regresar</a>
		<form method="POST" action="{{ route('PrintList') }}">
			{!! csrf_field() !!}
			<input type="text" name="grupo" hidden="hidden" value="{{ $grupo -> id_grupo }}">	
			<input type="submit" value="Imprimir" class="btn btn-primary pull-right">
		</form>
		@endif
	</div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.espacio{
		width: 50px;
	}
</style>
@endsection