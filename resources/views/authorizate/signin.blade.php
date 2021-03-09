@extends('layouts.master')

@section('content')

    <main>
        <div class="content container">
            <div class="content__item title">Вхід на сайт</div>
            <div class="content__row justify-content-center">
                <div class="sign-in">
                    <form class="form-login" action="{{ route('check') }}" method="POST">
                        @csrf

                        <div class="form-login__group">
                            <label class="form-login__label" for="loginForm-phone">Телефон</label>



                            <input placeholder="+380 (___) __-__-__"
                                class="form-login__input @error('phone') {{ 'invalid' }} @enderror "
                                id="loginForm-phone" name="phone" value="{{ old('phone') }}" type="text"
                                onkeyup="phoneCheck('loginForm-phone', '.form-login__error', 'form-login__button')"
                                onblur="phoneCheck('loginForm-phone', '.form-login__error', 'form-login__button')"
                                autocomplete="off">
                            <div class="form-login__error">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                                @if (Session::get('fail'))
                                    {{ Session::get('fail') }}
                                @endif
                            </div>
                        </div>
                        <div class="form-login__group">
                            <label class="form-login__label" for="loginForm-password">Пароль</label>

                            <input class="form-login__input @error('password') {{ 'invalid' }} @enderror"
                                id="loginForm-password" type="password" name="password"
                                onkeyup="passwordCheck('loginForm-password', '.form-login__error', 'form-login__button')"
                                onblur="passwordCheck('loginForm-password', '.form-login__error', 'form-login__button')">
                            <div class="form-login__error">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-login__group">
                            <button id="form-login__button" class="form-login__button" type="submit">Увійти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="{{ asset('js/jquery.maskedinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $("#loginForm-phone").mask("+380 (999) 99-99-99");
        });

    </script>
@endsection
