<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Tienda de videojuegos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Videojuegos <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('categoria*') ? 'active' : '' }}"href="{{ route('getcategorias') }}">Categorías</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('desarrolladora*') ? 'active' : '' }}"href="{{ route('getdesarrolladoras') }}">Desarrolladoras</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Plataformas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('cliente*') ? 'active' : '' }}"href="{{ route('getclientes') }}">Clientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Inventario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Metodos de pago</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Ventas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reseñas</a>
      </li>
    </ul>
  </div>
</nav>