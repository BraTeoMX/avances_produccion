@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('Vicepresidencia Recursos Humanos')])

@section('content')
  <div class="content">
  
    <div class="container-fluid">
    <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Detalle Permisos Vicepresidencia Recursos Humanos</span>
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
              <h4 class="card-title">Reporte de Atencion de Permisos </h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Atendidos por</th>
                  <th>Total de Permiso</th>
                  <th>Autorizados</th>
                  <th>Denegados</th>
                  <th>Cancelados</th>
                  <th>Pendientes</th>
                </thead>
                <tbody>
                @php
                    $total=0;
                    $totalVPRHa = 0;
                    $totalVPRHd = 0;
                    $totalVPRHp = 0;
                    $totalVPRHc = 0;
                  @endphp
                @foreach($departamentoVPRH as $dep)       
                 
                <tr>
                    <td>{!! $dep->Puesto !!}</td>
                    @php
                      $valor1=0;
                      $valor2=0;
                      $valor3=0;
                      $valor4=0;
                    @endphp
                    <td align='center'>{!! $dep->contper !!}</td>

                    @forelse ($permisosVPRHA as $VPRHa)
                      @if($dep->Puesto == $VPRHa->Puesto)
                        <td align='center'>{!! $VPRHa->vprha !!}</td>
                        @php
                          $totalVPRHa=$totalVPRHa + $VPRHa->vprha;
                          $valor1=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                      @php
                          $valor1=1;
                      @endphp
                    @endforelse
                    @if($valor1==0)
                      <td align='center'>0</td>
                    @endif

                    @forelse ($permisosVPRHD as $VPRHd)
                      @if($dep->Puesto == $VPRHd->Puesto)
                        <td align='center'>{!! $VPRHd->vprhd !!}</td>
                        @php
                          $totalVPRHd=$totalVPRHd + $VPRHd->vprhd;
                          $valor2=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                      @php
                          $valor2=1;
                      @endphp
                    @endforelse
                    @if($valor2==0)
                      <td align='center'>0</td>
                    @endif

                    @forelse ($permisosVPRHC as $VPRHc)
                      @if($dep->Puesto == $VPRHc->Puesto)
                        <td align='center'>{!! $VPRHc->vprhc !!}</td>
                        @php
                          $totalVPRHc=$totalVPRHc + $VPRHc->vprhc;
                          $valor3=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                      @php
                          $valor3=1;
                      @endphp
                    @endforelse
                    @if($valor3==0)
                      <td align='center'>0</td>
                    @endif

                    @forelse ($permisosVPRHP as $VPRHp)
                      @if($dep->Puesto == $VPRHp->Puesto)
                        <td align='center'>{!! $VPRHp->vprhp !!}</td>
                        @php
                          $totalVPRHp=$totalVPRHp + $VPRHp->vprhp;
                          $valor4=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                      @php
                          $valor4=1;
                      @endphp
                    @endforelse
                    @if($valor4==0)
                      <td align='center'>0</td>
                    @endif

                </tr>
                @endforeach 
                  <tr>
                    <td><b>Total</b></td>
                   
                    <td align='center'><b>{{ number_format($permisosVPRH,0) }}</b></td>
                    
                    <td align='center'><b>{{ number_format($totalVPRHa,0) }}</b></td>
                    <td align='center'><b>{{ number_format($totalVPRHd,0) }}</b></td>
                    <td align='center'><b>{{ number_format($totalVPRHc,0) }}</b></td>
                    <td align='center'><b>{{ number_format($totalVPRHp,0) }}</b></td>
                  </tr>
               
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Permisos x Dia con Goce de Sueldo</p>
              <h3 class="card-title">{{  number_format($sumdcs,0) }}</h3>
              <input type="hidden" id="vacaciones" name="vacaciones" value={{ $permisosVPRH }} />
              <input type="hidden" id="departamentoP01" name="departamentoP01" value={{ $departamentoP01 }} />
              <input type="hidden" id="departamentoP02" name="departamentoP02" value={{ $departamentoP02 }} />
              <input type="hidden" id="departamentoP03" name="departamentoP03" value={{ $departamentoP03 }} />
              <input type="hidden" id="departamentoP04" name="departamentoP04" value={{ $departamentoP04 }} />
              <input type="hidden" id="departamentoP05" name="departamentoP05" value={{ $departamentoP05 }} />
              <input type="hidden" id="departamentoP06" name="departamentoP06" value={{ $departamentoP06 }} />
              <input type="hidden" id="departamentoP07" name="departamentoP07" value={{ $departamentoP07 }} />
              <input type="hidden" id="departamentoP08" name="departamentoP08" value={{ $departamentoP08 }} />
              <input type="hidden" id="departamentoP09" name="departamentoP09" value={{ $departamentoP09 }} />
              <input type="hidden" id="departamentoP10" name="departamentoP10" value={{ $departamentoP10 }} />
              <input type="hidden" id="departamentoP11" name="departamentoP11" value={{ $departamentoP11 }} />
              <input type="hidden" id="departamentoP12" name="departamentoP12" value={{ $departamentoP12 }} />
                <small></small>
              </h3>
            </div>
            @foreach($permisodcs as $dcs) 
            <div class="card-footer" style="align:center">
              <p class="stats"> <span class="text-success">{{ $dcs->permiso }}   : 
                  @forelse ($permisosdcs as $perdcs) 
                    @if($perdcs->tipo_per == $dcs->id_permiso) 
                      {{ $perdcs->perdcs }} 
                    @endif 
                  @empty  
                  @endforelse</span></p>
            </div>   
           @endforeach 
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Permisos x Dia </br>Sin Goce de Sueldo</p>
              <h3 class="card-title">{{number_format($sumdss,0)}}</h3>
              <input type="hidden" id="permisos" name="permisos" value={{ $permisosVPRH }} />
            </div>
            @foreach($permisodss as $dss) 
            <div class="card-footer" style="align:center">
              <p class="stats"> <span class="text-success">{{ $dss->permiso }}   : 
                  @forelse ($permisosdss as $perdss) 
                    @if($perdss->tipo_per == $dss->id_permiso) 
                      {{ $perdss->perdss }} 
                    @endif 
                  @empty  
                  @endforelse</span></p>
            </div>   
           @endforeach 
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Permisos x Horas </br>con Goce de Sueldo</p></br>
              <h3 class="card-title">{{ number_format($sumhcs,0) }}</h3>
              <input type="hidden" id="permisos" name="permisos" value={{ $permisosVPRH }} />
            </div>
            @foreach($permisohcs as $hcs) 
            <div class="card-footer" style="align:left">
              <p class="stats"> <span class="text-success">{{ $hcs->permiso }}   : 
                  @forelse ($permisoshcs as $perhcs) 
                    @if($perhcs->tipo_per == $hcs->id_permiso) 
                      {{ $perhcs->perhcs }} 
                    @endif 
                  @empty  
                  @endforelse</span></p>
            </div>   
           @endforeach 
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Permisos x Horas </br>sin Goce de Sueldo</p></br>
              <h3 class="card-title"> {{ number_format($sumhss,0)}}</h3>
              <input type="hidden" id="permisos" name="permisos" value={{ $permisosVPRH }} />
            </div>
            @foreach($permisohss as $hss) 
            <div class="card-footer" style="align:center">
              <p class="stats"> <span class="text-success">{{ $hss->permiso }}   : 
                  @forelse ($permisoshss as $perhss) 
                    @if($perhss->tipo_per == $hss->id_permiso) 
                      {{ $perhss->perhss }} 
                    @endif 
                  @empty  
                  @endforelse</span></p>
            </div>   
           @endforeach 
          </div>
        </div>
      </div>
        <!--<div class="row">
        <div class="col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="websiteViewsChart6"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Incidencias x Mes</h4>
              <p class="card-category">Permisos</p>
            </div>-->
           <!-- <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>-->
        <!--  </div>
        </div>
          </div>-->
        
        
        <div class="row">
                <div class="col center"><a href="{{ route('home') }}"  class="btn btn-primary">Regresar</a>
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
    window.location.href="fechasVPRH2?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val();
    
    //        }

  });

 
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initdashboardPageCharts();
    });

    var dataWebsiteViewsChart6 = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        series: [
            [$('#departamentoP01').val(),$('#departamentoP02').val(),$('#departamentoP03').val(),$('#departamentoP04').val(),$('#departamentoP05').val(),$('#departamentoP06').val(),$('#departamentoP07').val(),$('#departamentoP08').val(),$('#departamentoP09').val(),$('#departamentoP10').val(),$('#departamentoP11').val(),$('#departamentoP12').val()], 
          [$('#departamentoP01').val(),$('#departamentoP02').val(),$('#departamentoP03').val(),$('#departamentoP04').val(),$('#departamentoP05').val(),$('#departamentoP06').val(),$('#departamentoP07').val(),$('#departamentoP08').val(),$('#departamentoP09').val(),$('#departamentoP10').val(),$('#departamentoP11').val(),$('#departamentoP12').val()]
        ]
      };
      var optionsWebsiteViewsChart6 = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 100,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions6 = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 2,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart6 = Chartist.Line('#websiteViewsChart6', dataWebsiteViewsChart6, optionsWebsiteViewsChart6, responsiveOptions6);

      //start animation for the Emails Subscription Chart
      md.startAnimationForBarChart(websiteViewsChart6);

      var dataWebsiteViewsChart7 = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        series: [
            [$('#departamentoP01').val(),$('#departamentoP02').val(),$('#departamentoP03').val(),$('#departamentoP04').val(),$('#departamentoP05').val(),$('#departamentoP06').val(),$('#departamentoP07').val(),$('#departamentoP08').val(),$('#departamentoP09').val(),$('#departamentoP10').val(),$('#departamentoP11').val(),$('#departamentoP12').val()], 
            [$('#departamentoP01').val(),$('#departamentoP02').val(),$('#departamentoP03').val(),$('#departamentoP04').val(),$('#departamentoP05').val(),$('#departamentoP06').val(),$('#departamentoP07').val(),$('#departamentoP08').val(),$('#departamentoP09').val(),$('#departamentoP10').val(),$('#departamentoP11').val(),$('#departamentoP12').val()]
        ]
      };
      var optionsWebsiteViewsChart7 = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 10,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions7 = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 2,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart7 = Chartist.Line('#websiteViewsChart7', dataWebsiteViewsChart7, optionsWebsiteViewsChart7, responsiveOptions7);

      //start animation for the Emails Subscription Chart
      md.startAnimationForBarChart(websiteViewsChart7);
  </script>
@endpush