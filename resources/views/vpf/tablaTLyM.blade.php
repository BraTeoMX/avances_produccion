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
                      <h2> tabla para Team Leaders y Modulos </h2>
                    </div>
                  </div>
                <br>
                {{--$mensaje--}}
                    {{-- Campo de búsqueda --}}
                    <div>
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Buscar por nombre o módulo...">
                    </div>
                <table BORDER id="myTable">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Team Leader</th>
                            <th>Módulo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teamModulos as $teamModulo)
                            <tr>
                                <td>{{ $teamModulo->id }}</td></td>
                                <td>{{ optional($teamModulo->catTeamLeader)->team_leader }}</td>
                                <td>{{ optional($teamModulo->catModulo)->Modulo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable"); // Asegúrate de poner el id correcto de tu tabla
            tr = table.getElementsByTagName("tr");
        
            // Recorre todas las filas de la tabla y oculta las que no coinciden con la búsqueda
            for (i = 1; i < tr.length; i++) { // Comienza en 1 para saltar el encabezado de la tabla
                // Obtén las celdas de "Team Leaders" y "Modulo"
                var tdLeader = tr[i].getElementsByTagName("td")[1];
                var tdModule = tr[i].getElementsByTagName("td")[2];
                if (tdLeader || tdModule) {
                    if (tdLeader.textContent.toUpperCase().indexOf(filter) > -1 || tdModule.textContent.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
        </script>
@endsection

