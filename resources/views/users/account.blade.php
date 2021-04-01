@extends('layouts.master')
@section('general')
    Головна&nbsp /
@endsection

@section('name')
    Профіль
@endsection
@section('content')


            <div class="account">

                <div class="account__row">
                    @isset($dot)
                        <div class="account__section" style="display: display;">
                            <div class="account__setting">
                                <div class="account__setting-title">Налаштування акаунту</div>
                                <form class="account__form" action="{{ route('update_login') }}" method="POST">
                                    @foreach ($user as $us)
                                        <div class="account__row account_mb">
                                            <div class="account__title">Ім'я</div>
                                            <div class="account__group">
                                                <input id="account-name" class="account__input account__mw" type="text"
                                                    name="name" value="{{ $us->name }}"
                                                    onkeyup="nameCheck('account-name', '.account__error', 'account-submit')"
                                                    onblur="nameCheck('account-name', '.account__error', 'account-submit')"
                                                    autocomplete="off">
                                                <div class="account__text">
                                                    Ваше Ім'я
                                                </div>
                                                <div class="account__error"></div>
                                            </div>
                                        </div>
                                        <div class="account__row account_mb">
                                            <div class="account__title">Телефон для входу</div>
                                            <div class="account__group">
                                                <input class="account__input account__mw" id="account-phone" type="text"
                                                    value="{{ $us->phone }}" name="phone" placeholder="+380 (___) __-__-__"
                                                    onkeyup="phoneCheck('account-phone', '.account__error', 'account-submit')"
                                                    onblur="phoneCheck('account-phone', '.account__error', 'account-submit')"
                                                    autocomplete="off">
                                                <div class="account__text">
                                                    Цей номер потрібен тільки для входу і не відображається на сайті
                                                </div>
                                                <div class="account__error"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="account__row account_mb">
                                        <div class="account__title">Новий пароль</div>
                                        <div class="account__group">
                                            <input class="account__input" id="account-password" type="password" name="password"
                                                onkeyup="passwordCheck('account-password', '.account__error', 'account-submit')"
                                                onblur="passwordCheck('account__password', '.account__error', 'account-submit')">
                                            <div class="account__text">
                                                Залишіть поле порожнім якщо Ви не хочете його змінювати
                                            </div>
                                            <div class="account__error"></div>
                                        </div>
                                    </div>
                                    <div class="account__save">
                                        <button id="account-submit" type="submit"><i class="fa fa-floppy-o"
                                                aria-hidden="true"></i>Зберегти</button>
                                    </div>
                                    @csrf
                                </form>
                            </div>

                        </div>
                    @else
                        <div class="account__section">
                            <a class="account__button" href="{{ route('home') }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i>Почати новий
                                розрахунок</a>
                            <div class="account__list">
                                @isset($return)
                                    @foreach ($return as $item)
                                        <div class="account__column">
                                            <div class="account__item">
                                                <a class="account__delete" href="{{ route('delete_calc', $item->id) }}"
                                                    onclick="return confirm('Are you sure?');"><i class="fa fa-times"
                                                        aria-hidden="true"></i></a>
                                                <a class="account__calc" href="{{ route('home_show', $item->id) }}">
                                                    <i class="fa fa-file-o" aria-hidden="true"></i>
                                                    <div class="account__calc-name">{{ $item->name }}</div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach



                                @endisset


                                @if ($return->isEmpty())
                                    <div class="account__massage">Немає розрахунків</div>
                                @endif

                            </div>
                        </div>

                    @endisset
                    <div class="account__menu">
                        <div class="menu">
                            <a class="menu__item @isset($return)menu_active @endisset" href="{{route('profile')}}"><i class="fa fa-calculator"
                                    aria-hidden="true"></i>Калькулятор</a>
                            <a class="menu__item @isset($dot)menu_active @endisset" href="{{ route('settings') }}"><i
                                    class="fa fa-cog" aria-hidden="true"></i>Налаштування
                                акаунту</a>
                            <a class="menu__item" href="{{ route('logout') }}"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i>Вихід із
                                системи</a>
                        </div>
                    </div>
                </div>
            </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script src={{ asset('js/jquery.maskedinput.js') }} type="text/javascript"></script>
    <script src={{ asset('js/jquery.maskedinput.min.js') }} type="text/javascript"></script>
    <script>
        $(function() {
            $("#account-phone").mask("+380 (999) 99-99-99");
        });

    </script>
@endsection
