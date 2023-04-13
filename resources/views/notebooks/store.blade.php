<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <div class="form-group">
                <h4>Создать записную книжку</h4>
                <form method="post" action="{{ route('notebooks.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label>Имя:</label>
                    <input class="form-file-input mt-3" type="text" name="name" required/><br>
                    <label>Фамилия:</label>
                    <input class="form-file-input mt-3" type="text" name="surname" required/><br>
                    <label>Отчество:</label>
                    <input class="form-file-input mt-3" type="text" name="patronymic" required/><br>
                    <label>Компания:</label>
                    <input class="form-file-input mt-3" type="text" name="campaign" /><br>
                    <label>Телефон:</label>
                    <input class="form-file-input mt-3" type="text" name="phone" required/><br>
                    <label>Email:</label>
                    <input class="form-file-input mt-3" type="email" name="email" required/><br>
                    <label>Дата рождения:</label>
                    <input class="form-file-input mt-3" type="text" name="date_of_birth" /><br>
                    <input class="form-file-input mt-3" type="file" id="image" name="image" accept="image/jpeg,image/png" /><br>
                    <button style="background-color: #6c757d;" class="btn mt-3">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
