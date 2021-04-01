<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('stylesheets/public.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheets/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesheets/accordions.css') }}">
    <title>Cucumbers</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="nav container">
                <!-- nav img -->
                <div class="nav__img">
                    <img src="{{ asset('images/cucumbers.jpg') }}" alt="">
                    <a href="{{ route('general') }}"></a>
                </div>
                <!-- nav column -->
                <ul class="nav__column">


                    @if (!session()->has('LoggedUser') && !session()->has('LoggedAdmin'))
                        <li><a class="nav__link" href="{{ route('register') }}"><i class="fa fa-user-plus"
                                    aria-hidden="true"></i>
                                Зареєструватись</a></li>
                        <li><a class="nav__link" href="{{ route('login') }}"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i> Увійти</a></li>
                    @endif

                    @if (session()->has('LoggedAdmin'))
                        <li><a class="nav__link" href="{{ route('admin') }}"><i class="fa fa-user"
                                    aria-hidden="true"></i> Панель андміністратора</a></li>
                        <li><a class="nav__link" href="{{ route('logout') }}"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i> Вийти</a></li>

                    @endif

                    @if (session()->has('LoggedUser'))
                        <li><a class="nav__link" href="{{ route('profile') }}"><i class="fa fa-user"
                                    aria-hidden="true"></i> Профіль</a></li>
                        <!--<li><a class="nav__link" href="{{ route('logout') }}"><i class="fa fa-sign-in"
                                    aria-hidden="true"></i> Вийти</a></li>-->

                    @endif

                </ul>

            </nav>
            <!-- nav-history -->

        </header>
        <main>


        <div class="container">
            <ul class="content__item nav-history">
                <li class="nav-history__item"><a href="{{route('general')}}">@yield('general')</a></li>
                <li class="nav-history__item ">&nbsp @yield('name')</li>
            </ul>


        @yield('content')

        @section('footer')

        @endsection
        </div>
        </main>
        <footer>
            <div class="copyright container">Copyright <?= date('Y') ?>, Cucumbers Calculator</div>
</footer>
</div>
<script>
    window.onload = load;

    document.querySelectorAll('.price').forEach((element) => [
        element.oninput = load
    ]);

    document.querySelectorAll('.count').forEach((element) => [
        element.oninput = load
    ]);

    function load() {
        document.querySelectorAll('.price').forEach((element) => [
            calculation(element)
        ]);
    }

    function calculation(obj) {
        calcPriceResult(obj.parentElement.parentElement);
        calcPriceTotal(obj.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement);
        calcParentTotal(obj.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement);
    }

    function calcPriceResult(object) {
        let result = Number(object.querySelector('.price').value) * Number(object.querySelector('.count').value);
        if (Number(result) > 0 && Number(result)) {
            object.querySelector('.sum').value = Number(result);
            object.querySelector('.view_sum').innerHTML = "<b class=\"visible\">Всього: </b>" + String(result) + "<p class=\"visible\"> грн.</p>";
        } else {
            object.querySelector('.sum').value = "";
            object.querySelector('.view_sum').innerHTML = "";
        }
    }

    function calcPriceTotal(object) {
        let result = 0;
        object.querySelectorAll('.sum').forEach((element) => [
            result += Number(element.value)
        ]);
        if (Number(result) > 0 && Number(result)) {
            object.querySelector('.sum_parent').value = Number(result);
            object.querySelector('.view_sum_parent').innerHTML = "Сума: " + String(result) + " грн";
            object.querySelector('.accordion__sum-subtype').innerHTML = "Сума: " + String(result) + " грн";
        } else {
            object.querySelector('.sum_parent').value = "";
            object.querySelector('.view_sum_parent').innerHTML = "Сума: 0 грн";
            object.querySelector('.accordion__sum-subtype').innerHTML = "";
        }
    }

    function calcParentTotal(object) {
        let result = 0;
        object.querySelectorAll('.sum_parent').forEach((element) => [
            result += Number(element.value)
        ]);
        if (Number(result) > 0 && Number(result)) {
            object.querySelector('.total').value = Number(result);
            object.querySelector('.view_total').innerHTML = "Всього: " + String(result) + " грн";
        } else {
            object.querySelector('.total').value = "";
            object.querySelector('.view_total').innerHTML = "Всього: 0 грн";
        }
    }
