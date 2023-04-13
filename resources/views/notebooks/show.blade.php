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
                        <form action="{{ route('notebooks.update', ['id' => $notebook->data->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <label>Фамилия:</label>
                        <input name="surname" class="form-file-input mt-3" value="{{ $notebook->data->attributes->surname }}" /><br>
                        <label>Имя:</label>
                        <input name="name" class="form-file-input mt-3" value="{{ $notebook->data->attributes->name }}"><br>
                        <label>Отчество:</label>
                        <input name="patronymic" class="form-file-input mt-3" value="{{ $notebook->data->attributes->patronymic }}"><br>
                        <label>Компания:</label>
                        <input name="campaign" class="form-file-input mt-3" value="{{ $notebook->data->attributes->campaign }}"><br>
                        <label>Телефон:</label>
                            <input name="phone" class="form-file-input mt-3" value="{{ $notebook->data->attributes->phone }}"><br>
                        <label>Email:</label>
                        <input name="email" class="form-file-input mt-3" value="{{ $notebook->data->attributes->email }}" ><br>
                        <label>Дата рождения:</label>
                        <input name="date_of_birth" class="form-file-input mt-3" value="{{ $notebook->data->attributes->date_of_birth
                            ? $notebook->data->attributes->date_of_birth : null}}"><br><br>
                        @if($notebook->data->attributes->image !== null)
                            <img src="{{Storage::url($notebook->data->attributes->image)}}" width="200"><br>
                        @endif

                            <input class="form-file-input mt-3" type="file" name="image" accept="image/jpeg,image/png" /><br>
                            <br><button type="submit">Обновить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@else
    <h5> Такой записной книжки нет. </h5>
@endif
</body>
</html>
