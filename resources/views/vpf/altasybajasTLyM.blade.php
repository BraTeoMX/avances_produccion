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
                      <h2> Altas y Bajas: Team Leaders y Modulos </h2>
                    </div>
                  </div>
                <br>
                <div style="display: flex; flex-wrap: wrap;">

                    {{-- Columna para Team Leaders --}}
                    <div style="flex: 1; min-width: 50%;">
                        <h2>Team Leaders</h2>
                        {{-- Formulario para agregar nuevo Team Leader --}}
                        <form action="{{ route('team-leader.store') }}" method="POST" class="form-custom">
                            @csrf
                            <input type="text" name="team_leader" placeholder="Nombre del Team Leader">
                            <button type="submit">Agregar Team Leader</button>
                        </form>
                
                        {{-- Tabla de Team Leaders --}}
                        <div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                {{-- Campo de búsqueda --}}
                                <div>
                                    <input type="text" id="searchInput1" class="form-control mb-4" onkeyup="filterTableTeamLeaders()" placeholder="Buscar por Team Leader">
                                </div>
                            </div>
                            <table class="table-custom table-leaders" id="myTable1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Team Leader</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamLeaders as $leader)
                                        <tr>
                                            <td>{{ $leader->id }}</td>
                                            <td>{{ $leader->team_leader }}</td>
                                            <td>
                                                @if ($leader->estatus == 'A')
                                                    ALTA
                                                @elseif ($leader->estatus == 'B')
                                                    BAJA
                                                @else
                                                    {{ $leader->estatus }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('team-leader.ActualizarEstatus', $leader->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($leader->estatus == 'A')
                                                        <input type="hidden" name="estatus" value="B">
                                                        <button class="btn-secondary" type="submit">Dar de Baja</button>
                                                    @else
                                                        <input type="hidden" name="estatus" value="A">
                                                        <button class="btn-secondary" type="submit">Dar de Alta</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                    {{-- Columna para Módulos --}}
                    <div style="flex: 1; min-width: 50%;">
                        <h2>Módulos</h2>
                        {{-- Formulario para agregar nuevo Módulo --}}
                        <form action="{{ route('Modulo.store') }}" method="POST" class="form-custom">
                            @csrf
                            <input type="text" name="Modulo" placeholder="Nombre del Módulo">
                            <button type="submit">Agregar Módulo</button>
                        </form>
                
                        {{-- Tabla de Módulos --}}
                        <div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                {{-- Campo de búsqueda --}}
                                <div>
                                    <input type="text" id="searchInput2" class="form-control mb-4" onkeyup="filterTableModulos()" placeholder="Buscar por módulo...">
                                </div>
                            </div>
                            <table class="table-custom table-modulos" id="myTable2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Módulo</th>
                                        <th>Estatus</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modulos as $modulo)
                                        <tr>
                                            <td>{{ $modulo->id }}</td>
                                            <td>{{ $modulo->Modulo }}</td>
                                            <td>
                                                @if ($leader->estatus == 'A')
                                                    ALTA
                                                @elseif ($leader->estatus == 'B')
                                                    BAJA
                                                @else
                                                    {{ $leader->estatus }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('Modulo.ActualizarEstatusM', $modulo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($modulo->estatus == 'A')
                                                        <input type="hidden" name="estatus" value="B">
                                                        <button class="btn-secondary" type="submit">Dar de Baja</button>
                                                    @else
                                                        <input type="hidden" name="estatus" value="A">
                                                        <button class="btn-secondary" type="submit">Dar de Alta</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
                
            </div>
        </div>
    </div>
    <script>
        function filterTableTeamLeaders() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable1");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Cambia el índice si es necesario
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function filterTableModulos() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable2");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Cambia el índice si es necesario
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

       
    </script>
    <style>
        /* Estilos para las tablas */
        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-custom th, .table-custom td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-custom th {
            background-color: #458ea0;
            color: white;
        }

        .table-custom tr:nth-child(even){background-color: #f2f2f2;}

        .table-custom tr:hover {background-color: #ddd;}

        /* Estilos para los formularios */
        .form-custom {
            margin-bottom: 20px;
        }

        .form-custom input[type="text"] {
            width: 70%;
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-custom button {
            padding: 10px 20px;
            background-color: #458ea0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-custom button:hover {
            background-color: #458ea0;
        }

        /* Estilos específicos para la tabla de Team Leaders */
        .table-leaders th {
            background-color: #458ea0;
            color: white;
        }

        .table-leaders button {
            background-color: #458ea0;
            /* otros estilos para el botón si es necesario */
        }

        .table-leaders button:hover {
            background-color: #306872; /* Un tono más oscuro para el hover */
        }

        /* Estilos específicos para la tabla de Módulos */
        .table-modulos th {
            background-color: #572c69; /* Un gris oscuro para diferenciar */
            color: white;
        }

        .table-modulos button {
            background-color: #572c69;
            /* otros estilos para el botón si es necesario */
        }

        .table-modulos button:hover {
            background-color: #5a6268; /* Un tono más oscuro para el hover */
        }

        /* Estilos para los formularios se mantienen igual */
        .form-custom {
            /* ... */
        }

        /* Ajustes adicionales para la responsividad */
        @media (max-width: 600px) {
            .form-custom input[type="text"] {
                width: 100%;
                margin-bottom: 10px;
            }
        }

    </style>
@endsection

