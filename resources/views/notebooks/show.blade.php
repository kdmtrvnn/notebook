<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if(!empty($notebook->data))
    <h5> Записная книжка: </h5>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 card text-center">
                    <div class="card-body">
                        <h7 class="fw-normal">
                            ФИО: {{ $notebook->data->attributes->surname }}
                            {{ $notebook->data->attributes->name }} {{ $notebook->data->attributes->patronymic }}
                        </h7><br>
                        <h7 class="fw-normal"> Компания: {{ $notebook->data->attributes->campaign }} </h7><br>
                        <h7 class="fw-normal"> Телефон: {{ $notebook->data->attributes->phone }} </h7><br>
                        <h7 class="fw-normal"> Email: {{ $notebook->data->attributes->email }} </h7><br>
                        <h7 class="fw-normal">
                            Дата рождения: {{ $notebook->data->attributes->date_of_birth
                            ? $notebook->data->attributes->date_of_birth : null }}
                        </h7>
                        @if($notebook->data->attributes->image !== null)
                            <img src="{{Storage::url($notebook->data->attributes->image)}}" width="200"><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@else
    <h5> Такой записной книжки нет. </h5>
@endif
</body>
</html>
