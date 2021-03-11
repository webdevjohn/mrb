<section id="app-bar"> 
    <div class="wrapper">
        <div id="logo-con">
            <a href="{{ route('homepage') }}" id="logo">MyRecordBox</a>                
        </div>
 
        <section id="main-nav">
            <nav>
                <ul>
                    <li><a href="{{ route('artists.index') }}">Artists</a></li>  
                    <li><a href="{{ route('genres.index') }}">Genres</a></li>  
                    <li><a href="{{ route('labels.index') }}">Labels</a></li>     
                    <li><a href="{{ route('albums.index') }}">Albums</a></li>     
                    <li><a href="{{ route('playlists.index') }}">Playlists</a></li>    
                    {{-- <li><a href="{{ route('track-search') }}">Track Search</a></li>     --}}
                    @if (Auth::check())
                    <li>            
                        <a href="{{ route('dashboard') }}">Your Dashboard</a>                      
                    </li>
                    @endif   
                </ul>               
            </nav>             
        </section>

        {{-- <section id="auth-links">
            <ul>
                @if (Auth::check())         
                <li>            
                    <form role="form" method="POST" action="{{ route('logout') }}" class="logout-form">
                    {{ csrf_field() }}
                        <button type="submit">
                            logout: <strong>{{ Auth::user()->name }}</strong>
                        </button>
                    </form>
                </li>
                @else
                    <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn-signup">Sign Up</a></li>
                @endif
            </ul>
        </section> --}}

    </div>
    <br class="clear" />
</section>

