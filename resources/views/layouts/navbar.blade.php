<style>
    @import url('https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap');

    .board-nav {
        background: #f5f1e8;
        border-bottom: 1px solid #e6dccb;
        font-family: 'Work Sans', sans-serif;
        padding: 14px 0;
    }

    .board-nav .navbar-brand {
    font-weight: 700;
    font-size: 1.25rem;
    letter-spacing: -0.2px;
    color: #4a3728 !important;
}

.board-nav .nav-link {
    font-size: 1rem;
    font-weight: 500;
    color: #a68a72 !important;
    padding: 8px 16px !important;
    transition: color 0.15s ease;
}

    .board-nav .nav-link:hover {
        color: #4a3728 !important;
    }

    .board-nav .nav-link.active {
        color: #4a3728 !important;
        position: relative;
    }

    .board-nav .nav-link.active::after {
        content: "";
        position: absolute;
        left: 14px;
        right: 14px;
        bottom: -2px;
        height: 2px;
        background: #a67c52;
    }

    .board-nav .btn-danger {
        background: transparent;
        border: 1px solid #e6dccb;
        color: #4a3728;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 6px 16px;
    }

    .board-nav .btn-danger:hover {
        background: #a67c52;
        border-color: #a67c52;
        color: #fffdf9;
    }
</style>

<nav class="navbar navbar-expand-lg board-nav">
    <div class="container-fluid" style="max-width: 900px; margin: 0 auto;">
        <a class="navbar-brand" href="#">POS RESTA DWI LESTARI</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard') }}">Dashboard</a>
                </li>

                @can('viewAny', App\Models\Produk::class)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('produk*') ? 'active' : '' }}"
                            href="{{ route('produk.index') }}">Produk</a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">Users</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan*') ? 'active' : '' }}"
                        href="{{ route('penjualan.index') }}">Penjualan</a>
                </li>

            </ul>

            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

        </div>
    </div>
</nav>