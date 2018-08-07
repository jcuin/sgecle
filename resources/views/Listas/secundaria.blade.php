<table align="center">
	<tr>
		<td align="center"><img src="{{ URL::asset('images/logo.png') }}" class="logo" alt=""></td>
		<td colspan="16" align="center" style="width: 600px"><h2>Colegio Fernández de Lizardi</h2></td>
	</tr>
	<tr>
		<td colspan="17" align="center"><h3>Lista Multipropósito</h3></td>
	</tr>
	<tr>
		<td colspan="17" align="center" style="font-weight: bolder;">Ciclo Escolar: {{ $periodo }}</td>
	</tr>
	<tr>
		<td colspan="17" align="center" style="font-weight: bolder;">{{ $escolaridad }} {{ $grupo }}</td>
	</tr>
	<tr>
		<td colspan="17" align="center" style="height: 20px;"></td>
	</tr>
	@if(count($alumnos) == 0)
		<tr>
			<td colspan="24" align="center">No hay datos para mostrar.</td>
		</tr>
	</table>
	@else
		<tr>
			<td align="center" style="font-weight: bolder; border: 1px solid;">Alumno</td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
			<td style="width: 60px; border: 1px solid;"></td>
		</tr>
		@for($i = 0; $i < count($alumnos) ; $i++)
			<tr>
				<td style="width: 200px; border: 1px solid;">
					{{ $alumnos[$i] -> nombre }}
			
					{{ $alumnos[$i] -> a_paterno }}
			
					{{ $alumnos[$i] -> a_materno }}
				</td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>
				<td style="width: 60px; border: 1px solid;"></td>	
			</tr>
		@endfor
	</table>
	@endif
</style>

