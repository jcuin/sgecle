@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Calendario de Actividades</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                	@if(count($eventos) > 0)
	                    @foreach($eventos as $evento)
	                      <strong>
	                        <div class="alert alert-info alert-dismissable fade in">
	                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                            {{ $evento -> fecha_evento }}. De: {{ $evento -> hora_inicio }} hrs. A: {{ $evento -> hora_fin }} hrs.<br><u>{{ $evento -> evento }}</u><br>{{ $evento -> descripcion }}
	                        </div>
	                      </strong>
	                    @endforeach
                  	@else
	                  	<strong>
		                    <div class="alert alert-info alert-dismissable fade in">
		                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		                        <i>Sin eventos programados</i>
		                    </div>
		                </strong>
                  	@endif
                </div>
            </div>
            <div class="panel-footer">
                <table>
                  <tr>
                    <td>
                    </td>
                    <td>  
                    </td>
                    <td>
                    <div style="width: 440px"></div>
                  </td>
                  <td>
                    <span class="pull-right">
                        <a href="{{ route('Panel.index') }}" class="btn btn-primary">Regresar</a>
                    </span>
                  </td>
                  </tr>
                </table> 
            </div> 
<style type="text/css">
  .btn-primary{
    background-color: #20193D !important;
  }
  .panel-heading {
      background-color: #20193D !important;
  }
  .panel-title {
    color: #D10F20 !important;
  }
</style>
@endsection