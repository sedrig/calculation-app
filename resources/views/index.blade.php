@extends('layouts.master')

@section('general')
    Головна&nbsp /
@endsection

@section('name')
    Калькулятор
@endsection


@section('content')


        <div class="content">

            <!-- warning -->
            @if (!session()->has('LoggedUser') && !session()->has('LoggedAdmin'))
                <div class="content__item warning">
                    <div class="warning__icon"><i class="fa fa-exclamation-circle fa-3x" aria-hidden="true"></i></div>
                    <div class="warning__text"><b>Увага!</b> Щоб зберегти результати розрахунків, Вам потрібно <a
                            href="{{ route('register') }}">зареєструватися</a>.</div>
                </div>
            @endif
            <div class="content__item">
                <!-- form calc -->
                <form class="form-calc" method="post">
                    @csrf
                    <!-- form calc name-->
                    <div class="form-calc__name">
                        <!-- form calc edit name-->
                        <div class="form-calc__edit" style="display: none">
                            <input id="editName" class="form-calc__edit-input" name="comment" type="text" value="@isset($sobaka){{ $sobaka->name }} @else Розрахунок вартості робіт <?= date('d.m.Y') ?> @endisset" onkeyup="validationName()" onblur="validationName()" autocomplete="off">
                                <a onclick="viewName()"><i class="fa fa-check" aria-hidden="true"></i></a>
                                </div>
                                <!-- form calc name view-->
                                <div class="form-calc__view">
                                <span id="name">@isset($sobaka){{ $sobaka->name }} @else Розрахунок вартості робіт <?= date('d.m.Y') ?> @endisset </span>
                                @isset($sobaka)
                                                                                                                    <input type="hidden" name="id_delete" value="{{ $sobaka->id }}">
                            @endisset
                                <a onclick="editName()"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- script for form calc name -->

                                <script>
                                function viewName() {
                                document.getElementById('name').textContent = document.getElementById('editName').value;
                                document.querySelector('.form-calc__edit').style.display = 'none';
                                document.querySelector('.form-calc__view').style.display = 'flex';
                                }
                                function editName() {
                                document.querySelector('.form-calc__view').style.display = 'none';
                                document.querySelector('.form-calc__edit').style.display = 'flex';
                                }
                                </script>
                                </div>
                                <!-- form calc inf-->
                                <div class="form-calc__inf">
                                <input class="form-calc__inf-input" type="text" name="descriprion" placeholder="Введіть додаткову інформацію або коментар" autocomplete="off" value="@isset($sobaka){{ $sobaka->detail }} @endisset" name="text">
                                </div>
                                <script>
                                function validationName() {
                                let name = document.getElementById('editName');

                                if (!(/(?=.*[a-zA-Zа-яА-яіє0-9]{2,})/.test(name.value))) {
                                name.classList.add('invalid');
                                name.parentElement.getElementsByTagName('a')[0].style.display = 'none';
                                } else {
                                name.classList.remove('invalid');
                                name.parentElement.getElementsByTagName('a')[0].style.display = 'block';
                                }
                                }
                                </script>
                                <!-- form calc accordions-->
                                @foreach ($families as $family)
                                <div class="accordion">


                                <div class="accordion__type">
                                <input class="accordion__input" id="type{{ $family->id }}" type="checkbox">
                                <label class="accordion__label" for="type{{ $family->id }}">{{ $family->name }}</label>


                                @foreach ($family->types as $tok)
                                <div class="accordion__subtype">
                                <input class="accordion__input" id="subtype{{ $tok->id }}" type="checkbox">
                                <label class="accordion__label" for="subtype{{ $tok->id }}">
                                <div class="accordion__row">
                                <div class="accordion__subtype-name">{{ $tok->name }}</div>
                                <div class="accordion__group">
                                <div class="accordion__row">
                                <div class="accordion__price">Ціна, грн</div>
                                <div class="accordion__count">ОВ</div>
                                <div class="accordion_sum">Всього, грн</div>

                                <div class="accordion__sum-subtype"></div>
                                </div>
                                </div>
                                </div>
                                </label>
                                <?php $count = 1; ?>
                                @foreach ($types as $type)
                                @if ($tok->id == $type->id)




                                @foreach ($type->services as $service)

                                <div class="accordion__service">
                                <div class="accordion__row">
                                <div class="accordion__service-name"><span>{{ $count++ }}  </span>{{ $service->name }}</div>
                                <div class="accordion__group">
                                <div class="accordion__row">
                                <div class="accordion__price-input"><input class="price" type="text" name="name[{{ $service->id }}]"  value=" @isset($sobaka) @if ($type->last($service->id, $sobaka) == 0) {{ $service->price }} @else {{ $type->last($service->id, $sobaka) }} @endif @else{{ $service->price }} @endisset  "  > грн</div>
                                <div class="accordion__count-input"><input class="count" type="text" name="units[{{ $service->id }}]" value="@isset($sobaka) @if ($type->last_next($service->id, $sobaka) == 0) @else {{ $type->last_next($service->id, $sobaka) }} @endif @else @endisset "> {{ $service->unit }}</div>
                                <!--<div class=""><input class="" type="hidden" name="type[{{ $service->id }}]" value="{{ $service->type_id }}"> </div>-->
                                <div class="accordion_sum-input"><input class="sum" type="text" hidden><span class="view_sum"></span></div>
                                </div>
                                </div>
                                </div>
                                </div>



                                    @endforeach


                            @endif
                            @endforeach


                            <div class="accordion__sum-for-subtype">
                            <input class="sum_parent" type="text" hidden>
                            <span class="view_sum_parent"></span>
                            </div>
                            </div>
                            @endforeach


                            <div class="accordion__sum-for-type">
                            <input class="total" type="text" hidden>
                            <span class="view_total"></span>
                            </div>
                            </div>


                            </div>
                            @endforeach

                            @if (session()->has('LoggedUser') || session()->has('LoggedAdmin'))
                            <div class="form-calc__button">
                            <button type="submit" formaction="{{ route('save_home') }}"><i class="fa fa-floppy-o" aria-hidden="true"></i>Зберегти</button>
                            <button type="submit" formaction="{{ route('see_home') }}"><i class="fa fa-eye" aria-hidden="true"></i>Переглянути</button>

                            <button type="submit" formaction="{{ route('see_home', 1) }}"><i class="fa fa-eye" aria-hidden="true"></i>Зберегти у pdf</button>

                            </div>
                            @endif


                            </form>
                            </div>
                            </div>



@endsection
