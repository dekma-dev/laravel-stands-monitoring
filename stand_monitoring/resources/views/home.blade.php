@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Личный кабинет</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Добро пожаловать, {{ Auth::user()->name }}
                        </div>
                    @endif
                    <form>
                    <fieldset disabled>
                        <legend>Информация о пользователе</legend>
                        <div class="mb-3">
                            <label for="disabledTextInput" class="form-label">ФИО</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}">
                            <label for="disabledTextInput" class="form-label">Должность</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->Role }}">
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
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
