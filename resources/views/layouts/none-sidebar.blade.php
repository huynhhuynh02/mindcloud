<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'mindCloud - Project manager software online') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/js/app.js')

</head>

<body>
    <div id="app">
        <nav class="navbar shadow navbar-expand navbar-dark bd-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    MindCloud
                </a>
                <div class="dropdown me-3">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Your work
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('workspace') }}">Go to Your Workspace</a></li>
                    </ul>
                </div>
                <div class="dropdown me-3">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Projects
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">View all projects</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createdProjectModal">Create
                                project</a></li>
                    </ul>
                </div>
                <div class="dropdown me-3">
                    <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        People
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#inviteUserModal">Invite
                                user</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createdTeamModal">Create
                                team</a></li>
                    </ul>
                </div>
                <button class="btn btn-primary btn-sm" type="submit">Create</button>
                <!-- <button type="button" class="btn btn-primary rounded-circle" width="40px" height="40px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </button> -->
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item me-2">
                            <form class="d-flex" role="search">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Search projects"
                                        aria-label="Search projects" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="nav-item me-2">
                            <a class="position-relative nav-link link-light" href="http://" target="_blank"
                                rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                                </svg>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    99+
                                </span>
                            </a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link link-light" href="http://" target="_blank" rel="noopener noreferrer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                @auth
                                    <a class="nav-link link-light d-flex align-items-center dropdown-toggle" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="#">{{ __('User profile') }}</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('organization-settings.index') }}">{{ __('Organization Settings') }}</a>
                                        </li>
                                        <li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <a class="dropdown-item" href="#" onclick="logout()">
                                                    {{ __('Logout') }}
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="wrapper">
            <div class="main">
                <main class="content">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @include('shared.project')
    @include('shared.team')
    @include('shared.task')
    @include('shared.invite')

    <script>
        const projectName = document.getElementById('projectNameInput');
        const projectKey = document.getElementById('projectKeyInput');
        projectName.addEventListener("keyup", function() {
            let text = projectName.value;
            let textnew = text.trim().toUpperCase().replace(/\s/g, '-');
            projectKey.value = textnew;
        });

        function logout() {
            document.getElementById('logout-form').submit();
        }

        function creatProject() {
            document.getElementById('project-form').submit();
        }

    </script>
    @if ($errors->any())
        <script type="module">
            const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        </script>
    @endif
</body>

</html>
