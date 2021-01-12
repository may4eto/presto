<nav id="navbar" class="navbar navbar-expand-lg fixed-top">
    <a class="navbar-brand" href="{{route('home')}}"><img src="https://images.cooltext.com/5486903.png" alt="" class="img-fluid rounded" width="150px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i id="toggler" class="fas fa-bars text-dark"></i></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-dark" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ __('ui.categories')}}
                </a>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach($categories as $category)
                    
                    <a class="dropdown-item" href="{{route('categories.index', compact('category'))}}">
                        {{$category->name}}
                    </a>
                    
                    @endforeach
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('posts.create')}}">{{ __('ui.add_announcement')}}</a>
            </li>
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('ui.login')}}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @if(Auth::user()->is_admin)
                    <a class="dropdown-item" href="{{route('admin.profile')}}">{{ __('ui.your_profile')}}</a>
                    @else
                    <a class="dropdown-item" href="{{route('user.profile')}}">{{ __('ui.your_profile')}}</a>
                    @endif
                    
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('ui.logout')}}
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @if(Auth::user()->is_revisor)
        <li class="nav-item">
            <a href="{{route('revisor.index')}}" class="nav-link"> {{ __('ui.revisor')}}<strong>({{\App\Models\Post::toBeRevisionedCount()}})</strong></a>
        </li>
        @endif
        @endguest

        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ __('ui.language')}}
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
               
                
                <a class="dropdown-item" href="">
                    <form action="{{route('locale', 'it')}}" method="POST">
                        @csrf
                        <button class="nav-link text-dark btn-locale" type="submit">
                            <span class="flag-icon flag-icon-it mr-2"></span>
                            <span>{{ __('ui.italian')}}</span>
                        </button>
                    </form>
                </a>
                <a class="dropdown-item" href="">
                    <form action="{{route('locale', 'en')}}" method="POST">
                        @csrf
                        <button class="nav-link text-dark btn-locale" type="submit">
                            <span class="flag-icon flag-icon-gb mr-2"></span>
                            <span>{{ __('ui.english')}}</span>
                        </button>
                    </form>
                </a>
                <a class="dropdown-item" href="">
                    <form action="{{route('locale', 'es')}}" method="POST">
                        @csrf
                        <button class="nav-link text-dark btn-locale" type="submit">
                            <span class="flag-icon flag-icon-es mr-2"></span>
                            <span>{{ __('ui.spanish')}}</span>
                        </button>
                    </form>
                </a>
    </ul>
    <form class="form-inline my-2 my-lg-0" method='GET' action="{{route('posts.search')}}">
        <input class="form-control mr-sm-2 rounded-pill d-none d-md-block" name='q' type="search" placeholder="{{ __('ui.search')}}" aria-label="Search">
        <button class="btn btn-orange rounded-pill my-2 my-sm-0 px-4 d-none d-md-block" type="submit"><i class="fas fa-search text-white text-center"></i></button>
    </form>
    <button class="bg-transparent border-0 p-0" data-toggle="modal" data-target="#search"><i class="fas fa-search text-dark d-block d-md-none"></i></button>  
</div>
</nav>