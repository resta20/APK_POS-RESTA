<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POS</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        @can('viewAny', App\Models\Produk::class)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/produk*') ? 'active' : '' }}" href="{{ route('admin.produk.index') }}">Produk</a>
        </li>
        @endcan

        @can('viewAny', App\Models\User::class)
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
        </li>
        @endcan

        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>

      </ul>

      <form action="{{ route('logout') }}" method="POST" class="d-flex">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>

    </div>
  </div>
</nav>