
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" 
             aria-current="page" 
             href="{{ route('index') }}">
            Evaluaciones
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('candidatos') ? 'active' : '' }}"
             href="{{ route('candidatos.index') }}">
            Clientes
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>