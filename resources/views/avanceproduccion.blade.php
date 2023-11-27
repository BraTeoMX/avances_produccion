@extends('layouts.app', ['activePage' => 'avanceproduccion', 'titlePage' => __('avanceproduccion')])

@section('content')
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
  <div class="content">
  
    <div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
               
                <i class="card-tittle"></i>
                <font size=2+><p>{{ __('Avance Diario')  }}</p></font>
              </div>
              <p class="card-category"></br>
              <h3 class="card-title"><b><font size=6+>{{ $dia.'  ' }}</br>{{'  '.$hora }}</font></b>
                <small></small>
              </h3>
            </div>
            <div class="card-footer" style="align:center">        
                <p class="stats"><span class="text-info"> Eficiencia </br> Meta :</span><b>  {{ $eficiencia_dia.' %' }}</b></p> 
                <p class="stats"><span class="text-info"> Eficiencia </br> Real :</span><b>  {{ '0'.' %' }}</b></p> 

            </div>
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-info"> Piezas </br> Meta : </span><b>  {{ number_format( $cantidad_dia,2) }}</b></p>    
                <p class="stats"><span class="text-info"> Piezas </br> Reales :</span><b>  {{ number_format( 0,0) }}</b></p>
                <p class="stats"><span class="text-info"> Piezas </br> Diferencia :</span><b>  {{ number_format(($cantidad_dia-12345),2) }}</b></p>
            </div>   
               
          <!--
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
               
                <i class="card-tittle"></i>

                <font size=2+><p>{{ __('Avance Acumulado') }}</p></font>
              </div>
              <p class="card-category"></br>
              <h3 class="card-title"><b><font size=6+>{{ $dia.'  ' }}</br>{{'  '.$hora }}</font></b>
                <small></small>
              </h3>
            </div>
    
            <div class="card-footer" style="align:center">    
              <p class="stats"><span class="text-info"> Eficiencia </br> Meta :</span><b>  {{  $meta->eficiencia_total.' %' }}</b></p> 
              <p class="stats"><span class="text-info"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p> 
            </div>   
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-info"> Piezas </br> Meta : </span><b>  {{ number_format( $meta->cantidad_total,2) }}</b></p>    
                <p class="stats"><span class="text-info"> Piezas </br> Reales :</span><b>  {{ number_format(10810,0) }}</b></p>
                <p class="stats"><span class="text-info"> Piezas </br> Diferencia :</span><b>  {{ number_format(10681,0) }}</b></p>

            </div>   
          <!--
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('Planta I ') }}</p><p>{{ __('Avance Diario ') }}</p>
              </div>
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('100 %') }}</b>
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-success"> Piezas </br> Meta : </span><b>  {{ number_format(23880,0) }}</b></p>    
                <p class="stats"><span class="text-success"> Piezas </br> Reales :</span><b>  {{ number_format(10810,0) }}</b></p> 
                <p class="stats"><span class="text-success"> Piezas </br> Diferencia :</span><b>  {{ number_format(10810,0) }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">      
              <p class="stats"><span class="text-info"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
              <p class="stats"><span class="text-info"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p>             </div>    
          <!--
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>
 
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('Planta II ') }}</p><p>{{ __('Avance Diario ') }}</p>
              </div>
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('100 %') }}</b>
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-warning"> Piezas </br> Meta : </span><b>  {{ number_format(23880,0) }}</b></p>    
                <p class="stats"><span class="text-warning"> Piezas </br> Reales :</span><b>  {{ number_format(10810,0) }}</b></p>
                <p class="stats"><span class="text-warning"> Piezas </br> Diferencia :</span><b>  {{ number_format(10810,0) }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">   
            <p class="stats"><span class="text-info"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
              <p class="stats"><span class="text-info"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p>             </div>   
          <!--
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>-->
          </div>
        </div>        
      </div>
       
  
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <label for="join"
            class="col-md-4 col-form-label text-md-end">{{ __('Fecha Inicial') }}</label>
            <div class="col-md-6" >
              <input type="date" class="form-control" name="fecha_inicial" id="fecha_inicial" max ="2023-08-08" min ="2023-08-08" value={{ $inicio }} >
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
        <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <!-- <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('V.S.') }}</p>
              </div>-->
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('V.S.') }}</b></br>{{ __('100%') }}
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-success"> Piezas Meta : </span><b>  {{ 23880 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Real :</span><b>  {{ 106810 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Diferencia :</span><b>  {{ 68531 }}</b></p>
            </div>  
            <div class="card-footer" style="align:center">   
            <p class="stats"><span class="text-success"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
            </div>  
            <div class="card-footer" style="align:center">   
              <p class="stats"><span class="text-success"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p> 
            </div>
                    
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <!-- <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('V.S.') }}</p>
              </div>-->
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('CHICO´S') }}</b></br>{{ __('100%') }}
                
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-success"> Piezas Meta : </span><b>  {{ 3965 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Real :</span><b>  {{ 68531 }}</b></p>
            </div>  
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Diferencia :</span><b>  {{ 68531 }}</b></p>
            </div>  
            <div class="card-footer" style="align:center">   
            <p class="stats"><span class="text-success"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
            </div>  
            <div class="card-footer" style="align:center">   
              <p class="stats"><span class="text-success"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p> 
            </div>
           
          
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <!-- <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('V.S.') }}</p>
              </div>-->
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('BN3TH') }}</b></br>{{ __('100%') }}
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-success"> Piezas Meta : </span><b>  {{ 688 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Real :</span><b>  {{ 11113 }}</b></p>
            </div> 
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Diferencia :</span><b>  {{ 11113 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">   
            <p class="stats"><span class="text-success"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
            </div>  
            <div class="card-footer" style="align:center">   
              <p class="stats"><span class="text-success"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p> 
            </div>
         
          
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-3 col-sm-3">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
            <!-- <div class="card-icon">
               
                <i class="card-tittle"></i>
                <p>{{ __('V.S.') }}</p>
              </div>-->
              <p class="card-category"></br>
              <h3 class="card-title"><b>{{ __('NUDS') }}</b></br>{{ __('100%') }}
                <small></small>
              </h3>
            </div>
      
            <div class="card-footer" style="align:center">
                <p class="stats"><span class="text-success"> Piezas Meta : </span><b>  {{ 648 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Reales :</span><b>  {{ 16670 }}</b></p>
            </div>   
            <div class="card-footer" style="align:center">    
                <p class="stats"><span class="text-success"> Piezas Diferencia :</span><b>  {{ 68531 }}</b></p>
            </div>  
            <div class="card-footer" style="align:center">   
            <p class="stats"><span class="text-success"> Eficiencia </br> Meta :</span><b>  {{ '12:00' }}</b></p> 
            </div>  
            <div class="card-footer" style="align:center">   
              <p class="stats"><span class="text-success"> Eficiencia </br> Real :</span><b>  {{ '12:00' }}</b></p> 
            </div>
          
           <div class="card-footer">
              <div class="stats">
                <i class="material-icons ">date_range</i>
                <a href="{{ route('excepciones') }}">Detalle...</a>
              </div>
            </div>
          </div>
        </div>
      </div>
     
     <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-info">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Reportes:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                      <a class="nav-link" href="#profile" data-toggle="tab">
                        <i class="material-icons">cloud</i> Team Leader
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#messages" data-toggle="tab">
                        <i class="material-icons">code</i> Modulos
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#settings" data-toggle="tab">
                        <i class="material-icons">bug_report</i> Avance
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
           
            <div class="card-body  table-responsive">
              <div class="tab-content">
              <div class="tab-pane" id="profile">
                  <table class="table">
                  <div class="card-body table-responsive">
                      <table class="table table-hover">
                        <thead class="text-primary">
                          <th>Team Leader</th>
                            <th style="text-align: center">Piezas Meta</th>
                            <th style="text-align: center">Min Presencia</th>
                            <th style="text-align: center">Min x Producir</th>
                            <th style="text-align: center">Min Presencia Netos</th>
                            <th style="text-align: center">Total</th>
                        </thead>
                    <tbody>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>ALEJANDRA</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>AMBAR</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>ANGELA</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>ARACELI</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>DOMINGO</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>ELIAS</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>ELVIA</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>FRANCISCO</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>FAUSTINO</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>GUADALUPE</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>HEIDI</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>J. CARLOS</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>LORENA</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>NOE</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>RAYMUNDO</td>
                      <!--  <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                  <!--    <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>-->
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane active" id="settings">
                  <table class="table">

                      <thead>
                       
                        <th style="text-align: center" class="text-primary">Team Leader</th>
                        <th class="text-primary">Area</th>
                        <th style="text-align: center" class="text-primary">Modulo</th>
                        <th style="text-align: center" class="text-primary">Estilo</th>
                        <th style="text-align: center" class="text-primary">Piezas Meta</th>
                        <th style="text-align: center" class="text-primary">Eficiencia</th>
                        <th style="text-align: center" class="text-success">Meta 10:00</th>
                        <th style="text-align: center" class="text-success">Piezas</th>
                        <th style="text-align: center" class="text-success">Efic</br>(%)</th>
                        <th style="text-align: center" class="text-success">Minutos </br>(Producidos)</th>
                        <th style="text-align: center" class="text-success">Proyeccion</br>(Minutos)</th>
                        <th style="text-align: center" class="text-info">Meta 11:00</th>
                        <th style="text-align: center" class="text-info">Piezas</th>
                        <th style="text-align: center" class="text-info">Efic</br>(%)</th>
                        <th style="text-align: center" class="text-info">Minutos </br>(Producidos)</th>
                        <th style="text-align: center" class="text-info">Proyeccion</br>(Minutos)</th>
                        <th style="text-align: center" class="text-warning">Meta 12:00</th>
                        <th style="text-align: center" class="text-warning">Piezas</th>
                        <th style="text-align: center" class="text-warning">Efic</br>(%)</th>
                        <th style="text-align: center" class="text-warning">Minutos </br>(Producidos)</th>
                        <th style="text-align: center" class="text-warning">Proyeccion</br>(Minutos)</th>
                      </thead>
                      

                        <tbody>
                       
                          <tr >
                            
                            <td class="text-primary">Alejandra</td>
                            <td class="text-primary">V.S.</td>
                            <td class="text-primary">125A</td>
                            <td class="text-primary">11173458</td>
                            <td class="text-primary">9291</td>
                            <td class="text-primary">100%</td>
                            <td class="text-success">1770</td>
                            <td class="text-success">996</td>
                            <td class="text-success">55%</td>
                            <td class="text-success">257</td>
                            <td class="text-success">1348</td>
                            <td class="text-info">2655</td>
                            <td class="text-info">1526</td>
                            <td class="text-info">57%</td>
                            <td class="text-info">406</td>
                            <td class="text-info">1420</td>
                          </tr> 
                          <tr>
                            <td class="text-primary">CH</td>
                            <td class="text-primary">Elias</td>
                            <td class="text-primary">101A</td>
                            <td class="text-primary">070-23C113980</td>
                            <td class="text-primary">361</td>
                            <td class="text-primary">100%</td>
                            <td class="text-success">69</td>
                            <td class="text-success">56</td>
                            <td class="text-success">37%</td>
                            <td class="text-success"> 1307</td>
                            <td class="text-success">6860</td>
                            <td class="text-info">103</td>
                            <td class="text-info">86</td>
                            <td class="text-info">38%</td>
                            <td class="text-info">2007</td>
                            <td class="text-info">7023</td>
                          </tr>  
                            <!--<td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Intimark I</td>-->
                          <!-- <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>-->
                          </tr>
                          <tr>
                            <!--<td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Intimark II</td>-->
                          <!-- <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>-->
                          </tr>
                        <!-- <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="" checked>
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
                            <td>Create 4 Invisible User Experiences you Never Knew About</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                <i class="material-icons">edit</i>
                              </button>
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                <i class="material-icons">close</i>
                              </button>
                            </td>
                          </tr>-->
                        </tbody>
                    </table>
                  </div>
               
                <div class="tab-pane" id="messages">
                  <table class="table">
                    <div class="card-body table-responsive">
                      <table class="table table-hover">
                        <thead class="text-primary">
                          <th>Modulos</th>
                            <th style="text-align: center">Piezas Meta</th>
                            <th style="text-align: center">Min Presencia</th>
                            <th style="text-align: center">Min x Producir</th>
                            <th style="text-align: center">Min Presencia Netos</th>
                            <th style="text-align: center">Total</th>
                        </thead>
                    <tbody>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>101A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>103A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>104A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>105A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>107A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>110A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>111A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>112A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>113A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>114A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>115A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>118A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>120A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>121A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>122A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>123A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>124A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>125A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>127A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>128A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>130A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>131A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>133A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>135A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>138A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>139A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>140A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>143A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>147A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>148A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>150A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>152A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>162A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>164A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>167A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>168A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>172A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>199A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                      <tr>
                       <!-- <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" checked>
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>-->
                        <td>830A
                        </td>
                        <!--<td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                     
                     <!-- <tr>
                        <td>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="">
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                        </td>
                        <td>Sign contract for "What are conference organizers afraid of?"</td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>-->
                    </tbody>
                  </table>
                </div>
               
              </div>
            </div>
          </div>
        </div>
      
@endsection


