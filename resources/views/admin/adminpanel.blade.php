@extends('layouts.master')

@section('content')
    <main>
        <div class="container">
            <div class="ap">
                <div class="ap__row">


                    @isset($controllers)



                        <div class="ap__section">
                            <form class="form-edit-calc ap_mr" action="">
                                @csrf
                                @foreach ($families as $family)
                                    <div class="accordion">
                                        <div class="accordion__type">
                                            <input class="accordion__input" id="type{{ $family->id }}" type="checkbox">
                                            <label class="accordion__label" for="type{{ $family->id }}">
                                                <div class="accordion-edit__row">
                                                    <div class="accordion__name">{{ $family->name }}</div>
                                                    <div class="accordion-edit__group">
                                                        <div class="accordion-edit__row">
                                                            <div class="accordion__edit"><a
                                                                    href="{{ route('family.edit', $family->id) }}"><i
                                                                        class="fa fa-pencil" aria-hidden="true"></i></a></div>
                                                            <div class="accordion_delete"><a
                                                                    href="{{ route('family_destroy', $family->id) }}"><i
                                                                        class="fa fa-trash" aria-hidden="true"></i></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>

                                            @foreach ($family->types as $tok)

                                                <div class="accordion__subtype">
                                                    <input class="accordion__input" id="subtype{{ $tok->id }}"
                                                        type="checkbox">
                                                    <label class="accordion__label" for="subtype{{ $tok->id }}">
                                                        <div class="accordion-edit__row">
                                                            <div class="accordion-edit__subtype-name">{{ $tok->name }}
                                                            </div>
                                                            <div class="accordion-edit__group">
                                                                <div class="accordion-edit__row">
                                                                    <div class="accordion__edit"><a
                                                                            href="{{ route('type.edit', $tok->id) }}"><i
                                                                                class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                    </div>
                                                                    <div class="accordion_delete"><a
                                                                            href="{{ route('type_destroy', $tok->id) }}"><i
                                                                                class="fa fa-trash" aria-hidden="true"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <?php $count = 1; ?>
                                                    @foreach ($types as $type)
                                                        @if ($tok->id == $type->id)
                                                            @foreach ($type->services as $service)

                                                                <div class="accordion__service">
                                                                    <div class="accordion-edit__row">
                                                                        <div class="accordion-edit__service-name">
                                                                            <span>{{ $count++ }}</span>{{ $service->name }}
                                                                        </div>
                                                                        <div class="accordion-edit__group">
                                                                            <div class="accordion-edit__row">
                                                                                <div class="accordion__edit"><a
                                                                                        href="{{ route('service.edit', $service->id) }}"><i
                                                                                            class="fa fa-pencil"
                                                                                            aria-hidden="true"></i></a>
                                                                                </div>
                                                                                <div class="accordion_delete"><a
                                                                                        href="{{ route('service_destroy', $service->id) }}"><i
                                                                                            class="fa fa-trash"
                                                                                            aria-hidden="true"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                                @endforeach
                            </form>
                        </div>

                    @else

                        @isset($verify)

                            <div class="ap__section">

                                <div class="ap__setting ap_mb">
                                    <div class="ap__title">Каталог</div>
                                    <form class="ap__form" method="POST" action="{{ route('family.store') }}">
                                        @csrf
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Назва каталогу</div>
                                            <div class="ap__group">
                                                <input id="catalog-name" class="ap__input" type="text" name="family"
                                                    autocomplete="off">
                                                <div class="ap__text">
                                                    Введіть назву каталогу
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>
                                        <div class="ap__save">
                                            <button id="submit-catalog" class="ap__submit" type="submit"><i class="fa fa-floppy-o"
                                                    aria-hidden="true"></i>Зберегти</button>
                                        </div>
                                    </form>
                                </div>


                                <div class="ap__setting ap_mb">
                                    <div class="ap__title">Тип сервісу</div>
                                    <form class="ap__form" method="POST" action="{{ route('type.store') }}">
                                        @csrf
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Каталог</div>
                                            <div class="ap__group">
                                                <select class="ap__input" name="family_id" id="family_id">
                                                    @foreach ($families as $family)
                                                        <option value="{{ $family->id }}">
                                                            {{ $family->name }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                                <div class="ap__text">
                                                    Виберіть кадалог то якого відноситься тип
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Назва типу сервісу</div>
                                            <div class="ap__group">
                                                <input id="type-name" class="ap__input" type="text" name="type" autocomplete="off">
                                                <div class="ap__text">
                                                    Введіть назву типу сервісу
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>
                                        <div class="ap__save">
                                            <button id="submit-type" class="ap__submit" type="submit"><i class="fa fa-floppy-o"
                                                    aria-hidden="true"></i>Зберегти</button>
                                        </div>
                                    </form>
                                </div>


                                <div class="ap__setting">
                                    <div class="ap__title">Сервіс</div>

                                    <form class="ap__form" method="POST" action="{{ route('service.store') }}">
                                        @csrf
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Тип сервісу</div>
                                            <div class="ap__group">
                                                <select class="ap__input" name="type_id" id="type_id">
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}">
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                                <div class="ap__text">
                                                    Виберіть тип до якого відноситься сервіс
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Назва сервісу</div>
                                            <div class="ap__group">
                                                <input id="name-service" class="ap__input" name="services" type="text"
                                                    autocomplete="off">
                                                <div class="ap__text">
                                                    Введіть назву сервісу
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>

                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Ціна сервісу</div>
                                            <div class="ap__group">
                                                <input id="price-service" class="ap__input" type="text" autocomplete="off"
                                                    name="price_service">
                                                <div class="ap__text">
                                                    Введіть ціну сервісу
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>
                                        <div class="ap__row ap_mb">
                                            <div class="ap__label">Одиниця виміру</div>
                                            <div class="ap__group">
                                                <input id="ov-service" class="ap__input" type="text" autocomplete="off" name="ov">
                                                <div class="ap__text">
                                                    Введіть ОВ сервісу
                                                </div>
                                                <div class="ap__error"></div>
                                            </div>
                                        </div>


                                        <div class="ap__save">
                                            <button id="submit-service" class="ap__submit" type="submit"><i class="fa fa-floppy-o"
                                                    aria-hidden="true"></i>Зберегти</button>
                                        </div>
                                    </form>
                                </div>

                            </div>


                        @else
                            <div class="ap__section">
                                @if ($identify === 1)
                                    <div class="ap__setting ap_mb">
                                        <div class="ap__title">Каталог</div>
                                        <form class="ap__form" method="POST"
                                            action="{{ route('family.update', $families->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Назва каталогу</div>
                                                <div class="ap__group">
                                                    <input id="catalog-name" class="ap__input" type="text" name="family"
                                                        value="{{ $families->name }}" autocomplete="off">
                                                    <div class="ap__text">
                                                        Введіть назву каталогу
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>
                                            <div class="ap__save">
                                                <button id="submit-catalog" class="ap__submit" type="submit"><i
                                                        class="fa fa-floppy-o" aria-hidden="true"></i>Зберегти</button>
                                            </div>
                                        </form>
                                    </div>

                                @elseif($identify===2)
                                    <div class="ap__setting ap_mb">
                                        <div class="ap__title">Тип сервісу</div>
                                        <form class="ap__form" method="POST" action="{{ route('type.update', $type->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Каталог</div>
                                                <div class="ap__group">
                                                    <select class="ap__input" name="family_id" id="family_id">
                                                        @foreach ($families as $family)
                                                            <option value="{{ $family->id }}" @if ($family->id == $type->family_id) selected @endif>
                                                                {{ $family->name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                    <div class="ap__text">
                                                        Виберіть кадалог то якого відноситься тип
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Назва типу сервісу</div>
                                                <div class="ap__group">
                                                    <input id="type-name" class="ap__input" type="text" name="type"
                                                        value="{{ $type->name }}" autocomplete="off">
                                                    <div class="ap__text">
                                                        Введіть назву типу сервісу
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>
                                            <div class="ap__save">
                                                <button id="submit-type" class="ap__submit" type="submit"><i class="fa fa-floppy-o"
                                                        aria-hidden="true"></i>Зберегти</button>
                                            </div>
                                        </form>
                                    </div>

                                @elseif($identify===3)
                                    <div class="ap__setting">
                                        <div class="ap__title">Сервіс</div>

                                        <form class="ap__form" method="POST"
                                            action="{{ route('service.update', $service->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Тип сервісу</div>
                                                <div class="ap__group">
                                                    <select class="ap__input" name="type_id" id="type_id">
                                                        @foreach ($types as $type)
                                                            <option value="{{ $type->id }}" @if ($type->id === $service->type_id) selected @endif>
                                                                {{ $type->name }}
                                                            </option>
                                                        @endforeach


                                                    </select>
                                                    <div class="ap__text">
                                                        Виберіть тип до якого відноситься сервіс
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Назва сервісу</div>
                                                <div class="ap__group">
                                                    <input id="name-service" class="ap__input" name="services" type="text"
                                                        value="{{ $service->name }}" autocomplete="off">
                                                    <div class="ap__text">
                                                        Введіть назву сервісу
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>

                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Ціна сервісу</div>
                                                <div class="ap__group">
                                                    <input id="price-service" class="ap__input" type="text" autocomplete="off"
                                                        name="price" value="{{ $service->price }}">
                                                    <div class="ap__text">
                                                        Введіть ціну сервісу
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>
                                            <div class="ap__row ap_mb">
                                                <div class="ap__label">Одиниця виміру</div>
                                                <div class="ap__group">
                                                    <input id="ov-service" class="ap__input" type="text" autocomplete="off"
                                                        name="ov" value="{{ $service->unit }}">
                                                    <div class="ap__text">
                                                        Введіть ОВ сервісу
                                                    </div>
                                                    <div class="ap__error"></div>
                                                </div>
                                            </div>


                                            <div class="ap__save">
                                                <button id="submit-service" class="ap__submit" type="submit"><i
                                                        class="fa fa-floppy-o" aria-hidden="true"></i>Зберегти</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>




                        @endisset


                    @endisset





                    <div class="ap__menu">
                        <div class="menu">
                            <a class="menu__item" href="{{ route('edit_service') }}"><i class="fa fa-calculator"
                                    aria-hidden="true"></i>Калькулятор</a>
                            <a class="menu__item menu_active" href=""><i class="fa fa-cog"
                                    aria-hidden="true"></i>Налаштування каталогу</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
