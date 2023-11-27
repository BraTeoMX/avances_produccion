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
            <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                        <h1> Altas y Bajas para Team Leaders y Modulos </h1>
                    </div>
                </div>
                {{$mensaje}}
                <br>
                <div style="display: flex; flex-wrap: wrap;">

                    {{-- Columna para Team Leaders --}}
                    <div style="flex: 1; min-width: 50%;">
                        {{-- Formulario para agregar nuevo Team Leader --}}
                        <form action="{{ route('team-leader.store') }}" method="POST">
                            @csrf
                            <input type="text" name="team_leader" placeholder="Nombre del Team Leader">
                            <button type="submit">Agregar Team Leader</button>
                        </form>
                
                        {{-- Tabla de Team Leaders --}}
                        <div>
                            <h2>Team Leaders</h2>
                            <table BORDER>
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
                                            <td>{{ $leader->estatus }}</td>
                                            <td>
                                                @if($leader->estatus == 'A')
                                                <form action="{{ route('team-leader.ActualizarEstatus', $leader->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH') {{-- Si estás usando el método PATCH en tu ruta --}}
                                                    <input type="hidden" name="estatus" value="B"> {{-- Establece el nuevo estado que quieres --}}
                                                    <button type="submit">Dar de Baja</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                    {{-- Columna para Módulos --}}
                    <div style="flex: 1; min-width: 50%;">
                        {{-- Formulario para agregar nuevo Módulo --}}
                        <form action="{{ route('Modulo.store') }}" method="POST">
                            @csrf
                            <input type="text" name="Modulo" placeholder="Nombre del Módulo">
                            <button type="submit">Agregar Módulo</button>
                        </form>
                
                        {{-- Tabla de Módulos --}}
                        <div>
                            <h2>Módulos</h2>
                            <table BORDER>
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
                                            <td>{{ $modulo->estatus }}</td>
                                            <td>
                                                @if($modulo->estatus == 'A')
                                                    <form action="{{ route('Modulo.ActualizarEstatusM', $modulo->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH') {{-- Si estás usando el método PATCH en tu ruta --}}
                                                        <input type="hidden" name="estatus" value="B"> {{-- Establece el nuevo estado que quieres --}}
                                                        <button type="submit">Dar de Baja</button>
                                                    </form>
                                                @endif
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

    
    
@endsection

