@extends('layout')

@section('contenido')
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
      <div class="panel panel-info">
        <div class="panel-heading">
          <h2 class="panel-title" align="center">Bienvenido(a) {{ Auth::user()->name }}</h2>
        </div>
        <div class="panel-body" align="center">
          @if( !empty($boletas) )
            <div class="row" align="center">
              <div class="form-group" align="center">
                <input type="text" name="alumno" id="alumno" hidden="hidden" value="{{ $alumno }}">
                <label for="id_periodo">
                  Periodo<br>
                  <select name="id_periodo" id="id_periodo">
                    <option value="0" selected="selected">Seleccione un Periodo</option>
                    <?php 
                      $periodo_actual = $boletas[0] -> id_periodo;
                    ?>
                      <option value="{{ $boletas[0] -> id_periodo }}" @if(old('id_periodo') == $boletas[0] -> id_periodo ) selected @endif>{{ $boletas[0] -> periodo }}
                      </option>
                    @foreach($boletas as $boleta)
                      @if($periodo_actual != $boleta -> id_periodo)  
                        <option value="{{ $boleta -> id_periodo }}" @if(old('id_periodo') == $boleta -> id_periodo ) selected @endif>{{ $boleta -> periodo }} 
                        </option>
                        <?php $periodo_actual = $boleta -> id_periodo; ?>
                      @endif 
                    @endforeach
                  </select>
                  {{ $errors -> first('id_periodo') }}
                </label>
                <table id="calificaciones" border="1" style="display: none;">
                </table>
              </div>
            </div>
          @else
            <div class="row" align="center">
              <h2 class="panel-title" align="center">Sin historial académico</h2>
            </div>  
          @endif
        </div>
        <div class="panel-footer" align="center">  
          <a href="{{ route('Panel.index') }}" class="btn btn-primary">Regresar</a>      
        </div>       
      </div>
    </div>
  </div>
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
<script>
  var numero_inasistencias1, numero_inasistencias2, numero_inasistencias3, numero_inasistencias4, numero_inasistencias5;
  $(function(){
    $('#id_periodo').on('change', function(e){
      var id_periodo = e.target.value;
      var id_alumno = $('#alumno').val()
      $.get('/ajax-getCalificacion?id_periodo='+id_periodo+'&id_alumno='+id_alumno, function(data){
        $('#calificaciones').empty().hide();
        numero_inasistencias1 = numero_inasistencias2 = numero_inasistencias3 = numero_inasistencias4 = numero_inasistencias5 = 0;
        $.each(data, function(index, boleta){
          if( index == 0 ){
            var encabezado = "<tr><th>Materia</th><th>Bimestre 1</th><th>Bimestre 2</th><th>Bimestre 3</th><th>Bimestre 4</th><th>Bimestre 5</th></tr>";
            var grupo = "<tr><td colspan='6' align='center'><b>Grupo: "+boleta.grupo+"</b></td></tr>";
            $('#calificaciones').append(grupo);
            $('#calificaciones').append(encabezado);
          }
          var fila = "<tr><td>"+boleta.materia+"</td><td>"+boleta.promediobt1.toFixed(2)+"</td><td>"+boleta.promediobt2.toFixed(2)+"</td><td>"+boleta.promediobt3.toFixed(2)+"</td><td>"+boleta.promediobt4.toFixed(2)+"</td><td>"+boleta.promediobt5.toFixed(2)+"</td></tr>";
          $('#calificaciones').append(fila).fadeIn(1000);
          numero_inasistencias1 = Number(numero_inasistencias1) + Number(boleta.numero_inasistencias1);
          numero_inasistencias2 = Number(numero_inasistencias2) + Number(boleta.numero_inasistencias2);
          numero_inasistencias3 = Number(numero_inasistencias3) + Number(boleta.numero_inasistencias3);
          numero_inasistencias4 = Number(numero_inasistencias4) + Number(boleta.numero_inasistencias4);
          numero_inasistencias5 = Number(numero_inasistencias5) + Number(boleta.numero_inasistencias5);
          if( index == (data.length-1) ){
            var inasistencias = "<tr><th></th><th>Bimestre 1</th><th>Bimestre 2</th><th>Bimestre 3</th><th>Bimestre 4</th><th>Bimestre 5</th></tr><tr><td>Inasistencias</td><td align='center'>"+numero_inasistencias1+"</td><td align='center'>"+numero_inasistencias2+"</td><td align='center'>"+numero_inasistencias3+"</td><td align='center'>"+numero_inasistencias4+"</td><td align='center'>"+numero_inasistencias5+"</td></tr>";
            $('#calificaciones').append(inasistencias);
          }         
        });
      });
    });
  });
</script>
@endsection