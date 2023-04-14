<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if(!empty($notebooks->data))
<h5> Записные книжки: </h5>
@foreach($notebooks->data as $notebook)
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 card text-center">
            <div class="card-body">
                <h7 class="fw-normal">
                    ФИО: {{ $notebook->attributes->surname }} {{ $notebook->attributes->name }} {{ $notebook->attributes->patronymic }}
                </h7><br>
                <h7 class="fw-normal"> Компания: {{ $notebook->attributes->campaign }} </h7><br>
                <h7 class="fw-normal"> Телефон: {{ $notebook->attributes->phone }} </h7><br>
                <h7 class="fw-normal"> Email: {{ $notebook->attributes->email }} </h7><br>
                <h7 class="fw-normal">
                    Дата рождения: {{ $notebook->attributes->date_of_birth ? $notebook->attributes->date_of_birth : null }}
                </h7><br>
                @if($notebook->attributes->image !== null)
                <img src="{{Storage::url($notebook->attributes->image)}}" width="200"><br>
                @endif
                <form method="post" action="{{ route('notebooks.delete', ['id' => $notebook->id]) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-info mt-2">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@if(isset($notebooks->links->prev))
<a href="{{ $notebooks->links->prev }}">Предыдущая страница</a>&nbsp;&nbsp;
@endif
@if(isset($notebooks->links->next))
<a href="{{ $notebooks->links->next }}">Следующая страница</a>
@endif
@else
<h5> Пока нет записных книжек. </h5>
@endif
</body>
</html>
