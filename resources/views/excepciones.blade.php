@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('Excepciones')])

@section('content')
  <div class="content">
  
    <div class="container-fluid">
    <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Excepciones</span>
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
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Reporte por VP </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th></th>
                  <th >Excepciones</th>
                  <th>Vacaciones</th>
                  <th>Permisos</th>
                </thead>
                <tbody>
                    <tr>
                        <td>FINANZAS</td>
                        <td></td>
                        <td align='center'>{!! $excepcionVPFV+$excepcionVPFP !!}</td>
                        <td align='center' id='td_vpfv'><font color=blue>{!! $excepcionVPFV !!}</font></td>
                        <td align='center' id='td_vpfp'><font color=blue>{!! $excepcionVPFP !!}</font></td>
                    </tr>
                    <tr>
                        <td>RECURSOS HUMANOS</td>
                        <td></td>
                        <td align='center'>{!! $excepcionVPRHV+$excepcionVPRHP !!}</td>
                        <td align='center' id='td_vprhv'><font color=blue>{!! $excepcionVPRHV !!}</font></td>
                        <td align='center' id='td_vprhp'><font color=blue>{!! $excepcionVPRHP !!}</font></td>
                    </tr>
                    <tr>
                        <td>MANUFACTURA</td>
                        <td></td>
                        <td align='center'>{!! $excepcionVPMV+$excepcionVPMP !!}</td>
                        <td align='center' id='td_vpmv'><font color=blue>{!! $excepcionVPMV !!}</font></td>
                        <td align='center' id='td_vpmp'><font color=blue>{!! $excepcionVPMP !!}</font></td>
                    </tr>
                    <tr>
                        <td>VENTAS</td>
                        <td></td>
                        <td align='center'>{!! $excepcionVPVV+$excepcionVPVP !!}</td>
                        <td align='center' id='td_vpvv'><font color=blue>{!! $excepcionVPVV !!}</font></td>
                        <td align='center' id='td_vpvp'><font color=blue>{!! $excepcionVPVP !!}</font></td>
                    </tr>
                    
                                       
                    @foreach($departamentoVPV as $dep)       
                    <tr id='tr_vpv' style='display:none'>
                        <td></td>
                        <td align='left'>{!! $dep->Puesto !!}</td>
                    </tr>
                    @endforeach 
                    <tr>
                        <td><b>TOTAL</b></td>
                        <td></td>
                        <td align='center'><b>{!! $excepcionVPFV+$excepcionVPFP+$excepcionVPRHV+$excepcionVPRHP+$excepcionVPMV+$excepcionVPMP+$excepcionVPVV+$excepcionVPVP !!}</b></td>
                        <td align='center'><b>{!! $excepcionVPFV+$excepcionVPRHV+$excepcionVPMV+$excepcionVPVV !!}</b></td>
                        <td align='center'><b>{!! $excepcionVPFP+$excepcionVPRHP+$excepcionVPMP+$excepcionVPVP !!}</b></td>
                    </tr>
                          
                </tbody>
              </table>
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
    window.location.href="fechas_excep?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val();

  });

  $('#td_vpvv').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Ventas </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Vacaciones</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $vac=0;
                    @endphp                          
                    @foreach($departamentosVPV as $dep)   
                        @forelse ($depVPVVE as $depVVE)
                            @if ($dep->des_edo_neg == $depVVE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depVVE->excevac !!}</td>
                                    @php
                                        $vac=$vac+$depVVE->excevac;
                                    @endphp
                                    <td align='left'>{!! $depVVE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vpvp').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Ventas </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Permisos</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $per=0;
                    @endphp                          
                    @foreach($departamentosVPV as $dep)   
                        @forelse ($depVPVPE as $depVPE)
                            @if ($dep->des_edo_neg == $depVPE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depVPE->exceper !!}</td>
                                    @php
                                        $per=$per+$depVPE->exceper;
                                    @endphp
                                    <td align='left'>{!! $depVPE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vprhv').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Recursos Humanos </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Vacaciones</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $vac=0;
                    @endphp                          
                    @foreach($departamentosVPRH as $dep)   
                        @forelse ($depVPRHVE as $depRHVE)
                            @if ($dep->des_edo_neg == $depRHVE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depRHVE->excevac !!}</td>
                                    @php
                                        $vac=$vac+$depRHVE->excevac;
                                    @endphp
                                    <td align='left'>{!! $depRHVE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vprhp').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Recursos Humanos </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Permisos</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $per=0;
                    @endphp                          
                    @foreach($departamentosVPRH as $dep)   
                        @forelse ($depVPRHPE as $depRHPE)
                            @if ($dep->des_edo_neg == $depRHPE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depRHPE->exceper !!}</td>
                                    @php
                                        $per=$per+$depRHPE->exceper;
                                    @endphp
                                    <td align='left'>{!! $depRHPE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vpmv').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Manufactura </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Vacaciones</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $vac=0;
                    @endphp                          
                    @foreach($departamentosVPM as $dep)   
                        @forelse ($depVPMVE as $depMVE)
                            @if ($dep->des_edo_neg == $depMVE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depMVE->excevac !!}</td>
                                    @php
                                        $vac=$vac+$depMVE->excevac;
                                    @endphp
                                    <td align='left'>{!! $depMVE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vpmp').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Manufactura </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Permisos</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $per=0;
                    @endphp                          
                    @foreach($departamentosVPM as $dep)   
                        @forelse ($depVPMPE as $depMPE)
                            @if ($dep->des_edo_neg == $depMPE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depMPE->exceper !!}</td>
                                    @php
                                        $per=$per+$depMPE->exceper;
                                    @endphp
                                    <td align='left'>{!! $depMPE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vpfv').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Finanzas </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Vacaciones</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $vac=0;
                    @endphp                          
                    @foreach($departamentosVPF as $dep)   
                        @forelse ($depVPFVE as $depFVE)
                            @if ($dep->des_edo_neg == $depFVE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depFVE->excevac !!}</td>
                                    @php
                                        $vac=$vac+$depFVE->excevac;
                                    @endphp
                                    <td align='left'>{!! $depFVE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });

  $('#td_vpfp').click(function () {
    Swal.fire({
      
    html: `
    <div class="content">
  
    
      <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Vicepresidencia Finanzas </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Area</th>
                  <th >Permisos</th>
                  <th >Persona que Autoriza</th>
                </thead>
                <tbody>                   
                    @php
                        $per=0;
                    @endphp                          
                    @foreach($departamentosVPF as $dep)   
                        @forelse ($depVPFPE as $depFPE)
                            @if ($dep->des_edo_neg == $depFPE->des_edo_neg )    
                                <tr>
                                    <td align='left'>{!! $dep->des_edo_neg !!}</td>
                                    <td align='center'>{!! $depFPE->exceper !!}</td>
                                    @php
                                        $per=$per+$depFPE->exceper;
                                    @endphp
                                    <td align='left'>{!! $depFPE->Puesto !!}</td>
                            @else   
                            @endif 
                       
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
    width: '800px'
});
  });
  </script>
@endpush