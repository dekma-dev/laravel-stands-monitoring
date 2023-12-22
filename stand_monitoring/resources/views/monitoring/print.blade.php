@extends('layouts.app')
@section('title', 'Отчёт')
@section('content')
@auth
@csrf

@php
    $datepicker1 = substr($requireDateFrom, 0, 10);
    $datepicker2 = substr($requireDateTo, 0, 10);
@endphp

<div class="container col-xs-12 col-md-0" style="margin-top:100px; font-size:19px; text-align: center">
    <table class="table table-striped table-hover align-items-center">
    <h2 class="mb-5">Информация о работе метки <b>{{$allEntries[0]['RFID']}}</b></h2>

<!-- paste the datepicker -->
    <section class="container">
      <div class="row form-group">
        <div class="container mt-5">
          <h2>Установленная дата</h2>
          <form method="get">
          <div class="form-group">
            <input type="date" id="datepickerFrom" name="DateFrom" class="form-control" value="{{$datepicker1}}" required>
            <input type="date" id="datepickerTo" name="DateTo" class="form-control" value="{{$datepicker2}}" required>
          </div>
          </form>
      </div>
    </section>

    <thead>
    <tr>
    <th scope="col">Состояние</th>
    <th scope="col">Метка</th>
    <th scope="col">Номер станка</th>
    <th scope="col">Смыкания</th>
    <th scope="col">Предназначение</th>
    <th scope="col">Добавлена</th>
    <th scope="col">Обновлена</th>
    <th scope="col">Удалена</th>
    </tr>
  </thead>

  <tbody>
      @for ($index = 0; $index < count($allEntries); $index++)
      
      @php
      $state = $allEntries[$index]['State'];

      if ($allEntries[$index]['deleted_at'] != null) {
        $state = "Удалена";
        $color = "#828282";
      } 
      else if ($state == 1) {
        $state = "Установлена";
        $color = "#beface";
      }
      else if ($state == 0) {
        $state = "Не установлена";
        $color = "#fc2d2d";
      }

      $createdDate = substr($allEntries[$index]['created_at'], 0, 10)." ".substr($allEntries[$index]['created_at'], 11, 8);
      $updatedDate = substr($allEntries[$index]['updated_at'], 0, 10)." ".substr($allEntries[$index]['updated_at'], 11, 8);
      $deletedDate = substr($allEntries[$index]['deleted_at'], 0, 10)." ".substr($allEntries[$index]['updated_at'], 11, 8);
      @endphp

        <tr>
        <td style="background-color: {{$color}}">{{$state}}</td>
        <td>{{$allEntries[$index]['RFID']}}</td>
        <td>{{$allEntries[$index]['ID_stanok']}}</td>
        <td>{{$allEntries[$index]['Count']}}</td>
        <td>{{$allEntries[$index]['Purpose']}}</td>
        <td>{{$createdDate}}</td>
        <td>{{$updatedDate}}</td>
        <td>{{$allEntries[$index]['deleted_at'] == null ? "-" : $deletedDate}}</td>
        </tr>
      @endfor
    </tbody>
    </table>
</div>

@else @php abort(401); @endphp
@endauth
@endsection