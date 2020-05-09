@extends('layouts.site')

@section('content')

    <section class="banner_inner" id="home">
        <div class="banner_inner_overlay">
        </div>
    </section>

    <section class="about py-5">
<div class="container py-lg-5 py-sm-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Восстановить пароль</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <p id="capsWarning" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердить пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <p id="capsWarning2" style="color: red; display: none;">Внимание! Caps lock включен.</p>
                            </div>
                        </div>

                        <script>

                            // Получить поле ввода
                                var input = document.getElementById("password");
                                var input2 = document.getElementById("password-confirm");
    
                                // Получить текст предупреждения
                                var text = document.getElementById("capsWarning");
                                var text2 = document.getElementById("capsWarning2");
    
                                // Когда пользователь нажимает любую клавишу на клавиатуре, запустите функцию
                                input.addEventListener("keyup", function(event) {
    
                                // Если "caps lock" нажат, отобразится текст предупреждения
                                if (event.getModifierState("CapsLock")) {
                                    text.style.display = "block";
                                    text2.style.display = "block";
                                } else {
                                    text.style.display = "none"
                                    text2.style.display = "none";
                                }
                                });

                                input2.addEventListener("keyup", function(event) {
    
                                // Если "caps lock" нажат, отобразится текст предупреждения
                                if (event.getModifierState("CapsLock")) {
                                    text.style.display = "block";
                                    text2.style.display = "block";
                                } else {
                                    text.style.display = "none"
                                    text2.style.display = "none";
                                }
                                });
                                
                        </script>

                        <div class="form-group row justify-content-center mb-0">
                            <button type="submit" style="font-size: 16px; margin: 0 15px" class="col-md-5  btn btn-primary">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>
@endsection
