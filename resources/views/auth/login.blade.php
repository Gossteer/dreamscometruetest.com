@extends('layouts.site')

@section('content')

    <section class="banner_inner" id="home">
        <div class="banner_inner_overlay">
        </div>
    </section>

    <section class="about py-5">
<div class="container py-lg-5 py-sm-4">
    <div class="row justify-content-center">
        <div class="col-md-9">

            <div class="col-lg-12 contact-left-form" style="padding: 0em;">
                <div class="card-header" style="background-color: rgba(0, 0, 0, 0.08);     border-bottom: 1px solid rgba(0, 0, 0, 0);">Вход</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <h3 for="email" class="col-md-4 col-form-label text-md-right ">{{ __('E-Mail') }}</h3>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" minlength="2" maxlength="191" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <h3 for="password" class="col-md-4 col-form-label text-md-right">Пароль</h3>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" min="8" maxlength="16" required autocomplete="current-password">
                                <p id="capsWarning" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <script>

                            // Получить поле ввода
                                var input = document.getElementById("password");
    
                                // Получить текст предупреждения
                                var text = document.getElementById("capsWarning");
    
                                // Когда пользователь нажимает любую клавишу на клавиатуре, запустите функцию
                                input.addEventListener("keyup", function(event) {
    
                                // Если "caps lock" нажат, отобразится текст предупреждения
                                if (event.getModifierState("CapsLock")) {
                                    text.style.display = "block";
                                } else {
                                    text.style.display = "none"
                                }
                                });
                                
                        </script>

                        <div class="form-group row">
                            <h3 for="password" class="col-md-4 col-form-label text-md-right"></h3>

                            <div class="col-md-6">
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong class="text-danger" style="font-family: Raleway, sans-serif;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check" style="margin-left: 5%;">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label " for="remember">
                                       Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row ">
                            <h3 for="password" class="col-md-4 col-form-label text-md-right"></h3>
                            <div class="col-md-6">
                                <button type="submit" style="font-size: 15px" class="btn btn-primary">
                                    Войти
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " style="font-size: 16px" href="{{ route('password.request') }}">
                                        Забыли пароль?
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
    </section>
@endsection

@push('scripts')
    {!! NoCaptcha::renderJs() !!}
@endpush
