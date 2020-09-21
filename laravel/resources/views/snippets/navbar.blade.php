<nav class='nav'>
  <ul class='is-yellow-gradient'>
    <li><a class='button is-transparent' href="/home">Home</a></li>
    <li><a class='button is-transparent' href="/services">Services</a></li>
    <li><a class='button is-transparent' href="/lights">Lights</a></li>
    <li><a class='button is-transparent' href="/animations">Animations</a></li>
    <li><a class='button is-transparent' href="/api/tokens">Manage API Tokens</a></li>
    @if (Route::has('login'))
            @auth
                <li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button class='button is-transparent' type='submit'>Logout</button>
                  </form>
                </li>
            @else
                <li><a class='button is-transparent' href="{{ route('login') }}">Login</a></li>

                @if (Route::has('register'))
                    <li><a class='button is-transparent' href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
    @endif
  </ul>
</nav>
