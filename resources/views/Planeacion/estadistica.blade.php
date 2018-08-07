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
                <div class="row">
                    <h3 class="panel-title" align="center">       
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
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
                        <a href="{{ route('Planeacion.index') }}" class="btn btn-primary">Regresar</a>
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


    var rojo = <?php echo $rojo; ?>;
    var amarillo = <?php echo $amarillo; ?>;
    var verde = <?php echo $verde; ?>;
    var morado = <?php echo $morado; ?>;
    var etiquetas = <?php echo $etiquetas; ?>;

    var barChartData = {

        labels: etiquetas,

        datasets: [{

            label: 'Tarde',

            backgroundColor: 'rgb(255,0,0)',

            data: rojo

        }, {

            label: 'Antes del Vencimiento',

            backgroundColor: 'rgb(255, 255, 0)',

            data: amarillo

        }, {

            label: 'A Tiempo',

            backgroundColor: 'rgb(0,255, 0)',

            data: verde

        }, {

            label: 'Anticipado',

            backgroundColor: 'rgb(87, 35, 100)',

            data: morado

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

                    text: 'Índice de Entrega de Planeaciones'

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