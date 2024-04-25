<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">-|CareerVibe|-</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}" aria-current="page" href="{{route('index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('findJob') ? 'active' : '' }}" aria-current="page" href="{{route('findJob')}}">Find Jobs</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('job') ? 'active' : '' }}" aria-current="page" href="{{'job'}}">Post Jobs</a>
                    </li>
                    @endauth
                    
                </ul>


                @auth
                    <!-- User is logged in, display user's name -->
                    <span class="navbar-text me-2">
                        <a class="btn btn-outline-primary me-2" href="{{ route('profile') }}" type="submit"> {{ Auth::user()->name }}</a>
                    </span>
                   
                @else
                    <!-- User is not logged in, display login and post job buttons -->
                    <a class="btn btn-outline-primary me-2" href="{{ route('login') }}" type="submit">Login</a>
                    
                @endauth
            </div>
        </div>
    </nav>
</header>
