@extends('layouts.app')
@section('title', 'Presentation')
@section('content')
@auth
@csrf
  <div class="container col-xs-12 col-md-0" style="margin-top:100px; font-size:19px; text-align: center">
    <table class="table table-striped table-hover align-items-center">
  <h2 class="mb-5">Информация о работе метки <b>{{$allEntries[0]['RFID']}}</b></h2>

  <!-- второе использование тегов php обусловлено необходимостью вставки даты в datepicker до дисплея таблицы -->
  @php
    $datepicker1 = substr($requireDateFrom, 0, 10);
    $datepicker2 = substr($requireDateTo, 0, 10);
  @endphp

    <section class="container">
      <div class="row form-group">
        <div class="container mt-5">
          <h2>Выбор даты обновления метки</h2>
          <form method="get" action="{{route('monitoring.show', ['RFID' => $allEntries[0]['RFID'], 'ID' => $allEntries[0]['id'], 'DateFrom' => $datepicker1, 'DateTo' => $datepicker2])}}">
          <div class="form-group">
            <label for="datepicker">Установленная дата (от и до):</label>
            <input type="date" id="datepickerFrom" name="DateFrom" class="form-control" value="{{$datepicker1}}" required>
            <input type="date" id="datepickerTo" name="DateTo" class="form-control" value="{{$datepicker2}}" required>
          </div>
          @if(isset($allEntries[0]['RFID']))
            <input type="hidden" name="RFID" value="{{$allEntries[0]['RFID']}}">
          @endif
            <button type="submit" class="btn btn-primary">Выбрать</button>
          </form>
      </div>
    </section>

  <thead>
    <tr>
    <th scope="col">Положение</th>
    <th scope="col">Метка</th>
    <th scope="col">Номер станка</th>
    <th scope="col">Смыкания</th>
    <th scope="col">Предназначение</th>
    <th scope="col">Состояние</th>
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
        <td>{{$allEntries[$index]['Condition']}}%</td>
        <td>{{$createdDate}}</td>
        <td>{{$updatedDate}}</td>
        <td>{{$allEntries[$index]['deleted_at'] == null ? "-" : $deletedDate}}</td>
        @role('admin')
        <td>
          <a href="edit?RFID={{$allEntries[$index]['RFID']}}&ID={{$allEntries[$index]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Изменить</button></a>
        </td>
        <td>
          <a href="delete?RFID={{$allEntries[$index]['RFID']}}&id={{$allEntries[$index]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Удалить</button></a>
          @if ($allEntries[$index]['deleted_at'] != null)
          <td>
            <a href="restore?RFID={{$allEntries[$index]['RFID']}}&id={{$allEntries[$index]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Восстановить</button></a>
          </td>
          @endif
        </td>
        @endrole
        </tr>
      @endfor
    </tbody>
    </table>
    </div>

    
  <script language="JavaScript">
    function printReport() {
     let newWindow = window.open("/monitoring/presentation/print?RFID={{$requireRFID}}&DateFrom={{$requireDateFrom}}&DateTo={{$requireDateTo}}", "_blank");
      
     newWindow.onload = function() {
             newWindow.print();
         };
    }
  </script>

  <div class="header">
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-0 bd-mode-toggle">
      <div class="container">
        <p class="float-end mb-1">
        <div class="dropdown">
          <a id="scrollButton" class="nav-link hidden" href="#" class="button">Наверх</a>
          <button class="btn btn-dark" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" onclick="printReport()">
            Сделать отчёт
          </button>
        </div>
        </p>
      </div>
    </div>
  </div>

  
<!--  
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->

@else @php abort(401); @endphp

@endauth
@endsection