<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('stylesheets/public.css') }}">
    <title>Document</title>
</head>

<body>

    <div class="view-container">
        <div class="title-inf">{{ $request->comment }}</div>
        <div class="inf">{{ $request->descriprion }}</div>
        <table class="view-table">
            <thead class="view-thead">
                <tr class="view-tr">
                    <th>Найменування роботи</th>
                    <th>К-сть</th>
                    <th>ОВ</th>
                    <th>Ціна, грн</th>
                    <th>Всього, грн</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)

                    @foreach ($request->name as $key => $value)
                        @if (!($value === null || $request->units[$key] === null))
                            @foreach ($service as $map)
                                @if ($map->type_id == $type->id)
                                    @if ($key == $map->id)
                                        @if ($controll == 0)
                                            <tr>
                                                <th colspan="5">{{ $type->name }}</th>
                                                <?php $controll++; ?>
                                            </tr>
                                        @endif


                                    @endif
                                @endif

                            @endforeach
                        @endif
                    @endforeach
                    @foreach ($request->name as $key => $value)
                        @if (!($value === null || $request->units[$key] === null))
                            @foreach ($service as $item)
                                @if ($type->id == $item->type_id)
                                    @if ($key == $item->id)
                                        <tr>

                                            <td class="view-first">{{ $item->name }}</td>
                                            <td>{{ $request->units[$key] }}</td>
                                            <td>{{ $item->unit }}</td>
                                            <td>{{ $value }}</td>
                                            <td>{{ $m = $request->units[$key] * $value }}</td>
                                            <?php $k += $m; ?>


                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($k > 0)
                        <tr>
                            <td colspan="5" class="view-right">

                                <u>Сума: {{ $k }} грн</u>



                            </td>
                        </tr>
                    @endif
                    <?php $l += $k; ?>
                    <?php $controll = 0; ?>
                    <?php $k = 0; ?>
                @endforeach
                <tr>
                    <th colspan="5" class="view-last">
                        Кінцева вартість: {{ $l }} грн

                    </th>
                </tr>

            </tbody>
        </table>
    </div>

</body>

</html>
