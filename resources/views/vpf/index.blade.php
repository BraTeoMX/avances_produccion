@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('Vicepresidencia Finanzas')])
<style>
  .ct-chart {
      position: relative;
  }
  .ct-legend {
      position: relative;
      z-index: 10;
      list-style: none;
      text-align: center;
  }
  .ct-legend li {
      position: relative;
      padding-left: 23px;
      margin-right: 10px;
      margin-bottom: 3px;
      cursor: pointer;
      display: inline-block;
  }
  .ct-legend li:before {
      width: 12px;
      height: 12px;
      position: absolute;
      left: 0;
      content: '';
      border: 3px solid transparent;
      border-radius: 2px;
  }
  .ct-legend li.inactive:before {
      background: transparent;
  }
  .ct-legend.ct-legend-inside {
      position: absolute;
      top: 0;
      right: 0;
  }
  .ct-legend.ct-legend-inside li{
      display: block;
      margin: 0;
  }
  .ct-legend .ct-series-0:before {
      background-color:#1889c2;
      border-color: #1889c2;
  }
  .ct-legend .ct-series-1:before {
      background-color: #d70206;
      border-color:#d70206;
  }
  
  

</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            {{$inicio}}
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <h1> HOLA Mundo . </h1>
                        <p>Avance - Diario</p>
                    </div>
                    <p class="card-category"></p>
                    <h3 class="card-title"><b>{{ $dia.' '.$hora }}</b></h3>
                </div>
                <div id="timer">00:00:00</div>

                <div class="card-footer text-center">        
                    <p class="stats"><span class="text-info">Eficiencia Meta:</span><b>{{ $eficiencia_dia.' %' }}</b></p> 
                    <p class="stats"><span class="text-info">Eficiencia Real:</span><b>{{ '0 %' }}</b></p> 
                </div>
                <div class="card-footer text-center">
                    <p class="stats"><span class="text-info">Piezas Meta:</span><b>{{ number_format($cantidad_dia, 2) }}</b></p>    
                    <p class="stats"><span class="text-info">Piezas Reales:</span><b>{{ number_format(0, 0) }}</b></p>
                    <p class="stats"><span class="text-info">Piezas Diferencia:</span><b>{{ number_format(($cantidad_dia - 12345), 2) }}</b></p>
                </div>
                <form action="{{ route('vpf.actualizarTabla') }}" method="POST">
                    @csrf
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-info">
                                <tr>
                                    <th>Team Leaders</th>
                                    <th>Módulo</th>
                                    <th>Id</th>
                                    <th>Piezas</th>
                                    <th>Eficiencias</th>
                                    <th>Minutos Producidos</th>
                                    <th>Proyección Minutos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datosPlaneacion as $index => $planeacion)
                                    <tr>
                                        <td style="text-align: left">
                                            @if($planeacion->teamLeader)
                                                {{ $planeacion->teamLeader->team_leader }}
                                            @else
                                                <strong>NO TEAM LEADER</strong>
                                            @endif
                                        </td>
                                        <td>{{ $planeacion->modulo }}</td>
                                        <td><input type="hidden" name="planeaciones[{{ $index }}][id]" value="{{ $planeacion->id }}"></td>
                                        <td><input name="planeaciones[{{ $index }}][piezas_{{ $horaD }}]" value="{{ $planeacion->planeacionesDiarias->{'piezas_'.$horaD} ?? '' }}"></td>
                                        <td><input name="planeaciones[{{ $index }}][efic_{{ $horaD }}]" value="{{ $planeacion->planeacionesDiarias->{'efic_'.$horaD} ?? '' }}"></td>
                                        <td><input name="planeaciones[{{ $index }}][min_prod_{{ $horaD }}]" value="{{ $planeacion->planeacionesDiarias->{'min_prod_'.$horaD} ?? '' }}"></td>
                                        <td><input name="planeaciones[{{ $index }}][proy_min_{{ $horaD }}]" value="{{ $planeacion->planeacionesDiarias->{'proy_min_'.$horaD} ?? '' }}"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Actualizar Todos</button>
                    </form>
                    <br>
                    @if ($horaD >= 11 && $horaD < 12)
                        <form action="{{ route('transferir.datos') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Transferir Datos Diarios</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>


  <script>
    function updateTimer() {
        var now = new Date();
        // Establecer el momento para el próximo refresco (2 minutos después de la hora)
        var nextRefresh = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), 1, 0);
        var diff = nextRefresh - now; // Diferencia en milisegundos
    
        // Si la hora actual ya pasó de los 2 minutos después de la hora, programar para la siguiente hora
        if (diff < 0) {
            nextRefresh.setHours(now.getHours() + 1);
            diff = nextRefresh - now;
        }
    
        var minutes = Math.floor(diff / 60000); // minutos
        diff = diff - minutes * 60000;
        var seconds = Math.floor(diff / 1000); // segundos
    
        // Añadir un cero al principio si es necesario
        function pad(value) {
            return value.toString().padStart(2, '0');
        }
    
        // Mostrar el tiempo restante
        document.getElementById('timer').textContent = "00:" + pad(minutes) + ":" + pad(seconds);
    
        // Si ya es tiempo de recargar (2 minutos después de la hora), recargar la página
        if (minutes === 0 && seconds === 0) {
            window.location.reload(true);
        } else {
            // Llamar a la función updateTimer cada segundo
            setTimeout(updateTimer, 1000);
        }
    }
    
    // Iniciar la función updateTimer
    updateTimer();
    </script>
    
    
@endsection

