@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 1.2em">Личный кабинет</div>

                <div class="card-body">
                        <div class="alert alert-{{session('alertCode', 'info')}}" role="alert">
                            {{session('message', 'Добро пожаловать!')}}
                        </div>
                    <form>
                    <fieldset disabled>
                        <legend >Информация о пользователе</legend>

                        <div class="row mb-3">
                            <label for="disabledTextInput" class="col-md-2 col-form-label text-md-end">ФИО</label>
                            <div class="col-md-9">
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="disabledTextInput" class="col-md-2 col-form-label text-md-end">Должность</label>
                            <div class="col-md-9">                        
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->Role }}">
                            </div>
                        </div>

                        <legend>Возможности и права пользователя</legend>
                        <div class="mb-3">
                            <ul>
                                @role('operator')
                                <li>
                                    Просмотр существующих активных меток
                                </li>
                                <li>
                                    Просмотр существующих не активных меток
                                </li>
                                <li>
                                    Поиск необходимой метки
                                </li>
                                <li>
                                    Просмотр истории работы метки
                                </li>
                                @endrole

                                @role('admin')
                                <li>
                                    Просмотр существующих активных меток
                                </li>
                                <li>
                                    Просмотр существующих не активных меток
                                </li>
                                <li>
                                    Изменение существующих меток
                                </li>
                                <li>
                                    Просмотр удалённых меток
                                </li>
                                <li>
                                    Восстановление удалённых меток
                                </li>
                                <li>
                                    Создание меток
                                </li>
                                <li>
                                    Поиск необходимой метки
                                </li>
                                <li>
                                    Просмотр истории работы метки
                                </li>
                                @endrole
                            </ul>
                        </div>

                        <legend>Примечания</legend>
                        <div class="mb-3">
                            <ul>
                                <li>
                                Просмотр удалённых меток возможен лишь непосредственно через строку поиска меток
                                </li>
                            </ul>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@role('admin')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="font-size: 1.2em">Панель управления пользователями</div>
                <div class="card-body">
                    <form action="{{route('home.update')}}" method="post">
                    @method('PATCH')
                    @csrf
                    <fieldset enabled>

                        <div class="row mb-3">
                            <label for="ChooseUser" class="col-md-2 col-form-label text-md-end">ФИО</label>
                            <div class="col-md-8">
                                <select id="ChooseUser" data-bs-toggle="tooltip" data-bs-placement="bottom" name="name" class="form-control" required>
                                    @foreach ($allUsers as $user)
                                    <option>{{$user['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="RoleSelect" class="col-md-2 col-form-label text-md-end">Выдать роль</label>
                            <div class="col-md-8">
                                <select id="RoleSelect" data-bs-toggle="tooltip" data-bs-placement="bottom" name="Role" class="form-control" required>
                                    <option>Оператор</option>
                                    <option>Администратор</option>
                                </select>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr auto; align-items: center; margin-top: 0px;">
                            <button type="reset" class="btn btn-primary" style="width: 135px;">Сбросить</button>
                            <button type="submit" style="width: 130px;" class="btn btn-primary">Применить</button>
                        </div>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 1.2em">Панель создания пользователей</div>
                <div class="card-body">
                    <form action="{{route('home.store')}}" method="post">

                    @csrf
                    <fieldset enabled>

                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('ФИО') }}</label>
                                <div class="form-group col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Иванов Иван Иванович" title="" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('e-mail') }}</label>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="ivanov_i@mail.ru" title="" autocomplete="email" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Role" class="col-md-2 col-form-label text-md-end">Выдать роль</label>
                                <div class="col-md-8">
                                    <select id="Role" data-bs-toggle="tooltip" data-bs-placement="bottom" name="Role" class="form-control" required>
                                    <option>Оператор</option>
                                    <option>Администратор</option>
                                </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-2 col-form-label text-md-end">{{ __('Пароль') }}</label>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Пароль" title="" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-end" style="margin-top: -10px;">{{ __('Подтвердите пароль') }}</label>

                                <div class="col-md-8">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" title="" placeholder="Пароль повторно" required autocomplete="new-password">
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr auto auto; align-items: center; margin-top: 20px; column-gap: 10px;">
                                    <button type="reset" class="btn btn-primary" style="width: 135px">Сбросить</button>
                                    <div style="display: grid; grid-template-columns: 1fr; margin-top: 0px;">
                                    </div>

                                    <div style="display: grid; grid-template-columns: 1fr; margin-top: 0px;">
                                        <div style="text-align: right;">
                                            <button type="submit" style="width: 130px" class="btn btn-primary">Создать</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>           
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="font-size: 1.2em">Панель удаления пользователей</div>
                    <div class="card-body">
                        <form action="{{route('home.destroy', $user['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <fieldset enabled>

                            <div class="row mb-3">
                                <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('ФИО') }}</label>
                                <div class="col-md-8">
                                    
                                    <select id="ChooseUser" data-bs-toggle="tooltip" data-bs-placement="bottom" name="name" class="form-control" required>
                                        @foreach ($allUsers as $user)
                                        <option>{{$user['name']}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                            <div style="display: grid; grid-template-columns: 1fr; margin-top: 0px;">
                                <div style="text-align: right;">
                                    <button type="submit" onClick="confirmAction(event)" style="width: 130px;" class="btn btn-primary">{{__('Удалить')}}</button>
                                </div>
                            </div>

                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" style="font-size: 1.2em">Панель восстановления пользователей</div>
                    <div class="card-body">
                        <form action="{{route('home.restore')}}" method="post">
                        @csrf
                        @method('PATCH')
                        <fieldset enabled>

                            <div class="row mb-3">
                                <label for="user_id" class="col-md-2 col-form-label text-md-end">{{ __('ФИО') }}</label>
                                <div class="col-md-8">
                                    
                                    <select id="ChooseUser" data-bs-toggle="tooltip" data-bs-placement="bottom" name="user_id" class="form-control" required>
                                        @foreach ($deletedUsers as $deletedUser)
                                        <option value="{{$deletedUser['id']}}">{{$deletedUser['name']}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                            <div style="display: grid; grid-template-columns: 1fr; margin-top: 0px;">
                                <div style="text-align: right;">
                                    <button type="submit" onClick="confirmAction(event)" style="width: 130px;" class="btn btn-primary">{{__('Восстановить')}}</button>
                                </div>
                            </div>

                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@endsection

<script language="JavaScript">

function confirmAction(event) {
    event.preventDefault();

    let result = confirm("Подтвердить изменения?");
    if (result) {
        //alert("Успешно!");
        event.target.closest("form").submit();
    } //else alert("Изменения отменены!");
}
</script>