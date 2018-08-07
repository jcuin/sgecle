@extends('layout')

@section('contenido')
	<div align="center" style="overflow: scroll;"> 
	<?php 
		$alumno_cero = $boletas[0] -> curp;
		$contador = 0;
		$no_ceros_bt1 = 0;
		$no_ceros_bt2 = 0;
		$no_ceros_bt3 = 0;
		$no_ceros_bt4 = 0;
		$no_ceros_bt5 = 0;
		$numero_inasistencias1 = 0;
		$numero_inasistencias2 = 0;
		$numero_inasistencias3 = 0;
		$numero_inasistencias4 = 0;
		$numero_inasistencias5 = 0;
		$promedio_bimestre1 = 0;
		$promedio_bimestre2 = 0;
		$promedio_bimestre3 = 0;
		$promedio_bimestre4 = 0;
		$promedio_bimestre5 = 0;
		$promedio_materia = 0;
		$contador_materia = 0;
		$promedio_materia_total = 0;
		$contador_materia_total = 0;
	?>
			<table align="center" border="1">
				<tr>
					<td align="center" colspan="2"><img src="{{ URL::asset('images/logo.png') }}" class="logo" alt="Colegio Fernández de Lizardi"></td>
					<td align="center" colspan="6"><h2>Colegio Fernández de Lizardi</h2></td>
				</tr>
				<tr>
					<td align="center" colspan="8"><h4>Boleta de Calificaciones</h4></td>
				</tr>
				<tr>
					<td align="center" colspan="8" style="font-weight: bolder;">Ciclo Escolar: {{ $periodo }}</td>
				</tr>
				<tr>
					<td style="font-weight: bolder;" align="center" colspan="8">
						{{ $escolaridad }} {{ $grupo -> grupo }}
						<br />
					</td>
				</tr>
			</table>
				
	@for($i = 0; $i < count($boletas) ; $i++)	
		@if($contador == 0)
			<table align="center" border="1" width="684px">
				<tr>
					<td style="font-weight: bolder;" colspan="8">
						{{ $boletas[$i] -> nombre }}
						{{ $boletas[$i] -> a_paterno }}
						{{ $boletas[$i] -> a_materno }}
					</td>
				</tr>
				<tr>
					<td style="width: 25px;"></td>
					<td style="font-weight: bolder;" align="center">ASIGNATURA</td>
					<td style="font-weight: bolder;" align="center">I</td>
					<td style="font-weight: bolder;" align="center">II</td>
					<td style="font-weight: bolder;" align="center">III</td>
					<td style="font-weight: bolder;" align="center">IV</td>
					<td style="font-weight: bolder;" align="center">V</td>
					<td style="font-weight: bolder;" align="center">FINAL</td>
				</tr>
		@endif
			<?php
				$contador++;

				$numero_inasistencias1 = $numero_inasistencias1 + $boletas[$i] -> numero_inasistencias1;
				$numero_inasistencias2 = $numero_inasistencias2 + $boletas[$i] -> numero_inasistencias2;
				$numero_inasistencias3 = $numero_inasistencias3 + $boletas[$i] -> numero_inasistencias3;
				$numero_inasistencias4 = $numero_inasistencias4 + $boletas[$i] -> numero_inasistencias4;
				$numero_inasistencias5 = $numero_inasistencias5 + $boletas[$i] -> numero_inasistencias5;

				if(floatval($boletas[$i] -> promediobt1) > 0){
					$promedio_bimestre1 = $promedio_bimestre1 + $boletas[$i] -> promediobt1;
					$promedio_materia = $promedio_materia + $boletas[$i] -> promediobt1;
					$contador_materia++;
					$no_ceros_bt1++;
				}
				if(floatval($boletas[$i] -> promediobt2) > 0){
					$promedio_bimestre2 = $promedio_bimestre2 + $boletas[$i] -> promediobt2;
					$promedio_materia = $promedio_materia + $boletas[$i] -> promediobt2;
					$contador_materia++;
					$no_ceros_bt2++;
				}			
				if(floatval($boletas[$i] -> promediobt3) > 0){
					$promedio_bimestre3 = $promedio_bimestre3 + $boletas[$i] -> promediobt3;
					$promedio_materia = $promedio_materia + $boletas[$i] -> promediobt3;
					$contador_materia++;
					$no_ceros_bt3++;
				}
				if(floatval($boletas[$i] -> promediobt4) > 0){
					$promedio_bimestre4 = $promedio_bimestre4 + $boletas[$i] -> promediobt4;
					$promedio_materia = $promedio_materia + $boletas[$i] -> promediobt4;
					$contador_materia++;
					$no_ceros_bt4++;
				}
				if(floatval($boletas[$i] -> promediobt5) > 0){
					$promedio_bimestre5 = $promedio_bimestre5 + $boletas[$i] -> promediobt5;
					$promedio_materia = $promedio_materia + $boletas[$i] -> promediobt5;
					$contador_materia++;
					$no_ceros_bt5++;
				}
			?>
			<tr>
				<td align="center" style="width: 25px">{{ $contador }}</td><td>{{ $boletas[$i] -> materia }}</td>
				<td align="center">@if(number_format($boletas[$i] -> promediobt1,2) > 0) {{ number_format($boletas[$i] -> promediobt1,2) }}@endif</td>
				<td align="center">@if(number_format($boletas[$i] -> promediobt2,2) > 0) {{ number_format($boletas[$i] -> promediobt2,2) }}@endif</td>
				<td align="center">@if(number_format($boletas[$i] -> promediobt3,2) > 0) {{ number_format($boletas[$i] -> promediobt3,2)  }}@endif</td>
				<td align="center">@if(number_format($boletas[$i] -> promediobt4,2) > 0) {{ number_format($boletas[$i] -> promediobt4,2)  }}@endif</td>
				<td align="center">@if(number_format($boletas[$i] -> promediobt5,2) > 0) {{ number_format($boletas[$i] -> promediobt5,2)  }}@endif</td>
				<td align="center">@if($promedio_materia > 0){{ number_format($promedio_materia / $contador_materia,2) }}@endif</td>
				<?php
					$promedio_materia_total = $promedio_materia_total + $promedio_materia;
					$contador_materia_total++;
					$promedio_materia = 0; 
					$contador_materia = 0;
				?>
			</tr>
		@if($contador == count($grupo -> materias))
				<tr>
					<td colspan="8">&nbsp;</td>
				</tr>
				<tr>
					<td style="width: 30px; font-weight: bolder;" align="center" colspan="2">Promedio</td>
					<td align="center" style="width: 40px;">@if((number_format($promedio_bimestre1,2) > 0)) {{ number_format($promedio_bimestre1 / $no_ceros_bt1,2) }}@endif</td>
					<td align="center" style="width: 40px;">@if((number_format($promedio_bimestre2,2) > 0)) {{ number_format($promedio_bimestre2 / $no_ceros_bt2,2) }}@endif</td>
					<td align="center" style="width: 40px;">@if((number_format($promedio_bimestre3,2) > 0)) {{ number_format($promedio_bimestre3 / $no_ceros_bt3,2) }}@endif</td>
					<td align="center" style="width: 40px;">@if((number_format($promedio_bimestre4,2) > 0)) {{ number_format($promedio_bimestre4 / $no_ceros_bt4,2) }}@endif</td>
					<td align="center" style="width: 40px;">@if((number_format($promedio_bimestre5,2) > 0)) {{ number_format($promedio_bimestre5 / $no_ceros_bt5,2) }}@endif</td>
					<td align="center" style="width: 40px;">{{ number_format( $promedio_materia_total / $contador_materia_total,2) }}
					</td>
					<?php $promedio_bimestre1 = 0; $promedio_bimestre2 = 0; $promedio_bimestre3 = 0; $promedio_bimestre4 = 0; $promedio_bimestre5 = 0;
					?>
				</tr>
				<tr>
					<td style="width: 30px; font-weight: bolder;" align="center" colspan="2">Inasistencias</td>
					<td align="center">{{ $numero_inasistencias1 }}</td>
					<td align="center">{{ $numero_inasistencias2 }}</td>
					<td align="center">{{ $numero_inasistencias3 }}</td>
					<td align="center">{{ $numero_inasistencias4 }}</td>
					<td align="center">{{ $numero_inasistencias5 }}</td>
					<td align="center">{{ $numero_inasistencias1 + $numero_inasistencias2 + $numero_inasistencias3 + $numero_inasistencias4 + $numero_inasistencias5}}</td>
					<?php $numero_inasistencias1 = 0; 
						$numero_inasistencias2 = 0; 
						$numero_inasistencias3 = 0; 
						$numero_inasistencias4 = 0; 
						$numero_inasistencias5 = 0; 

						$promedio_materia_total = 0;
						$contador_materia_total = 0;
					?>
				</tr>
			</table>
			<div class="page-break"></div>
			<?php
				$alumno_cero = $boletas[$i] -> curp;
				$contador = 0;
				$no_ceros_bt1 = 0;
				$no_ceros_bt2 = 0;
				$no_ceros_bt3 = 0;
				$no_ceros_bt4 = 0;
				$no_ceros_bt5 = 0;
			?>
		@endif
	@endfor
	</div>
	<br>
		<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary pull-right">Regresar</a>
		<form method="POST" action="{{ route('PrintBoleta') }}">
			{!! csrf_field() !!}
			<input type="text" name="grupo" hidden="hidden" value="{{ $grupo -> id_grupo }}">	
			<input type="submit" value="Imprimir" class="btn btn-primary pull-right">
		</form>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.espacio{
		width: 50px;
	}
</style>
@endsection