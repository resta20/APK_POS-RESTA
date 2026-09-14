<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700&display=swap');

    .board-nav {
        background: #fdf8f0;
        border-bottom: 3px solid #b98a8f;
        border-image: linear-gradient(90deg, #b98a8f 0%, #d3a86b 50%, #93a884 100%) 1;
        font-family: 'Nunito', sans-serif;
        padding: 14px 0;
    }

    .board-nav .navbar-brand {
        font-family: 'Fredoka', sans-serif;
        font-weight: 700;
        font-size: 1.7rem;
        letter-spacing: -0.3px;
        color: #4a3f35 !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .board-nav .navbar-brand .brand-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #b98a8f;
        font-size: 1.1rem;
    }

    .board-nav .nav-link {
        font-size: 1rem;
        font-weight: 600;
        color: #8a7d72 !important;
        padding: 8px 4px !important;
        margin: 0 12px;
        border-radius: 0;
        border-bottom: 2px solid transparent;
        transition: color 0.15s ease, border-color 0.15s ease;
    }

    .board-nav .nav-link:hover {
        color: #4a3f35 !important;
        border-bottom-color: #e5dcd3;
    }

    .board-nav .nav-link.active {
        color: #4a3f35 !important;
        background-color: transparent;
        border-bottom-color: #b98a8f;
    }

    .board-nav .btn-danger {
        background: transparent;
        border: 1.5px solid #b98a8f;
        color: #4a3f35;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 6px 18px;
    }

    .board-nav .btn-danger:hover {
        background: #b98a8f;
        border-color: #b98a8f;
        color: #fdf8f0;
    }
</style>

<nav class="navbar navbar-expand-lg board-nav">
    <div class="container-fluid" style="max-width: 900px; margin: 0 auto;">
        <a class="navbar-brand" href="#">restathrift</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                @if(Auth::user()->role->name === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                            href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                @endif

                @if(Auth::user()->role->name === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('jenis*') ? 'active' : '' }}"
                            href="{{ route('jenis.index') }}">Jenis Produk</a>
                    </li>
                @endif

                @can('viewAny', App\Models\Produk::class)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}"
                            href="{{ route('produk.index') }}">Produk</a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}"
                        href="{{ route('penjualan.index') }}">Penjualan</a>
                </li>
        <li class="nav-item">
    <a class="nav-link" href="{{ route('about') }}">Tentang</a>
     </li>

            </ul>

            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

        </div>
    </div>
</nav>