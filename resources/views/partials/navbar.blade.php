<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item ">
                <a class="nav-link {{ request()->path() === 'borrowed-books' ? 'active' : '' }}" href="/borrowed-books">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ request()->path() === 'books' ? 'active' : '' }}" href="/books">
                    <span data-feather="book-open"></span>
                    Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->path() === 'borrowers' ? 'active' : '' }}" href="/borrowers">
                    <span data-feather="users"></span>
                    Peminjam
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Integrations
                </a>
            </li>
        </ul>
    </div>
</nav>
