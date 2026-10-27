<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Tienda</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('videojuego*') ? 'active' : '' }}"href="{{ route('getvideojuegos') }}">Videojuegos</a>
      </li>

      {{-- Catálogos aparte --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->is('categoria*', 'desarrolladora*', 'plataforma*') ? 'active' : '' }}"
           href="#" id="ddCatalogos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catálogos
        </a>
        <div class="dropdown-menu" aria-labelledby="ddCatalogos">
          <a class="dropdown-item {{ request()->is('categoria*') ? 'active' : '' }}" href="{{ route('getcategorias') }}">Categorías</a>
          <a class="dropdown-item {{ request()->is('desarrolladora*') ? 'active' : '' }}" href="{{ route('getdesarrolladoras') }}">Desarrolladoras</a>
          <a class="dropdown-item {{ request()->is('plataforma*') ? 'active' : '' }}" href="{{ route('getplataformas') }}">Plataformas</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('inventario*') ? 'active' : '' }}"href="{{ route('getinventario') }}">Inventario</a>
      </li>

      {{-- Ventas --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->is('venta*', 'detalle-venta*') ? 'active' : '' }}"
           href="#" id="ddVentas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ventas
        </a>
        <div class="dropdown-menu" aria-labelledby="ddVentas">
          <a class="dropdown-item {{ request()->is('venta*') ? 'active' : '' }}" href="{{ route('getventas') }}">Ventas</a>
          <a class="dropdown-item {{ request()->is('detalle-venta*') ? 'active' : '' }}" href="{{ route('getdetallesventa') }}">Detalle de venta</a>
          <a class="dropdown-item {{ request()->is('metodo-pago*') ? 'active' : '' }}" href="{{ route('getmetodospago') }}">Metodos de pago</a>
        </div>
      </li>

      {{-- Personas --}}
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle {{ request()->is('cliente*', 'usuario*', 'rol*') ? 'active' : '' }}"
           href="#" id="ddPersonas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Personas
        </a>
        <div class="dropdown-menu" aria-labelledby="ddPersonas">
          <a class="dropdown-item {{ request()->is('cliente*') ? 'active' : '' }}" href="{{ route('getclientes') }}">Clientes</a>
          <a class="dropdown-item disabled" href="{{ route('getusuarios') }}">Usuarios</a>
          <a class="dropdown-item disabled" href="{{ route('getroles') }}">Roles</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled {{ request()->is('resena*') ? 'active' : '' }}"
           href="{{ route('getresenas') }}">Reseñas</a>
      </li>

    </ul>
  </div>
</nav>