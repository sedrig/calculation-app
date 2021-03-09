<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                @foreach ($service as $serv)
                    @foreach ($calc as $cal)

                        @if ($serv->id === $cal->service_id)


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
                    @endforeach
                @endforeach
                <tr>

                </tr>
                <tr>
                    <th colspan="5" class="view-last">
                        Кінцева вартість: {{ $k }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
