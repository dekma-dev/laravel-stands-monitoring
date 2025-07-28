@extends('layouts.app')
@section('title', 'Отчёт')
@section('content')
@auth
@csrf

@php
    $datepicker1 = substr($requireDateFrom, 0, 10);
    $datepicker2 = substr($requireDateTo, 0, 10);
@endphp

<div class="container col-xs-12 col-md-0" style="margin-top:50px; font-size:19px; text-align: center">
    <h2 class="mb-5">Информация о работе метки <b>{{$allEntries[0]['RFID']}}</b></h2>

  <section class="container">
    <div class="row form-group">
      <div class="container mt-5">
        <h2>Установленная дата</h2>
        <form method="get">
          <div class="form-group">
            <input type="datetime-local" id="datepickerFrom" name="DateFrom" class="form-control" value="{{$requireDateFrom}}" required>
            <input type="datetime-local" id="datepickerTo" name="DateTo" class="form-control" value="{{$requireDateTo}}" required>
          </div>
        </form>
      </div>
  </section>
</div>

<table class="table table-striped table-hover align-items-center">
  <thead>
  <tr>
  <th scope="col">Положение</th>
  <th scope="col">Метка</th>
  <th scope="col">Номер станка</th>
  <th scope="col">Смыкания</th>
  <th scope="col">Предназначение</th>
  <th scope="col">Состояние</th>
  <th scope="col">Отработала</th>
  <th scope="col">Добавлена</th>
  <th scope="col">Обновлена</th>
  <th scope="col">Удалена</th>
  </tr>
</thead>

<tbody>
    @for ($index = 0; $index < count($allEntries); $index++)
    
    @php
    $state = $allEntries[$index]['State'];
    $color = null;

    if ($allEntries[$index]['deleted_at'] != null) {
      $state = "Удалена";
      $color = "#828282";
    } 
    else if ($state == "Установлена") {
      $state = "Установлена";
      $color = "#beface";
    }
    else if ($state == "Не установлена") {
      $state = "Не установлена";
      $color = "#fc2d2d";
    }

    $createdDate = substr($allEntries[$index]['created_at'], 0, 10)." ".substr($allEntries[$index]['created_at'], 11, 8);
    $updatedDate = substr($allEntries[$index]['updated_at'], 0, 10)." ".substr($allEntries[$index]['updated_at'], 11, 8);
    $deletedDate = substr($allEntries[$index]['deleted_at'], 0, 10)." ".substr($allEntries[$index]['updated_at'], 11, 8);

    $calculatedWorkTime = substr($allEntries[$index]['worktime'] / 3600, 0, 4);
    @endphp

      <tr>
      <td style="background-color: {{$color}}">{{$state}}</td>
      <td>{{$allEntries[$index]['RFID']}}</td>
      <td>{{$allEntries[$index]['ID_stanok']}}</td>
      <td>{{$allEntries[$index]['Count']}}</td>
      <td>{{$allEntries[$index]['Purpose']}}</td>
      <td>{{$allEntries[$index]['Condition']}}%</td>
      <td>{{$calculatedWorkTime}} ч</td>
      <td>{{$createdDate}}</td>
      <td>{{$updatedDate}}</td>
      <td>{{$allEntries[$index]['deleted_at'] == null ? "-" : $deletedDate}}</td>
      </tr>
    @endfor
  </tbody>
  </table>

@else @php abort(401); @endphp
@endauth
@endsection