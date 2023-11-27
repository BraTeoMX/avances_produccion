@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Hoja de  Vida')])

@section('content')
<div class="content">
  <div class="container-fluid">
  <div class="card-body">           
        <div class="row">
            <div class="col-lg-3 col-md-3">    
                <input type="text" class="form-control" name="empleado" id="empleado" >
            </div>
            <div class="col center">
                <button type="submit" name="buscar_emp" id='buscar_emp'  class="btn btn-primary">Buscar empleado</button>
            </div> 
        </div>        
    </div> 
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title "> Hoja de Vida</h4>
            <p class="card-category"></p>
          </div>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-info">
                  <th>
                    No. Empleado
                  </th>
                  <th>
                    Nombre
                  </th>
                  <th>
                    Fecha Ingreso
                  </th>
                  <th>
                    Departamento
                  </th>
                  <th>
                    Puesto
                  </th>
                  <th>
                    VP
                  </th>
                </thead>
                <tbody>
                  @if($contador!=0)
                    @foreach($no_empleado as $emp)   
                      @if($emp->Status_Emp=='A')
                        <tr>
                            <td align='center'><a href="{{ route('detalleHojadevida',$emp->No_Empleado) }}">{{ $emp->No_Empleado }}</a> </td>   
                          <td>
                            {{ $emp->Ap_Pat.' '.$emp->Ap_Mat.' '.$emp->Nom_Emp }}
                          </td>
                          <td>
                          {{ $emp->Fecha_In }}
                          </td>
                          <td>
                          {{ $emp->Departamento }}
                          </td>
                          <td>
                            {{ $emp->Puesto }} 
                          </td>
                          <td >
                          {{ $emp->vp }} 
                          </td>
                        </tr>
                      @endif  
                    @endforeach  
                 @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
     <!-- <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Table on Plain Background</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6">
            <label for="join"
                class="col-md-4 col-form-label text-md-end">{{ __('Fecha Inicial') }}</label>
                <div class="col-md-6" >
                <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial" value={{ $inicio }} >
                </div>
            </div>
            <div class="col-lg-6 col-md-6" >
            <label for="join"
                class="col-md-4 col-form-label text-md-end">{{ __('Fecha Final') }}</label>
                <div class="col-md-6" style="display: block" id='id_fecha_final'>
                <input type="date" class="form-control" name="fecha_final" id="fecha_final" value={{ $fin }}>
                </div>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Country
                  </th>
                  <th>
                    City
                  </th>
                  <th>
                    Salary
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                    <td>
                      $36,738
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      Minerva Hooper
                    </td>
                    <td>
                      Curaçao
                    </td>
                    <td>
                      Sinaai-Waas
                    </td>
                    <td>
                      $23,789
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      Sage Rodriguez
                    </td>
                    <td>
                      Netherlands
                    </td>
                    <td>
                      Baileux
                    </td>
                    <td>
                      $56,142
                    </td>
                  </tr>
                  <tr>
                    <td>
                      4
                    </td>
                    <td>
                      Philip Chaney
                    </td>
                    <td>
                      Korea, South
                    </td>
                    <td>
                      Overland Park
                    </td>
                    <td>
                      $38,735
                    </td>
                  </tr>
                  <tr>
                    <td>
                      5
                    </td>
                    <td>
                      Doris Greene
                    </td>
                    <td>
                      Malawi
                    </td>
                    <td>
                      Feldkirchen in Kärnten
                    </td>
                    <td>
                      $63,542
                    </td>
                  </tr>
                  <tr>
                    <td>
                      6
                    </td>
                    <td>
                      Mason Porter
                    </td>
                    <td>
                      Chile
                    </td>
                    <td>
                      Gloucester
                    </td>
                    <td>
                      $78,615
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>-->
    </div>
  </div>
</div>
@endsection


@push('js')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>
<script>

$(document).ready(function() {
   $("#buscar_emp").click(function(){
        window.location.href="hojadevida?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val()+"&empleado="+$('#empleado').val();
    
    }); 
});
  </script>
  @endpush