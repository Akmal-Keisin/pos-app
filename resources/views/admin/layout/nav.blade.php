<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="/admin">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin*') ? 'active' : '' }}" href="/admin">Product List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('member_admin*') ? 'active' : '' }}" href="/member_admin">Member Product List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('transaction*') ? 'active' : '' }}" href="/transaction">Transaction List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('report*') ? 'active' : '' }}" href="/report">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('restock*') ? 'active' : '' }}" href="/restock">Restock</a>
                </li>
            </ul>
            <div class="d-flex">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <li class="nav-item dropdown d-flex">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/home">Home</a></li>
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
    </div>
</nav>
