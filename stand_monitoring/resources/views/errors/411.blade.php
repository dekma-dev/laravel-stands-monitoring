@extends('layouts.app')

@section('title', 'Presentation | Not Found Records')
@section('content')
<div class="container" style="display: flex; align-items: center; justify-content: center;">
    <h3>Нет записей с указанным интервалом времени или интревал выбран некорректно</h3>
</div>

<div class="container" style="display: flex; align-items: center; justify-content: center;">
    <button type="submit" class="btn btn-primary" onclick="history.back();return false;">Назад</button>
</div>
@endsection
