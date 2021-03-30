<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        * {
            font-family: DejaVu Sans !important;
        }

    </style>
    <link rel="stylesheet" href="stylesheets/public.css">
    <title>Document</title>
</head>

<body>
    <div class="view-container">
        <div class="title-inf">{{ $sobaka->name }}</div>
        <div class="inf">{{ $sobaka->detail }}</div>
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
                    @if ($controll_calc == 0)
                        <?php $controll_calc++; ?>
                        @foreach ($service as $serv)
                            @foreach ($calc as $cal)
                                @if ($serv->id === $cal->service_id)
                                    @if ($serv->type_id == $type->id)
                                        @if ($controll == 0)
                                            <tr>
                                                <th colspan="5">{{ $type->name }}</th>
                                                <?php $controll++; ?>
                                            </tr>
                                            @if ($type->deleted_at != null)
                                                <td>Ця категорія була видалена </td>
                                            @endif
                                        @endif
                                    @endif

                                @endif
                            @endforeach
                        @endforeach

                    @endif
                    @foreach ($service as $serv)
                        @foreach ($calc as $cal)

                            @if ($serv->id === $cal->service_id)
                                @if ($type->id == $serv->type_id)


                                    <tr>
                                        <td class="view-first">{{ $serv->name }}</td>
                                        <td>{{ $cal->units }}</td>
                                        <td>{{ $serv->unit }}</td>
                                        <td>{{ $cal->price }}</td>
                                        <td>{{ $m = $cal->units * $cal->price }}</td>
                                        <?php $k += $m; ?>
                                        @if ($serv->deleted_at != null)
                                            <td>Цей товар був видалений </td>
                                        @endif

                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    @if ($k > 0)
                        <tr>
                            <td colspan="5" class="view-right">

                                <u>Сума: {{ $k }} грн</u>



                            </td>
                        </tr>
                    @endif
                    <?php $l += $k; ?>
                    <?php $controll_calc = 0; ?>
                    <?php $controll = 0; ?>
                    <?php $k = 0; ?>
                @endforeach
                <tr>
                    <th colspan="5" class="view-last">
                        Кінцева вартість: {{ $l }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
