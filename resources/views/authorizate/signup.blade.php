@extends('layouts.master')

@section('content')

        <div class="content">
            <div class="content__item title">Реєстрація на сайт</div>
            <div class="content__row justify-content-center">
                <div class="sign-up">
                    <form class="form-reg" action="{{ route('create_user') }}" method="POST">
                        @csrf
                        @if (Session::get('fail'))
                            {{ Session::get('fail') }}
                        @endif
                        <div class="form-reg__group">
                            <label class="form-reg__label" for="regForm-name">Ваше ім'я</label>

                            <input class="form-reg__input" id="regForm-name" type="text" name="name"
                                onkeyup="nameCheck('regForm-name', '.form-reg__error', 'form-reg__button')"
                                onblur="nameCheck('regForm-name', '.form-reg__error', 'form-reg__button')"
                                autocomplete="off">
                            <div class="form-reg__error">@error('name')
                                    {{ $message }}
                                @enderror</div>
                        </div>
                        <div class="form-reg__group">
                            <label class="form-reg__label" for="regForm-phone">Телефон для входу</label>

                            <input placeholder="+380 (___) __-__-__" class="form-reg__input" id="regForm-phone" type="text"
                                name="phone" onkeyup="phoneCheck('regForm-phone', '.form-reg__error', 'form-reg__button')"
                                onblur="phoneCheck('regForm-phone', '.form-reg__error', 'form-reg__button')"
                                autocomplete="off">
                            <div class="form-reg__error">@error('phone')
                                    {{ $message }}
                                @enderror</div>
                        </div>
                        <div class="form-reg__group">
                            <label class="form-reg__label" for="regForm-password">Пароль</label>

                            <input class="form-reg__input" id="regForm-password" type="password" name="password"
                                onkeyup="passwordCheck('regForm-password', '.form-reg__error', 'form-reg__button')"
                                onblur="passwordCheck('regForm-password', '.form-reg__error', 'form-reg__button')">
                            <div class="form-reg__error">@error('password')
                                    {{ $message }}
                                @enderror</div>
                        </div>
                        <div class="form-reg__group">
                            <label class="form-reg__label" for="regForm-password">Повторення паролю</label>
                            <input class="form-reg__input" id="regForm-password-check" type="password"
                                onkeyup="passwordCheck('regForm-password-check', '.form-reg__error', 'form-reg__button')"
                                onblur="passwordCheck('regForm-password-check', '.form-reg__error', 'form-reg__button')">
                            <div class="form-reg__error"></div>
                        </div>
                        <div class="form-reg__group">
                            <button id="form-reg__button" class="form-reg__button" type="submit">Зареєструватись</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <script>
        $(function() {
            $("#regForm-phone").mask("+380 (999) 99-99-99");
        });

    </script>
@endsection
