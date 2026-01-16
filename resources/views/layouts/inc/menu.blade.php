@auth
<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a class="nav-link @if(\Illuminate\Support\Facades\Route::is('home')) active @endif" aria-current="page" href="/">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(\Illuminate\Support\Facades\Route::is('users.index')) active @endif" aria-current="page" href="{{route('users.index')}}">Users</a>
    </li>
    <li>
        <a class="nav-link @if(\Illuminate\Support\Facades\Route::is('tasks.index')) active @endif" aria-current="page" href="{{route('tasks.index')}}">Tasks</a>
    </li>
</ul>
@endauth
