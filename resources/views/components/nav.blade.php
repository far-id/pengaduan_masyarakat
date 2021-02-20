<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container-fluid">
    <div class="navbar-wrapper">
        <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
        </button>
        </div>
        <a class="navbar-brand" href="#pablo">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                @auth
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>
                            @php
                                $user = Auth::user()->id;
                                if ( Auth::user()->level == 'masyarakat' ) {
                                    $name = DB::table('masyarakats')->where('user_id', $user)->get();
                                }else{
                                    $name = DB::table('petugas')->where('user_id', $user)->get();
                                }
                            @endphp
                            <span class="d-lg-none d-md-block">
                                @foreach ($name as $n)
                                    {{ $n->nama }}
                                @endforeach
                            </span>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endauth
                
            </li>
        </ul>
    </div>
    </div>
</nav>