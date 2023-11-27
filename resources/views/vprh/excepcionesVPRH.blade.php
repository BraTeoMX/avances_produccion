@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('Excepciones')])

@section('content')
  <div class="content">
  
    <div class="container-fluid">
    <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Excepciones Recursos Humanos</span>
    </div></div></div></div></div>
    
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
      </div>
      <div class="row">
     
        <div class="col-lg-6 col-md-6">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vacaciones por Area </h4>
              <p class="card-category"></p>
            </div>
            
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th>Vacaciones</th>
                  <th>Autorizadas por</th>
                </thead>
                <tbody>
                  @php
                        $vac=0;
                  @endphp      
                  @foreach($departamento as $dep)   
                        @forelse ($depVPRHVE as $depFVE)
                            @if ($dep->des_edo_neg == $depFVE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!} </td>
                                    <td align='center' >{!! $depFVE->excevac !!}</td>
                                    @php
                                        $vac=$vac+$depFVE->excevac;
                                    @endphp
                                    <td align='left'>{!! $depFVE->Puesto !!}</td>
                            @else   
                            @endif 
                                </tr>
                        @empty
                        @endforelse 
                        
                  @endforeach 
                  <tr>
                      <td><b>TOTAL</b></td>
                      <td align='center'><b>{!! $vac !!}</b></td>
                      <td><b></b></td>
                      
                  </tr>
                 
                </tbody>
              </table>
              <div class="card" align="right">
              <div class="stats" >
                <i class="material-icons">date_range</i> 
                <a href="#" id='detalleV'>Detalle...</a>
              </div>
            </div>
            </div>
          </div>
        </div>
          <div class="col-lg-6 col-md-6">
            <div class="card">
              <div class="card-header card-header-success">
                <h4 class="card-title">Permisos por Area </h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-success">
                    <th>Area</th>
                    <th>Permisos</th>
                    <th>Autorizados por</th>
                  </thead>
                  <tbody>
                    @php
                        $per=0;
                    @endphp      
                    @foreach($departamento as $dep)   
                        @forelse ($depVPRHPE as $depFPE)
                            @if ($dep->des_edo_neg == $depFPE->des_edo_neg )    
                                <tr>
                                    <td align='left'   >{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depFPE->exceper !!}</td>
                                    @php
                                        $per=$per+$depFPE->exceper;
                                    @endphp
                                    <td align='left'>{!! $depFPE->Puesto !!}</td>
                            @else   
                            @endif 
                            </tr>
                        @empty
                        @endforelse    
                    @endforeach 
                      <tr>
                        <td><b>TOTAL</b></td>
                        <td align='center'><b>{!! $per !!}</b></td>
                        <td><b></b></td>
                      
                      </tr>
                  </tbody>
                </table>
                <div class="card" align="right">
              <div class="stats" >
                <i class="material-icons">date_range</i> 
                <a href="#" id='detalleP'>Detalle...</a>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col center"><a href="{{ route('home') }}"  class="btn btn-primary">Regresar</a>
                </div> 
              </div>
        </div>
          </div>
        
        </div>
      </div>
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
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>

<script>
    config = {
        enableTime: false,
        dateFormat: 'Y-m-d',
        locale: {
          firstDayOfWeek: 1,
          weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
          }, 
          months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          },
        },
    }
    flatpickr("input[type=date]", config);

    $('#fecha_inicial').change(function () {
      $('#id_fecha_final').show();

  });

  $('#fecha_final').change(function () {
    window.location.href="fechas_excepVPRH?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val();

  });

  $('#detalleV').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Excepciones Vacaciones Recursos Humanos </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Empleado</th>
                  <th >Periodo</th>
                  <th >Periodo</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $vac=0;
                    @endphp                          
                    @foreach($detallevacVPRH as $detalle)
                        @if($vac%2==0)   
                        <tr  style="background-color: #D2F7FF;">
                        @else
                        <tr>
                        @endif

                          <td align='left'><font size =2>{!! $detalle->des_edo_neg !!}</font></td>
                          <td align='left'><font size =2>{!! $detalle->Ap_Pat.' '.$detalle->Ap_Mat.' '.$detalle->Nom_Emp !!}</font></td>
                          <td align='center'><font size =2>{!! $detalle->fech_ini_vac.'/'.$detalle->fech_fin_vac !!}</font></td>
                          <td align='right'><font size =2>{!! $detalle->status !!}</font></td>
                          <td align='right'><font size =2>{!! $detalle->Puesto !!}</font></td>
                        </tr>    
                    @php
                        $vac++;
                    @endphp  
                    @endforeach       
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
       
        </div>
          </div>
        
        </div>
      </div>
      </div>
    </div>
  </div>
    `,
    width: '1100px'
});
  });

  $('#detalleP').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Excepciones Permisos Recursos Humanos </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-success">
                  <th>Area</th>
                  <th >Empleado</th>
                  <th >Periodo</th>
                  <th >Estatus</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $per=0;
                    @endphp                          
                    @foreach($detalleperVPRH as $detalle)
                        @if($per%2==0)   
                        <tr  style="background-color: #BDECB6;">
                        @else
                        <tr>
                        @endif

                          <td align='left'><font size =2>{!! $detalle->des_edo_neg !!}</font></td>
                          <td align='left'><font size =2>{!! $detalle->Ap_Pat.' '.$detalle->Ap_Mat.' '.$detalle->Nom_Emp !!}</font></td>
                          <td align='center'><font size =2>{!! $detalle->fech_ini_per.'/'.$detalle->fech_fin_per !!}</font></td>
                          <td align='right'><font size =2>{!! $detalle->status !!}</font></td>
                          <td align='right'><font size =2>{!! $detalle->Puesto !!}</font></td>
                        </tr>    
                    @php
                        $per++;
                    @endphp  
                    @endforeach       
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
       
        </div>
          </div>
        
        </div>
      </div>
      </div>
    </div>
  </div>
    `,
    width: '1100px'
});
  });
   


  </script>
@endpush