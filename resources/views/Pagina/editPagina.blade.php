@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('updatePagina')}}" enctype="multipart/form-data">
	{!! csrf_field() !!}
	<input type="text" name="id_pagina" value="{{ $id }}" hidden="hidden">
	<div class="container">
	    <h1 align="center">Registro de Página</h1>
		<div class="col-lg-12 well">
			<h3 align="center">
				Banner Principal 
			</h3>
			<div class="col-sm-12">
				<div class="row" align="center">
					<table class='tabla-pagina'>
						<tr>
							<td>
								<label for="descripcion">
									Descripción
									<input type="text" name="descripcion" placeholder="Descripción de la configuración" value="{{ $pagina -> descripcion }}">
									{{ $errors -> first('descripcion') }}
								</label>
							</td>
						</tr>
						<tr id="banner_imagen">
							<td>
								<label for="banner_principal_imagen">
									Imagen del Banner
									<img width="130px" src="{{ Storage::url($pagina -> banner_principal_imagen) }}">
									<input type="file" name="banner_principal_imagen" value="{{old('banner_principal_imagen')}}" accept="image/*">
									{{ $errors -> first('banner_principal_imagen') }}
								</label>
							</td>
						</tr>
						@if(count($banner_principal_texto) > 1)	
							@for($i = 1; $i < count($banner_principal_texto); $i++)
								<tr id="banner_texto">
									<td>
										@if($i>1)
											<button class="delete_texto_banner pull-right" style="background-color: #20193D; color: white">X</button>
										@endif
										<input type="text" name="banner_principal_oculto[]" id="banner_principal_oculto" class="oculto" value="{{ $i }}" hidden="hidden">
										<label for="banner_principal_texto">
											Texto del Banner Principal
											<input type="text" name="banner_principal_texto[]"  class="form-control" placeholder="Texto Transición" value="{{ $banner_principal_texto[$i] }}" style="width: 200px;" required="required">
											{{ $errors -> first('banner_principal_texto[]') }}
										</label>						
									</td>
								</tr>
								@endfor
							@else
								<tr id="banner_texto">
									<td>
										<button class="delete_texto_banner pull-right" style="background-color: #20193D; color: white" hidden="hidden">X</button>
										<input type="text" name="banner_principal_oculto[]" id="banner_principal_oculto" class="oculto" value="0" hidden="hidden">
										<label for="banner_principal_texto">
											Texto del Banner Principal
											<input type="text" name="banner_principal_texto[]"  class="form-control" placeholder="Texto Transición" style="width: 200px;" required="required">
											{{ $errors -> first('banner_principal_texto[]') }}
										</label>						
									</td>
								</tr>
							@endif
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-4 form-group pull-right">
				<a id="boton_banner" class="btn btn-primary">Agregar Texto del Banner</a>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Pagina.show', $id) }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
    	////////logica onload
   		$('#boton_banner').click(function() {
			var $tableBody = $('.tabla-pagina').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_texto_banner").show();
			$trNew.find(".delete_texto_banner").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});
		$('.delete_texto_banner').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
</style>
@endsection