@extends('layout')

@section('contenido')
<form method="POST" id="registrar_propuestas" enctype="multipart/form-data" action="{{ route('storePropuesta') }}">
	{!! csrf_field() !!}
	<input type="text" name="resumen_propuestas" id="resumen_propuestas" value='' hidden="hidden">
	<input type="text" name="id_planeacion" value="{{ $id_planeacion }}" hidden="hidden">
	<div class="container">
    <h1 align="center">Registro de Propuesta</h1>
    <div class="col-lg-12 well">
		<h3 align="center">
			Propuesta
		</h3>
		<div class="col-sm-12">
			<table id='tabla-propuestas'>
				<tr>
					<td>
						<button class="delete pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label for="propuesta">
									Archivo
									<input type="text" name="propuesta_oculto[]" id="propuesta_oculto" class="oculto" value="0" hidden="hidden">
									<input type="file" name="propuesta[]" class="arch" id="archi-0">
									<span class="help-block">
										{{ $errors -> first('propuesta[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-6 form-group">
								<label for="fecha_de_uso">
									Fecha de Utilización
									<input type="date" name="fecha_de_uso[]" class="form-control" min="{{ date("Y-m-d") }}">
									<span class="help-block">
										{{ $errors -> first('fecha_de_uso[]') }}
									</span>
								</label>
							</div>
							<div class="col-sm-6 form-group">
								<label for="detalles">
									Observaciones
									<textarea name="detalles[]" id="detalles" rows="4" cols="50" placeholder="Observaciones de la propuesta..."></textarea>	
									{{ $errors -> first('detalles[]') }}
								</label>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="col-sm-12 form-group">
				<a id="boton_propuestas" class="btn btn-primary pull-right">Agregar Propuesta</a>
			</div>
		</div>
	</div>
	<div class="col-lg-12 well">
		<div class="row">
			<div class="form-group pull-right">
				<button type="submit" id="registrar_propuestas" class="btn btn-primary">Enviar</button>
				<a href="{{ route('Planeacion.show', $id_planeacion) }}" class="btn btn-primary">Regresar</a>
			</div>
		</div>		
	</div>
</div>
</form>

<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="file"] {
    	width: 500px;
	}
	textarea {
		resize: none;
	}
</style>
<script>
	$(function(){
    // your logic here`enter code here`
		$('#boton_propuestas').click(function() {
			var $tableBody = $('#tabla-propuestas').find("tbody");
			$trLast = $tableBody.find("tr:last");
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete").show();
			$trNew.find(".delete").attr("id", "delete-"+(Number($auxvalor)+1));
			nuevoId = 'archi-'+(Number($auxvalor)+1);
			$trNew.find(".arch").attr("id", nuevoId);
			$trLast.after($trNew);
		});

		$('#registrar_propuestas').submit(function() {
			valor = '';
			$("input[name='propuesta[]']").each( function(){
		  		if(this.value !== ''){
		  			idvar = this.id.split("-");
		  			idvar = idvar[1];
		  			valor = valor+idvar+'-';
		  			$('#resumen_propuestas').attr('value', valor);
		  		}
		 	});
		  	return true;
		});

		$('.delete').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
@endsection