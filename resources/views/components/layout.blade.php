<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>
    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark vh-100" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Managerment</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-house"></i>
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->is('jobs*') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-backpack4"></i>
                        Jobs
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}" class="nav-link {{ request()->is('companies*') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-basket2"></i>
                        Companies
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('benefits.index') }}" class="nav-link {{ request()->is('benefits*') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-basket2"></i>
                        Benefits
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('notifications.index') }}" class="nav-link {{ request()->is('benefits*') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-basket2"></i>
                        Nofications
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>Chien</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
        <div class="b-example-divider b-example-vr"></div>
        <div class="d-flex flex-column p-3 bg-body-tertiary w-100">
            <div class="container-fluid">
                {{ $slot }}
            </div>
        </div>
    </main>

    <script src="{{ asset('js').'/app.js' }}"></script>
</body>

</html>