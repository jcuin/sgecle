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
                            <option value="1" selected="selected">Solicitud de Informes</option>
                            <option value="2">Medios de Contacto</option>
                            <option value="3">Visitas Mensuales</option>
                            <!--<option value="4">Matrícula</option>-->
                          </select>
                        </label>
                    <h3 class="panel-title" align="center">       
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                        <canvas id="canvas2" height="280" width="600" style="display: none;"></canvas>
                        <canvas id="canvas3" height="280" width="600" style="display: none;"></canvas>
                        <canvas id="canvas4" height="280" width="600" style="display: none;"></canvas>
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
                        <a href="{{ route('Panel.index') }}" class="btn btn-primary">Regresar</a>
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
            case 0:$('#canvas').hide(1000);
                   $('#canvas2').hide(1000);
                   $('#canvas3').hide(1000);
                   $('#canvas4').hide(1000);
                   break;
            case 1:$('#canvas').show(1000);
                   $('#canvas2').hide(1000);
                   $('#canvas3').hide(1000);
                   $('#canvas4').hide(1000);
                   break;
            case 2:$('#canvas').hide(1000);
                   $('#canvas2').show(1000);
                   $('#canvas3').hide(1000);
                   $('#canvas4').hide(1000);
                   break;
            case 3:$('#canvas').hide(1000);
                   $('#canvas2').hide(1000);
                   $('#canvas3').show(1000);
                   $('#canvas4').hide(1000);
                   break;
            case 4:$('#canvas').hide(1000);
                   $('#canvas2').hide(1000);
                   $('#canvas3').hide(1000);
                   $('#canvas4').show(1000);
                   break;
        }
    });
});

    var cantidad = <?php echo $cantidad; ?>;
    var etiquetas = <?php echo $etiquetas; ?>;
    var cantidad_contacto = <?php echo $cantidad_contacto; ?>;
    var etiquetas_contacto = <?php echo $etiquetas_contacto; ?>;
    var cantidad_visitas = <?php echo $cantidad_visitas; ?>;
    var etiquetas_visitas = <?php echo $etiquetas_visitas; ?>;
    

    var pieData = {

        labels: etiquetas,

        datasets: [{

            backgroundColor: ['rgb(51,153,255)','rgb(255,165,210)'],

            data: cantidad

        }]

    };

    var pieData2 = {

        labels: etiquetas_contacto,

        datasets: [{

            backgroundColor: ['rgb(51,153,255)','rgb(255,165,210)','rgb(120,100,210)', 'rgb(10,65,90)'],

            data: cantidad_contacto

        }]

    };

    var pieData3 = {

        labels: etiquetas_visitas,

        datasets: [{

            backgroundColor: ['rgb(51,153,255)','rgb(255,165,210)','rgb(120,100,210)', 'rgb(10,65,90)'],

            data: cantidad_visitas

        }]

    };

    var pieData4 = {

        labels: etiquetas_visitas,

        datasets: [{

            backgroundColor: ['rgb(51,153,255)','rgb(255,165,210)','rgb(120,100,210)', 'rgb(10,65,90)'],

            data: cantidad_visitas

        }]

    };

    window.onload = function() {

        var ctx = document.getElementById("canvas").getContext("2d");

        window.myBar = new Chart(ctx, {

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

                    text: 'Solicitud de informes'

                }

            }

        });

        var ctx2 = document.getElementById("canvas2").getContext("2d");

        window.myBar2 = new Chart(ctx2, {

            type: 'pie',

            data: pieData2,

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

                    text: 'Medios de Contacto'

                }

            }

        });

        var ctx3 = document.getElementById("canvas3").getContext("2d");

        window.myBar3 = new Chart(ctx3, {

            type: 'pie',

            data: pieData3,

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

                    text: 'Visitas Mensuales'

                }

            }

        });

        /*var ctx4 = document.getElementById("canvas4").getContext("2d");

        var myBar4 = new Chart(ctx4, {
          type: 'bar',
          data: {
            labels: ["Prescolar", "Primaria", "Secundaria"],
            datasets: [{
                label: 'Prescolar',
                data: prescolar,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(255,99,132,1)',
                  'rgba(255,99,132,1)',
                  'rgba(255,99,132,1)',
                  'rgba(255,99,132,1)',
                  'rgba(255,99,132,1)'
                ],
                borderWidth: 2
              },
              {
                label: 'Primaria',
                data: primaria,
                backgroundColor: [
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
              },
              {
                label: 'Secundaria',
                data: secundaria,
                backgroundColor: [
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
              }
            ]
          },
          options: {
            scales: {
              yAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }],
              xAxes: [{
                stacked: true,
                ticks: {
                  beginAtZero: true
                }
              }]

            }
          }
        });*/

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