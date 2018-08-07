@extends('layout')

@section('contenido')
  <div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Página</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-lg-12 col-lg-12"> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td class="panel-title" align="center">
                          @if (session('info'))
                            <strong>
                              <div class="alert alert-success alert-dismissable fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  {{ session('info') }}
                              </div>
                            </strong>
                          @endif
                          @if (session('error'))
                            <strong>
                              <div class="alert alert-danger alert-dismissable fade in">
                                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  {{ session('error') }}
                              </div>
                            </strong>
                          @endif
                        </td>
                      </tr>
                      <tr>
                          <td>Imagen Principial:</td>
                          <td><img src="{{ Storage::url($pagina -> banner_principal_imagen) }}" width="100" height="80"></td>
                      </tr>
                      <tr>
                          <td>Descripción:</td>
                          <td>{{ $pagina -> descripcion }}</td>
                      </tr>
                      @for($i = 1; $i < count($banner_principal_texto); $i++)
                        <tr>
                            <td>Texto Principal - Pantalla {{ $i }}:</td>
                            <td>{{ $banner_principal_texto[$i] }}</td>
                        </tr>
                      @endfor
                      <tr>
                          <td>Utilizado desde: {{ $pagina -> desde }}</td>
                          <td>hasta: {{ $pagina -> desde }}</td>
                      </tr>
                      <tr>
                        <td>
                          <a href="{{ route('editPagina', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                        </td>
                      </tr>
                  </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-oferta" align="center">Oferta Educativa</h3>
                <div id="panel-oferta"> 
                  <table class="table table-user-information">
                    <tbody>
                      <?php $i = 1; ?>
                      @if(count($pagina_oferta) > 0)
                        @foreach($pagina_oferta as $oferta_individual)
                        <tr>
                          <td width="100">Imagen {{ $i }}</td>
                          <td><img src="{{ Storage::url($oferta_individual -> oferta_imagen) }}" width="100" height="80"></td>
                        </tr>
                        <tr>
                          <td>Título {{ $i }}:</td>
                          <td>{{ $oferta_individual -> oferta_titulo }}</td>
                        </tr> 
                        <tr>
                          <td>Texto {{ $i }}:</td><?php $i++?>
                          <td>{{ $oferta_individual -> oferta_texto }}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="2">
                            <a href="{{ route('editOferta', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td colspan="2" align="center">Sin oferta</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-talleres" align="center">Talleres</h3>
                <div id="panel-talleres"> 
                  <table class="table table-user-information">
                    <tbody>
                      <?php $i = 1; ?>
                      @if(count($pagina_talleres) > 0)
                        <tr>
                          <td width="100">Título:</td>
                          <td>{{ $pagina -> taller_encabezado }}</td>
                        </tr>
                        @foreach($pagina_talleres as $taller_individual)
                          <tr>
                            <td>Imagen {{ $i }}</td>
                            <td><img src="{{ Storage::url($taller_individual -> talleres_imagen) }}" width="100" height="80"></td>
                          </tr>
                          <tr>
                            <td>Título {{ $i }}:</td>
                            <td>{{ $taller_individual -> talleres_titulo }}</td>
                          </tr> 
                          <tr>
                            <td>Texto {{ $i }}:</td><?php $i++?>
                            <td>{{ $taller_individual -> talleres_texto }}</td>
                          </tr>
                        @endforeach
                        <tr>
                          <td colspan="2">
                            <a href="{{ route('editTaller', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                          </td>
                        </tr>
                @else
                  <tr>
                    <td colspan="2" align="center">Sin talleres</td>
                  </tr>
                @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <h3 class="panel-title" id="titulo-instalaciones" align="center">Instalaciones</h3>
                <div id="panel-instalaciones"> 
                  <table class="table table-user-information">
                    <tbody>
                      <?php $i = 1; ?>
                      @if(count($pagina_instalaciones) > 0)
                        <tr>
                          <td width="100">Título:</td>
                          <td>{{ $pagina -> instalaciones_titulo }}</td>
                        </tr>
                        <tr>
                          <td>Texto:</td>
                          <td>{{ $pagina -> instalaciones_texto }}</td>
                        </tr>
                        @foreach($pagina_instalaciones as $instalaciones_individual)
                        <tr>
                          <td width="100">Imagen {{ $i }}</td>
                          <td><img src="{{ Storage::url($instalaciones_individual -> instalaciones_imagen) }}" width="100" height="80"></td>
                        </tr>
                        <tr>
                          <td>Título {{ $i }}:</td>
                          <td>{{ $instalaciones_individual -> instalaciones_titulo_imagen }}</td>
                        </tr> 
                        <tr>
                          <td>Texto {{ $i }}:</td><?php $i++?>
                          <td>{{ $instalaciones_individual -> instalaciones_texto_imagen }}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="2">
                            <a href="{{ route('editInstalacion', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td colspan="2" align="center">Sin instalaciones</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-horario" align="center">Horario Extendido</h3>
                <div id="panel-horario"> 
                  <table class="table table-user-information">
                    <tbody>
                      <?php $i = 1; ?>
                      @if(count($pagina_horarios) > 0)
                        <tr>
                          <td width="100">Título:</td>
                          <td>{{ $pagina -> horario_titulo }}</td>
                        </tr>
                        <tr>
                          <td>Texto:</td>
                          <td>{{ $pagina -> horario_texto }}</td>
                        </tr>
                        @foreach($pagina_horarios as $horario_individual)
                        <tr>
                          <td width="100">Imagen {{ $i }}</td>
                          <td><img src="{{ Storage::url($horario_individual -> horario_imagen) }}" width="100" height="80"></td>
                        </tr>
                        <tr>
                          <td>Título {{ $i }}:</td>
                          <td>{{ $horario_individual -> horario_titulo_imagen }}</td>
                        </tr> 
                        <tr>
                          <td>Texto {{ $i }}:</td><?php $i++?>
                          <td>{{ $horario_individual -> horario_texto_imagen }}</td>
                        </tr>
                        @endforeach
                        <tr>
                          <td colspan="2">
                            <a href="{{ route('editHorario', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td colspan="2" align="center">Sin horario</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                <h3 class="panel-title" id="titulo-convenio" align="center">Convenios</h3>
                <div id="panel-convenio"> 
                  <table class="table table-user-information">
                    <tbody>
                      <?php $i = 1; ?>
                      @if(count($pagina_convenios) > 0)
                        @foreach($pagina_convenios as $convenio_individual)
                        <tr>
                          <td width="100">Imagen {{ $i }}</td>
                          <td><img src="{{ Storage::url($convenio_individual -> convenio_imagen) }}" width="100" height="80"></td>
                        </tr>
                        <tr>
                          <td>Título {{ $i }}:</td><?php $i++?>
                          <td>{{ $convenio_individual -> convenio_titulo }}</td>
                        </tr> 
                        @endforeach
                        <tr>
                          <td colspan="2">
                            <a href="{{ route('editConvenio', $pagina -> id) }}" class="btn btn-primary pull-right">Editar</a>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td colspan="2" align="center">Sin convenios</td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
            </div>
            <div class="panel-footer">
                <table>
                  <tr>
                    <td width="35px">
                    </td>
                    <td><form method="POST" action="{{ route('Pagina.destroy', $pagina -> id)}}">
                {!! method_field('DELETE') !!}
                {!! csrf_field() !!}
                <button type="submit" class="btn btn-primary">Eliminar</button>
              </form>
                    </td>
                    <td>
                      <div style="width: 285px"></div>
                    </td>
                    <td>
                      <span class="pull-right">
                          <a href="{{ route('Pagina.index') }}" class="btn btn-primary">Regresar</a>
                      </span>
                    </td>
                  </tr>
                </table>         
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
    cursor: pointer;
  }
</style>
<script>
  $(function(){
    $('#panel-oferta').hide();
    $('#panel-talleres').hide();
    $('#panel-instalaciones').hide();
    $('#panel-horario').hide();
    $('#panel-convenio').hide();
    $("#titulo-oferta").click(function(){
      $('#panel-oferta').slideToggle( "slow" );
    });
    $("#titulo-talleres").click(function(){
      $('#panel-talleres').slideToggle( "slow" );
    });
    $("#titulo-instalaciones").click(function(){
      $('#panel-instalaciones').slideToggle( "slow" );
    });
    $("#titulo-horario").click(function(){
      $('#panel-horario').slideToggle( "slow" );
    });
    $("#titulo-convenio").click(function(){
      $('#panel-convenio').slideToggle( "slow" );
    });
  });
</script>
@endsection