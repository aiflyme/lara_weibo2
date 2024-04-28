<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Weibo App</a>
        <ul class="navbar-nav justify-content-end">
            @if(Auth::check())
                <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">User list</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">User profile</a>
                        <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">Edit profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="logout" href="#">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-block btn-danger" type="submit">Logout</button>
                            </form>
                        </a>
                    </div>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('help') }}">帮助</a></li>
                <li class="nav-item" ><a class="nav-link" href="{{ route('login') }}">登录</a></li>
            @endif
        </ul>
    </div>
</nav>
