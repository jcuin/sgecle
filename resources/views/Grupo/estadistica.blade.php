@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Mostrando Estadística...</h3>
            </div>
            <div class="panel-body">
                <div class="row" align="center">
                    <label for="reporte">
                          Reporte<br>
                          <select name="reporte" id="reporte">
                            <option value="0">Seleccione un Reporte</option>
                            <option value="1" selected="selected">Índice de aprobación</option>
                            <option value="2">Género</option>
                          </select>
                        </label>
                    <h3 class="panel-title" align="center">       
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                        <canvas id="canvas2" height="280" width="600" style="display: none;"></canvas>
                    </div>
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
                    <div style="width: 420px"></div>
                  </td>
                  <td>
                    <span class="pull-right">
                        <a href="{{ route('Inscripcion.index') }}" class="btn btn-primary">Regresar</a>
                    </span>
                  </td>
                  </tr>
                </table> 
            </div> 
        
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset=utf-8></script>     
          </div>
        </div>
    </div>
<script>
$(function(){
    $('#reporte').on('change', function(e){
        var reporte = e.target.value;
        switch(Number(reporte)){
            case 0:$('#canvas2').hide(1000);
                   $('#canvas').hide(1000);
                   break;
            case 1:$('#canvas').show(1000);
                   $('#canvas2').hide(1000);
                   break;
            case 2:$('#canvas').hide(1000);
                   $('#canvas2').show(1000);
                   break;
        }
    });
});

    var aprobados = <?php echo $aprobados; ?>;
    var reprobados = <?php echo $reprobados; ?>;
    var etiquetas = <?php echo $etiquetas; ?>;
    var hombres_mujeres = <?php echo $hombres_mujeres; ?>;
    var etiquetas_generos = <?php echo $etiquetas_generos; ?>;

    var barChartData = {

        labels: etiquetas,

        datasets: [{

            label: 'Aprobados',

            backgroundColor: 'rgb(0,255,0)',

            data: aprobados

        }, {

            label: 'Reprobados',

            backgroundColor: 'rgb(255, 0, 0)',

            data: reprobados

        }]

    };

    var pieData = {

        labels: etiquetas_generos,

        datasets: [{

            backgroundColor: ['rgb(51,153,255)','rgb(255,165,210)'],

            data: hombres_mujeres

        }]

    };


    window.onload = function() {

        var ctx = document.getElementById("canvas").getContext("2d");

        window.myBar = new Chart(ctx, {

            type: 'bar',

            data: barChartData,

            options: {

                elements: {

                    rectangle: {

                        borderWidth: 0,

                        borderColor: 'rgb(0, 0, 0)',

                        borderSkipped: 'bottom'


                    }

                },
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true
                                
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 1,
                                stepValue: 1
                            }
                        }]
                },

                responsive: true,

                title: {

                    display: true,

                    text: 'Índice de Aprobación'

                }

            }

        });


        var ctx2 = document.getElementById("canvas2").getContext("2d");

        window.myBar2 = new Chart(ctx2, {

            type: 'pie',

            data: pieData,

            options: {

                elements: {

                    rectangle: {

                        borderWidth: 0,

                        borderColor: 'rgb(0, 0, 0)',

                        borderSkipped: 'bottom'


                    }

                },
                responsive: true,

                title: {

                    display: true,

                    text: 'Hombres y Mujeres'

                }

            }

        });

    };
</script>

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