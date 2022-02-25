<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="/">POS Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('category') ? 'active' : '' }}" href="/category">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="/cart">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('money') ? 'active' : '' }}" href="/money">Money</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('member') ? 'active' : '' }}" href="/member">Member Service</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <li class="dropdown d-flex">
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown d-flex">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if (Auth::user()->is_admin === 1)
                    <li><a class="dropdown-item" href="/admin">Admin Page</a></li>
                    @endif
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item">Logout</button>
                    </form>
                </ul>
            </li>
        </div>
    </div>
</nav>
