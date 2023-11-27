@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('Vicepresidencia Manufactura')])

@section('content')
  <div class="content">
  
    <div class="container-fluid">
    <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">VICEPRESIDENCIA MANUFACTURA</span>
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
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">luggage</i>
              </div>
              <p class="card-category">Vacaciones</br>(Dias)</p></br>
              <h3 class="card-title">{{ number_format($vacacionesDDVPM,0) }}
              <input type="hidden" id="vacaciones" name="vacaciones" value={{ $vacacionesVPM }} />
              <input type="hidden" id="departamentoV01" name="departamentoV01" value={{ $departamentoV01 }} />
              <input type="hidden" id="departamentoV02" name="departamentoV02" value={{ $departamentoV02 }} />
              <input type="hidden" id="departamentoV03" name="departamentoV03" value={{ $departamentoV03 }} />
              <input type="hidden" id="departamentoV04" name="departamentoV04" value={{ $departamentoV04 }} />
              <input type="hidden" id="departamentoV05" name="departamentoV05" value={{ $departamentoV05 }} />
              <input type="hidden" id="departamentoV06" name="departamentoV06" value={{ $departamentoV06 }} />
              <input type="hidden" id="departamentoV07" name="departamentoV07" value={{ $departamentoV07 }} />
              <input type="hidden" id="departamentoV08" name="departamentoV08" value={{ $departamentoV08 }} />
              <input type="hidden" id="departamentoV09" name="departamentoV01" value={{ $departamentoV09 }} />
              <input type="hidden" id="departamentoV10" name="departamentoV10" value={{ $departamentoV10 }} />
              <input type="hidden" id="departamentoV11" name="departamentoV11" value={{ $departamentoV11 }} />
              <input type="hidden" id="departamentoV12" name="departamentoV12" value={{ $departamentoV12 }} />
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
              <input type="hidden" id="departamentoFJ01" name="departamentoFJ01" value={{ $departamentoFJ01 }} />
              <input type="hidden" id="departamentoFJ02" name="departamentoFJ02" value={{ $departamentoFJ02 }} />
              <input type="hidden" id="departamentoFJ03" name="departamentoFJ03" value={{ $departamentoFJ03 }} />
              <input type="hidden" id="departamentoFJ04" name="departamentoFJ04" value={{ $departamentoFJ04 }} />
              <input type="hidden" id="departamentoFJ05" name="departamentoFJ05" value={{ $departamentoFJ05 }} />
              <input type="hidden" id="departamentoFJ06" name="departamentoFJ06" value={{ $departamentoFJ06 }} />
              <input type="hidden" id="departamentoFJ07" name="departamentoFJ07" value={{ $departamentoFJ07 }} />
              <input type="hidden" id="departamentoFJ08" name="departamentoFJ08" value={{ $departamentoFJ08 }} />
              <input type="hidden" id="departamentoFJ09" name="departamentoFJ09" value={{ $departamentoFJ09 }} />
              <input type="hidden" id="departamentoFJ10" name="departamentoFJ10" value={{ $departamentoFJ10 }} />
              <input type="hidden" id="departamentoFJ11" name="departamentoFJ11" value={{ $departamentoFJ11 }} />
              <input type="hidden" id="departamentoFJ12" name="departamentoFJ12" value={{ $departamentoFJ12 }} />
              <input type="hidden" id="departamentoI01" name="departamentoI01" value={{ $departamentoI01 }} />
              <input type="hidden" id="departamentoI02" name="departamentoI02" value={{ $departamentoI02 }} />
              <input type="hidden" id="departamentoI03" name="departamentoI03" value={{ $departamentoI03 }} />
              <input type="hidden" id="departamentoI04" name="departamentoI04" value={{ $departamentoI04 }} />
              <input type="hidden" id="departamentoI05" name="departamentoI05" value={{ $departamentoI05 }} />
              <input type="hidden" id="departamentoI06" name="departamentoI06" value={{ $departamentoI06 }} />
              <input type="hidden" id="departamentoI07" name="departamentoI07" value={{ $departamentoI07 }} />
              <input type="hidden" id="departamentoI08" name="departamentoI08" value={{ $departamentoI08 }} />
              <input type="hidden" id="departamentoI09" name="departamentoI08" value={{ $departamentoI09 }} />
              <input type="hidden" id="departamentoI10" name="departamentoI10" value={{ $departamentoI10 }} />
              <input type="hidden" id="departamentoI11" name="departamentoI11" value={{ $departamentoI11 }} />
              <input type="hidden" id="departamentoI12" name="departamentoI12" value={{ $departamentoI12 }} />
                <small></small>
              </h3>
            </div>
            <div class="card-footer" style="align:center">
             <!-- <p class="stats"><span class="text-success"> Aplicados : </span>  {{ number_format($vacacionesVPMA,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Denegados : </span>  {{ number_format($vacacionesVPMD,0) }}</p></br>-->
              <p class="stats"><span class="text-success"> Eventualidades : </span>  {{ number_format($vacacionesEvenVPM,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Periodos : </span>  {{ number_format($vacacionesPerVPM,0) }}</p></br>
            </div>   
            <div class="card-footer" style="align:center">
             <!-- <p class="stats"><span class="text-success"> Cancelados  :</span>  {{ number_format($vacacionesVPMC,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Pendientes  : </span>  {{ number_format($vacacionesVPMP,0) }}</p></br>-->
              <p class="stats"><span class="text-success"> Excepciones  :</span>  {{ number_format($vacacionesExcVPM,0) }}</p></br>
             
            </div>   
          
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepcionesVPM') }}">Detalle Excepciones...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">directions_walk</i>
              </div>
              <p class="card-category">Permisos</br>(Eventos)</p></br>
              <h3 class="card-title">{{ number_format($permisosVPM,0) }}</h3>
              <input type="hidden" id="permisos" name="permisos" value={{ $permisosVPM }} />
            </div>
            <div class="card-footer" style="align:center">
             <p class="stats"><span class="text-success"> Dias C/S : </span>  {{ number_format($permisosDCSVPM,0) }}</p></br>
              <p class="stats"> <span class="text-success">Dias S/S : </span>  {{ number_format($permisosDSSVPM,0) }}</p></br>
              
           <!--   <p class="stats"><span class="text-success"> Aplicados : </span>  {{ number_format($permisosVPMA,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Denegados : </span>  {{ number_format($permisosVPMD,0) }}</p></br>-->
            </div>   
            <div class="card-footer" style="align:center">
            <p class="stats"><span class="text-success"> Horas C/S  :</span>  {{ number_format($permisosHCSVPM,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Horas S/S  : </span>  {{ number_format($permisosHSSVPM,0) }}</p></br>
            <!--  <p class="stats"><span class="text-success"> Cancelados  :</span>  {{ number_format($permisosVPMC,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Pendientes  : </span>  {{ number_format($permisosVPMP,0) }}</p></br>-->
            </div>
          <!--  <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> 
                <a href="#pablo">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">contact_page</i>
              </div>
              <p class="card-category">Faltas Justificadas</br>(Eventos)</p>
              <h3 class="card-title">{{ number_format($faltasjustificadasVPM,0) }}</h3>
              <input type="hidden" id="faltas_justificadas" name="faltas_justificadas" value={{ $faltasjustificadasVPM }} />
            </div>
            <div class="card-footer" style="align:center">
              <p class="stats"><span class="text-success"> Enfermedad Trabajador : </span>  {{ number_format($faltasM1VPM,0) }}</p></br>
              <p class="stats"> <span class="text-success">Legal : </span>  {{ number_format($faltasM3VPM,0) }}</p></br>
            </div>   
            <div class="card-footer" style="align:center">
              <p class="stats"><span class="text-success"> Enfermedad Familiar  :</span>  {{ number_format($faltasM2VPM,0) }}</p></br>
              <p class="stats"> <span class="text-success"> Escolar : </span>  {{ number_format($faltasM4VPM,0) }}</p></br>
            </div>
            <div class="card-footer" style="align:center">
              <p class="stats"><span class="text-success"> Familiar Internado  :</span>  {{ number_format($faltasM6VPM,0) }}</p></br>
              <p class="stats">
            </div>  
           <!-- <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> 
                <a href="#pablo">Detalle...</a>
              </div>
            </div>-->
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
              <p class="card-category">Incapacidades</br>(Días)</p></br>
              <h3 class="card-title">{{ number_format($incapacidadesDDVPM,0) }}</h3>
              <input type="hidden" id="incapacidades" name="vacaciones" value={{ $incapacidadesVPM }} />
            </div>
           <!-- <div class="card-footer" style="align:center">
              <p class="stats"><span class="text-success"> Inicial : </span>  {{ number_format($incapacidadesIVPM,0) }}</p></br>
              <p class="stats"> <span class="text-success">Subsecuente : </span>  {{ number_format($incapacidadesSVPM,0) }}</p></br>
            </div>-->  
            <!--<div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> 
                <a href="#pablo">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-secondary card-header-icon">
              <div class="card-icon">
              <i class="material-icons">watch_later</i>
              </div>
              <p class="card-category">Retardos</br>(Eventos)</p></br>
              <h3 class="card-title">{{ number_format($retardosVPM,0) }}</h3>
              <input type="hidden" id="incapacidades" name="vacaciones" value={{ $retardosVPM }} />
            </div>
            
          <!--  <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> 
                <a href="#pablo">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
              <i class="material-icons">no_accounts</i>
              </div>
              <p class="card-category">Faltas Injustificadas</br>(Eventos)</p></br>
              <h3 class="card-title">{{ number_format($faltasinjustificadasVPM,0) }}</h3>
              <input type="hidden" id="incapacidades" name="vacaciones" value={{ $faltasinjustificadasVPM }} />
            </div>

          <!--  <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> 
                <a href="#pablo">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
      </div>
      
     <div class="row">
     
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-info">
              <h4 class="card-title">Reporte Vicepresidencia Manufactura</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-info">
                  <th>Estado de Negocio</th>
                  <th style="text-align: center">No. Personas </br>(Actual)</th>
                  <th style="text-align: center">Vacaciones  </br>(Eventos)</th>
                  <th style="text-align: center">Vacaciones  </br>(Días)</th>
                  <th style="text-align: center">Permisos</br>(Eventos)</th>
                  <th style="text-align: center">Permisos</br>(Días)</th>
                  <th style="text-align: center">Faltas Justificadas</br>(Eventos/Días)</th>
                  <th style="text-align: center">Incapacidades</br>(Eventos)</th>
                  <th style="text-align: center">Incapacidades</br>(Días)</th>
                  <th style="text-align: center">Retardos</br>(Eventos/Días)</th>
                  <th style="text-align: center">Faltas Injustificadas</br>(Eventos/Días)</th>
                </thead>
                <tbody>
                @php
                    $totalper=0;
                    $total_diasv=0;
                    $total_diasp=0;
                    $total_diasi=0;
                  @endphp
                @foreach($departamento as $dep)       
                  @php
                    $total=0;
                    $total1=0;
                    
                  @endphp
                <tr>
                    <td>{!! $dep->des_edo_neg !!}</td>
                    @php
                      $valor2=0;
                      
                    @endphp
                    @foreach($perVPM as $per)
                        
                          @if($dep->des_edo_neg == $per->des_edo_neg)
                            @php
                              $totalper = $totalper + $per->perVPM;
                            @endphp
                            <td align='center'>{!! $per->perVPM !!}</td>
                           
                          @else
                           
                          @endif 
                          
                    @endforeach  
                    @forelse($departamentoV as $depV)
                      @if($depV->des_edo_neg == $dep->des_edo_neg)
                           
                       
                        @php
                          $total=$total+$depV->vac;
                          $total_diasv = $total_diasv+$depV->vacdias;
                        @endphp
                        <td align='center'>{!! $depV->vac !!}</td>
                        <td align='center'>{{ $depV->vacdias }}</br><font color=blue size=2.0px>{{ ' ('.number_format(($depV->vacdias)/$per->perVPM,1).' d/p)' }}</font></td>
                        @php
                          $valor2=1;
                        @endphp
                      @endif
                    @empty
                      <td align='center'>0</td> 
                      <td align='center'>0</td> 
                      @php
                        $valor2=1;
                      @endphp  
                    @endforelse
                    @if($valor2==0)
                      <td align='center'>0</td>
                      <td align='center'>0</td> 
                    @endif

                    @php
                      $valor3=0;
                    @endphp
                    @forelse($departamentoP as $depP)
                      @if($depP->des_edo_neg == $dep->des_edo_neg)
                        @php
                          $total=$total+$depP->per;
                          $total_diasp = $total_diasp+$depP->perdias;
                        @endphp
                        @if ($permisosVPM != 0 )
                        <td align='center'>{!! $depP->per !!}</br><font color=blue size=2.5px>{{ '('.number_format(($depP->per*100)/$permisosVPM,2).'%)' }}</font></td>
                        @else
                        <td align='center'>{!! $depP->per !!}</br><font color=blue size=2.5px>{{ '('.number_format(0,2).'%)' }}</font></td>
                        @endif
                        <td align='center'>{{ $depP->perdias }}</br></td>
                        @php
                          $valor3=1;
                        @endphp
                      @endif
                    @empty
                      <td align='center'>0</td>
                      <td align='center'>0</td> 
                      @php
                        $valor3=1;
                      @endphp  
                    @endforelse
                    @if($valor3==0)
                      <td align='center'>0</td>
                      <td align='center'>0</td> 
                    @endif

                    @php
                      $valor=0;
                   @endphp
                    @forelse($departamentoFJ as $depFJ)
                      @if($depFJ->des_edo_neg == $dep->des_edo_neg)
                        @php
                          $total=$total+$depFJ->fal;
                        @endphp
                        <td align='center'>{!! $depFJ->fal !!}</td>
                        @php
                          $valor=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                    
                      @php
                        $valor=1;
                      @endphp
                    @endforelse
                   @if($valor==0)
                   <td align='center'>0</td>
                   
                   @endif
                   
                   @php
                    $valor1=0;
                   @endphp
                   @forelse($departamentoI as $depI)
                      @if($depI->des_edo_neg == $dep->des_edo_neg)
                        @php
                          $total=$total+$depI->inc;
                          $total_diasi = $total_diasi+$depI->incdias;
                        @endphp
                        <td align='center'>{!! $depI->inc !!}</td>
                        <td align='center'>{{ $depI->incdias }}</br><font color=blue size=2.0px>{{ ' ('.number_format(($depI->incdias)/$per->perVPM,1).' d/p)' }}</font></td>
                        @php
                          $valor1=1;
                        @endphp
                      @else
                      @endif  
                  @empty
                    <td align='center'>0</td>
                    <td align='center'>0</td> 
                    @php
                        $valor1=1;
                    @endphp
                  @endforelse
                   @if($valor1==0)
                   <td align='center'>0</td>
                   <td align='center'>0</td> 
                   @endif

                   @php
                      $valor=0;
                   @endphp
                    @forelse($departamentoR as $depR)
                      @if($depR->des_edo_neg == $dep->des_edo_neg)
                        @php
                          $total=$total+$depR->ret;
                        @endphp
                        <td align='center'>{!! $depR->ret !!}</td>
                        @php
                          $valor=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                    
                      @php
                        $valor=1;
                      @endphp
                    @endforelse
                   @if($valor==0)
                   <td align='center'>0</td>
                   
                   @endif


                   @php
                      $valor=0;
                   @endphp
                    @forelse($departamentoFI as $depFI)
                      @if($depFI->des_edo_neg == $dep->des_edo_neg)
                        @php
                          $total=$total+$depFI->fi;
                        @endphp
                        <td align='center'>{!! $depFI->fi !!}</td>
                        @php
                          $valor=1;
                        @endphp
                      @else
                      @endif  
                    @empty
                      <td align='center'>0</td>
                    
                      @php
                        $valor=1;
                      @endphp
                    @endforelse
                   @if($valor==0)
                   <td align='center'>0</td>
                   
                   @endif
                  </tr>
                @endforeach 
                  <tr>
                    <td><b>Total</b></td>
                    <td align='center'><b>{{ number_format($totalper,0) }}</b></td>
                    <td align='center'><b>{{ number_format($vacacionesVPM,0) }}</b></td>
                    @if($totalper != 0)
                    <td align='center'><b>{{ number_format($total_diasv,0) }}</br><font color=blue size=2.0px>{{ ' ('.number_format(($total_diasv)/$totalper,1).' d/p)' }}</font></b></td>  
                    @else
                    <td align='center'><b>{{ number_format($total_diasv,0) }}</br><font color=blue size=2.0px>{{ ' ('.number_format(0,1).' d/p)' }}</font></b></td>  
                    @endif
                    @if($permisosVPM != 0)
                    <td align='center'><b>{{ number_format($permisosVPM,0) }}</br><font color=blue size=2.5px>{{ '('.number_format(($permisosVPM*100)/$permisosVPM,2).'%)' }}</font></b></td>
                    @else
                    <td align='center'><b>{{ number_format($permisosVPM,0) }}</br><font color=blue size=2.5px>{{ '('.number_format(0,2).'%)' }}</font></b></td>
                    @endif
                    <td align='center'><b>{{ number_format($total_diasp,0) }}</b></td>
                    <td align='center'><b>{{ number_format($faltasjustificadasVPM,0) }}</b></td>
                    <td align='center'><b>{{ number_format($incapacidadesVPM,0) }}</b></td>
                    @if($totalper != 0)
                    <td align='center'><b>{{ number_format($total_diasi,0) }}</br><font color=blue size=2.0px>{{ ' ('.number_format(($total_diasi)/$totalper,1).' d/p)' }}</font></b></td> 
                    @else
                    <td align='center'><b>{{ number_format($total_diasi,0) }}</br><font color=blue size=2.0px>{{ ' ('.number_format(0,1).' d/p)' }}</font></b></td> 
                    @endif
                    <td align='center'><b>{{ number_format($retardosVPM,0) }}</b></td>
                    <td align='center'><b>{{ number_format($faltasinjustificadasVPM,0) }}</b></td>
                  </tr>
               
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
       <!-- <div class="row">
        <div class="col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="websiteViewsChart6"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Incidencias x Mes</h4>
              <p class="card-category">Vacaciones y Permisos</p>
            </div>-->
           <!-- <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>-->
         <!-- </div>
        </div>
          </div>-->
        <!-- <div class="row">
        <div class="col-md-12">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart7"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Incidencias x Mes</h4>
              <p class="card-category">Faltas Justificadas y Incapacidades</p>
            </div>-->
           <!-- <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>-->
        <!--  </div>
        </div>
      </div>
        </div>-->
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
    window.location.href="fechasVPM?inicial="+$('#fecha_inicial').val()+"&final="+$('#fecha_final').val();
    
    //        }

  });

 
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initdashboardPageCharts();
    });

    var dataWebsiteViewsChart6 = {
        labels: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        series: [
          [$('#departamentoV01').val(),$('#departamentoV02').val(),$('#departamentoV03').val(),$('#departamentoV04').val(),$('#departamentoV05').val(),$('#departamentoV06').val(),$('#departamentoV07').val(),$('#departamentoV08').val(),$('#departamentoV09').val(),$('#departamentoV10').val(),$('#departamentoV11').val(),$('#departamentoV12').val()], 
          [$('#departamentoP01').val(),$('#departamentoP02').val(),$('#departamentoP03').val(),$('#departamentoP04').val(),$('#departamentoP05').val(),$('#departamentoP06').val(),$('#departamentoP07').val(),$('#departamentoP08').val(),$('#departamentoP09').val(),$('#departamentoP10').val(),$('#departamentoP11').val(),$('#departamentoP12').val()]
        ]
      };
      var optionsWebsiteViewsChart6 = {
        axisX: {
          showGrid: true
        },
        
        low: 0,
        high: 100,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        },
   
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
          [$('#departamentoFJ01').val(),$('#departamentoFJ02').val(),$('#departamentoFJ03').val(),$('#departamentoFJ04').val(),$('#departamentoFJ05').val(),$('#departamentoFJ06').val(),$('#departamentoFJ07').val(),$('#departamentoFJ08').val(),$('#departamentoFJ09').val(),$('#departamentoFJ10').val(),$('#departamentoFJ11').val(),$('#departamentoFJ12').val()], 
          [$('#departamentoI01').val(),$('#departamentoI02').val(),$('#departamentoI03').val(),$('#departamentoI04').val(),$('#departamentoI05').val(),$('#departamentoI06').val(),$('#departamentoI07').val(),$('#departamentoI08').val(),$('#departamentoI09').val(),$('#departamentoI10').val(),$('#departamentoI11').val(),$('#departamentoI12').val()]
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