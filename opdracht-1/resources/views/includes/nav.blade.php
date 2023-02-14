<nav id="nav">
    <ul>
        <li><a href="{{ route('home') }}" class="{{ Route::CurrentRouteName() == 'home' ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('about') }}" class="{{ Route::CurrentRouteName() == 'about' ? 'active' : '' }}">About</a>
        </li>
        <li><a href="{{ route('get-started') }}"
                class="{{ Route::CurrentRouteName() == 'get-started' ? 'active' : '' }}">Get
                Started</a></li>
        <li><a href="{{ route('contact') }}"
                class="{{ Route::CurrentRouteName() == 'contact' ? 'active' : '' }}">Contact</a>
        </li>
    </ul>
</nav>
