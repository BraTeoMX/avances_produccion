<div class="sidebar" data-color="brown" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal"> <img class="navbar-brand-logo-mini" src="{!! asset('/material/img/logo.png') !!}" alt="Logo" width='80%'>
    </a>
  </div>
  <div class="sidebar-wrapper" >
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'avanceproduccion' ? ' active' : '' }}"  >
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons" >avanceproduccion</i>
            <p >{{ __('Avance Diario') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample2" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Planeación') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse hide" id="laravelExample2">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vpf.index') }}">
                <span class="sidebar-mini">  </span>
                <span class="sidebar-normal">{{ __('Actualización') }} </span>
              </a>
            </li>

            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vpf.altasybajasTLyM') }}">
                <span class="sidebar-mini">  </span>
                <span class="sidebar-normal">Altas y bajas </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vpf.modificacionTablaTLyM') }}">
                <span class="sidebar-mini">  </span>
                <span class="sidebar-normal"> Modificacion TL y M </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('vpf.tablaTLyM') }}">
                <span class="sidebar-mini">  </span>
                <span class="sidebar-normal">Tabla TL y M </span>
              </a>
            </li>
          </ul>
        </div>    
      </li>

      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('prueba.sorteo') }}">
          <span class="sidebar-mini">  </span>
          <span class="sidebar-normal">Sorteo </span>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('prueba.resultadoSorteo') }}">
          <span class="sidebar-mini">  </span>
          <span class="sidebar-normal">Resultado Sorteo </span>
        </a>
      </li>
    </ul>
  </div>
</div>