</script>
<script>

    function nameCheck(object, e, button) {
        let name = document.getElementById(object);
        let error = [];
        let errorHTML = name.parentElement.querySelector(e);

        if (!(/(?=.*[a-zA-Zа-яА-яіє]{2,})/.test(name.value)) || /[!@#$%^&*()_+}{"':;?./><,]+/.test(name.value) || (/(?=.*[0-9])/.test(name.value))) {
            error[0] = "<p>- Вкажіть ім'я вірно</p>";
        }

        if (error.length > 0) {
            errorHTML.innerHTML = "";
            name.classList.add('invalid');
            error.forEach((element) => [
                errorHTML.innerHTML += element
            ]);
            document.getElementById(button).disabled = true;
        } else {
            name.classList.remove('invalid');
            errorHTML.innerHTML = "";
            document.getElementById(button).disabled = false;
        }
    }

    function phoneCheck(object, e, button) {
        let phone = document.getElementById(object);
        let error = [];
        let errorHTML = phone.parentElement.querySelector(e);

        if ((/[_]+/.test(phone.value))) {
            error[0] = "<p>- Вкажіть повний номер телефону</p>";
        }

        if (error.length > 0) {
            errorHTML.innerHTML = "";
            phone.classList.add('invalid');
            error.forEach((element) => [
                errorHTML.innerHTML += element
            ]);
            document.getElementById(button).disabled = true;
        } else {
            phone.classList.remove('invalid');
            errorHTML.innerHTML = "";
            document.getElementById(button).disabled = false;
        }
    }

    function passwordCheck(object, e, button) {
        let password = document.getElementById(object);
        let error = [];
        let errorHTML = password.parentElement.querySelector(e);

        if (!(/(?=^.{6,}$)/.test(password.value))) {
            error[0] = "<p>- Мінімальний розмір 6 символів</p>";
        }

        if (!(/(?=.*[0-9])/.test(password.value))) {
            error[1] = "<p>- Пароль повинен містити 0-9</p>";
        }

        if (/[!@#$%^&*()_+}{"':;?./><,]+/.test(password.value) || /[\s]+/.test(password.value)) {
            error[2] = "<p>- Символи повинні бути цифрами або буквами</p>";
        }

        if (!(/(?=.*[a-z])/.test(password.value))) {
            error[3] = "<p>- Пароль повинен містити a-z</p>";
        }

        if (!(/(?=.*[A-Z])/.test(password.value))) {
            error[4] = "<p>- Пароль повинен містити A-Z</p>";
        }

        if (error.length > 0) {
            errorHTML.innerHTML = "";
            password.classList.add('invalid');
            error.forEach((element) => [
                errorHTML.innerHTML += element
            ]);
            document.getElementById(button).disabled = true;
        } else {
            password.classList.remove('invalid');
            errorHTML.innerHTML = "";
            document.getElementById(button).disabled = false;
        }
    }

    document.getElementById('catalog-name').onkeyup = nameCatalogCheck;
    document.getElementById('catalog-name').onblur = nameCatalogCheck;

    document.getElementById('type-name').onkeyup = nameTypeCheck;
    document.getElementById('type-name').onblur = nameTypeCheck;

    document.getElementById('name-service').onkeyup = nameServiceCheck;
    document.getElementById('name-service').onblur = nameServiceCheck;

    document.getElementById('price-service').onkeyup = priceCheck;
    document.getElementById('price-service').onblur = priceCheck;

    function nameCatalogCheck() {
        inputCheck('catalog-name', '.ap__error', 'submit-catalog');
    }

    function nameTypeCheck() {
        inputCheck('type-name', '.ap__error', 'submit-type');
    }

    function nameServiceCheck() {
        inputCheck('name-service', '.ap__error', 'submit-service');
    }

    function inputCheck(object, e, button) {
        let input = document.getElementById(object);
        let error = [];
        let errorHTML = input.parentElement.querySelector('.ap__error');

        if (!(/(?=.*[a-zA-Zа-яА-яіє0-9'])/.test(input.value)) || /[!@#$%^&*()_+}{":;?./><,]+/.test(input.value)) {
            error[0] = "<p>- Назва може містити A-Z(a-z), А-Я(а-я), 0-9</p>";
        }
        if (!(/(?=.{2,})/.test(input.value))) {
            error[1] = "<p>- Малий розмір</p>";
        }

        if (error.length > 0) {
            errorHTML.innerHTML = "";
            input.classList.add('invalid');
            error.forEach((element) => [
                errorHTML.innerHTML += element
            ]);
            document.getElementById(button).disabled = true;
        } else {
            input.classList.remove('invalid');
            errorHTML.innerHTML = "";
            document.getElementById(button).disabled = false;
        }
    }

    function priceCheck() {
        inputPriceCheck('price-service', '.ap__error', 'submit-service');
    }

    function inputPriceCheck(object, e, button) {
        let input = document.getElementById(object);
        let error = [];
        let errorHTML = input.parentElement.querySelector('.ap__error');

        if (!(/^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/).test(input.value) && !(input.value === '')) {
            error[0] = "<p>- Використовуйте правильний формат ціни</p>";
        }

        if (error.length > 0) {
            errorHTML.innerHTML = "";
            input.classList.add('invalid');
            error.forEach((element) => [
                errorHTML.innerHTML += element
            ]);
            if (!(input.value === '')) {
                document.getElementById(button).disabled = true;
            }
        } else {
            input.classList.remove('invalid');
            errorHTML.innerHTML = "";
            document.getElementById(button).disabled = false;
        }
    }
</script>
</body>
</html>
