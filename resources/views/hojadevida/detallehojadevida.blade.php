@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Hoja de  Vida')])

@section('content')
<div class="content">
  <div class="container-fluid">
  <div class="card-body">           
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
    </div> 
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
          @foreach($no_empleado as $emp)   
            <h4 class="card-title mt-0"> {{ $emp->No_Empleado.' '.$emp->Ap_Pat.' '.$emp->Ap_Mat.' '.$emp->Nom_Emp }}</h4>
            <input type="hidden" id="empleado" name="empleado" value={{ $emp->No_Empleado }} />
            <p class="card-category"> <b>Hoja de Vida</b> </br>Departamento :  {{ $emp->des_edo_neg }}</br>Puesto :  {{ $emp->Puesto }}</p>
            @endforeach  
          </div>
          <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">luggage</i>
              </div>
              <p class="card-category">Vacaciones</br></p></br>
              <h3 class="card-title">{{ number_format($vacaciones->count()+$vacaciones2->count(),0) }}
                <small></small>
              </h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">directions_walk</i>
              </div>
              <p class="card-category">Permisos</br></p></br>
              <h3 class="card-title">{{ number_format($permisos->count()+$permisos2->count(),0) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Faltas Justificadas</br></p></br>
              <h3 class="card-title">{{ number_format($faltas_justificadas->count()+$faltasjustificadas2->count(),0) }}</h3>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
              <i class="material-icons">local_hospital</i>
              </div>
              <p class="card-category">Incapacidades</br></p></br>
              <h3 class="card-title">{{ number_format($incapacidades->count()+$incapacidades2->count(),0) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-secondary card-header-icon">
              <div class="card-icon">
              <i class="material-icons">watch_later</i>
              </div>
              <p class="card-category">Retardos</p></br>
              <h3 class="card-title">{{ number_format($retardos->count(),0) }}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
              <i class="material-icons">no_accounts</i>
              </div>
              <p class="card-category">Faltas Injustificadas</p></br>
              <h3 class="card-title">{{ number_format($faltasinjustificadas->count(),0) }}</h3>
            </div>
          </div>
        </div>
      </div>
         
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    Incidencia
                  </th>
                  <th>
                    Fecha Inicial
                  </th>
                  <th>
                    Fecha Final
                  </th>
                  <th>
                    No. Días
                  </th>
                  <th>
                    Tipo
                  </th>
                  <th>
                    Estatus
                  </th>
                  <th>
                    Autorizó
                  </th>
                </thead>
                <tbody>
                   

                    @if($vacaciones->count()>0)
                        @foreach($vacaciones as $vac)  
                          @if($vac->excepcion==1)
                            <tr style="background-color : #f77a40">
                          @else
                            <tr style="background-color : #F1C871">
                          @endif  
                                <td> VACACIONES</td>
                                <td>
                                    {{ $vac->fech_ini_vac }}
                                </td>
                                <td>
                                    {{ $vac->fech_fin_vac }}
                                </td>
                                <td>
                                    {{ $vac->dias_solicitud }}
                                </td>
                                @if($vac->eventualidades==1)
                                  @if($vac->excepcion==1)
                                    <td>EXCEPCIÓN(EVENTUALIDAD)</td>
                                  @else
                                    <td>EVENTUALIDAD</td>
                                  @endif  
                                @else
                                  @if($vac->periodos==1)
                                    @if($vac->excepcion==1)
                                      <td>EXCEPCIÓN(PERIODO)</td>
                                    @else
                                      <td>PERIODO</td>
                                    @endif  
                                  @else
                                    <td>EMPRESA</td>
                                  @endif  
                                @endif  
                                <td>
                                    {{ $vac->status }}
                                </td>
                                <td>
                                    {{ $vac->Puesto }}
                                </td>
                            </tr>
                        @endforeach
                    @endif    
                    @if($vacaciones2->count()>0)
                        @foreach($vacaciones2 as $vac2)  
                          <tr style="background-color : #F1C871">
                                <td> VACACIONES</td>
                                <td>
                                    {{ $vac2->fecha_falta }}
                                </td>
                                <td>
                                    {{ $vac2->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    

                    @if($permisos->count()>0)
                        @foreach($permisos as $per)  
                          @if($per->excepcion==1)
                            <tr style="background-color : #f77a40">
                          @else
                            <tr style="background-color : #D4F171">
                          @endif  
                                <td> PERMISO</td>
                                <td>
                                    {{ $per->fech_ini_per }}
                                </td>
                                <td>
                                    {{ $per->fech_fin_per }}
                                </td>
                                <td>
                                    {{ $per->dias }}
                                </td>
                                @if($per->excepcion==1)
                                  <td>
                                      Excepcion({{ $per->permiso }})
                                  </td>
                                @else
                                  <td>
                                      {{ $per->permiso }}
                                  </td>
                                @endif
                                <td>
                                    {{ $per->status }}
                                </td>
                                <td>
                                    {{ $per->Puesto }}
                                </td>
                            </tr>
                        @endforeach
                    @endif    
                    @if($permisos2->count()>0)
                        @foreach($permisos2 as $per2)  
                          <tr style="background-color : #D4F171">
                                <td> PERMISO</td>
                                <td>
                                    {{ $per2->fecha_falta }}
                                </td>
                                <td>
                                    {{ $per2->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    {{ $per2->IdJustificacion }}
                                </td>
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    

                    @if($faltas_justificadas->count()>0)
                        @foreach($faltas_justificadas as $fal)  
                            <tr style="background-color : #fa3243">
                                <td> FALTA JUSTIFICADA</td>
                                <td>
                                    {{ $fal->fecha_inicio_justificar }}
                                </td>
                                <td>
                                    {{ $fal->fecha_fin_justificar }}
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    
                    @if($faltasjustificadas2->count()>0)
                        @foreach($faltasjustificadas2 as $fal2)  
                          <tr style="background-color : #fa3243">
                                <td> FALTA JUSTIFICADA</td>
                                <td>
                                    {{ $fal2->fecha_falta }}
                                </td>
                                <td>
                                    {{ $fal2->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    

                    @if($incapacidades->count()>0)
                        @foreach($incapacidades as $inc)  
                            <tr style="background-color : #a3e4f7">
                                <td> INACAPACIDAD</td>
                                <td>
                                    {{ $inc->fecha_inicio }}
                                </td>
                                <td>
                                    {{ $inc->fecha_fin }}
                                </td>
                                <td>
                                
                                </td>
                            </tr>
                        @endforeach
                    @endif  
                    @if($incapacidades2->count()>0)
                        @foreach($incapacidades2 as $inc2)  
                          <tr style="background-color : #a3e4f7">
                                <td> INCAPACIDAD</td>
                                <td>
                                    {{ $inc2->fecha_falta }}
                                </td>
                                <td>
                                    {{ $inc2->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    

                    @if($retardos->count()>0)
                        @foreach($retardos as $ret)  
                            <tr style="background-color : #9d9d9e">
                                <td> RETARDO</td>
                                <td>
                                    {{ $ret->fecha_falta }}
                                </td>
                                <td>
                                    {{ $ret->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    RETARDO
                                </td>
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    

                    @if($faltasinjustificadas->count()>0)
                        @foreach($faltasinjustificadas as $fi)  
                            <tr style="background-color : #f3a8f7">
                                <td> FALTA INJUSTIFICADA</td>
                                <td>
                                    {{ $fi->fecha_falta }}
                                </td>
                                <td>
                                    {{ $fi->fecha_falta }}
                                </td>
                                <td>
                                    1
                                </td>
                                @if($fi->IdJustificacion=='suspension')
                                  <td>
                                      SUSPENSION
                                  </td>
                                @else
                                  <td>
                                      FALTA INJUSTIFICADA
                                  </td>
                                @endif
                                <td>
                                    APLICADO
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif    
                      
                </tbody>
              </table>
              <div class="row">
                <div class="col center"><a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
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
    window.location.href="/fechashojadevida?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val()+"&empleado="+$('#empleado').val();
    
  });


$(document).ready(function() {
   $("#buscar_emp").click(function(){
        window.location.href="hojadevida?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val()+"&empleado="+$('#empleado').val();
    
    }); 

    
});
  </script>
  @endpush