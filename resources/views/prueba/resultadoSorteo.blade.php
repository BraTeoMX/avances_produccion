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
            {{-- ... dentro de tu vista ... --}}
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                @if(session('sorteo'))
                    <br>{{ session('sorteo') }}
                @endif
            </div>
            @endif
            @if(session('status')) {{-- A menudo utilizado para mensajes de estado genéricos --}}
                <div class="alert alert-secondary">
                    {{ session('status') }}
                </div>
            @endif
            {{-- ... el resto de tu vista ... --}}
            <div class="card card-stats">
                <div class="card-header card-header-tabs card-header-info">
                    <div class="nav-tabs-navigation">
                      <h2> Seccion para sorteo </h2>
                    </div>
                  </div>
                <br>
                {{$mensaje}}

                <form method="POST" action="{{ route('registroSorteo') }}">
                    @csrf
            
                    <div class="form-group">
                        <label for="numeroEmpleado">Número de Empleado:</label>
                        <input type="text" class="form-control" id="numeroEmpleado" name="numeroEmpleado" required>
                    </div>
            
                    <button type="submit" class="btn btn-primary" onclick="confirmarRegistro()">Registrar</button>
                </form>
            </div>
                
            </div>
        </div>
    </div>
    <script>
        function confirmarRegistro() {
            var numeroEmpleado = document.getElementById('numeroEmpleado').value;
            // Aquí puedes hacer una solicitud AJAX para obtener el nombre del empleado
            // Por simplicidad, estoy usando un nombre de ejemplo
        }
    </script>
@endsection

