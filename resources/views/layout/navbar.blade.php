<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center fw-bold" href="/">
            <span class="text-white">Car</span><span class="text-secondary">Wash</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse menu-center justify-content-center" id="navbarContent">
            <ul class="navbar-nav ms-5">
                <li class="nav-item mx-2 fw-bold text-light">
                    <a class="nav-link nav-menu text-light fw-semibold active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item mx-2 fw-bold">
                    <a class="nav-link nav-menu text-light fw-semibold" href="/">Booking</a>
                </li>
            </ul>

            <div class="d-flex ms-auto">
                @auth
                <div class="dropdown d-flex align-items-center mb-3 ms-3 mb-lg-0 ms-lg-0">
                    <a class="btn fw-bold dropdown-toggle text-truncate text-center text-light d-inline-block"  href="#" role="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i>
                        {{ Auth::user()->nama }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('riwayat') }}">Riwayat Booking</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                @else
                <a class="btn button-navbar btn-outline-light me-2 fw-semibold" href="#" data-bs-toggle="modal"
                    data-bs-target="#loginModal">Member</a>
                @endauth
            </div>
        </div>

    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow-lg">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-3">
                <h3 class="fw-bold"><span class="text-dark">Car</span><span class="text-secondary">Wash</span></h3>
            </div>
            <div class="modal-body">
                <p class="text-start fw-semibold">Login Akun Member</p>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="emailLogin" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="emailLogin" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label for="passwordLogin" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="Enter password" required>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-dark fw-semibold text-light">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
