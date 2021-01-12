<x-layout>
    <x-slot name="title">Login</x-slot>
    
    <div class="container-fluid category-header">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-sm-9 col-md-8 col-lg-6 pb-5">
                <div class="login card shadow-lg">
                    <div class="card-header"><img src="https://images.cooltext.com/5486903.png" alt="logo" class="img-fluid d-block mx-auto" width="200px"></div>
                    
                    <div class="card-body my-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control rounded-pill @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control rounded-pill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        
                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success text-white rounded-pill">
                                        {{ __('Accedi') }}
                                    </button>
                                    
                                    @if (Route::has('password.request'))
                                    <a class="text-dark font-weight-bold mt-2" href="{{ route('password.request') }}">
                                        {{ __('Hai dimenticato la password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row mt-4 justify-content-end">
                                <div class="col-md-8 offset-md-2">
                                    @if (Route::has('password.request'))
                                    
                                    <a class="text-dark font-weight-bold mb-2 text-decoration-none" href="">{{ __('oppure')}}</a>
                                    
                                    <a class="btn btn-orange btn-lg rounded-pill text-light text-decoration-none" href="{{ route('register') }}">
                                        {{ __('Registrati!') }}
                                    </a>
                                    
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
