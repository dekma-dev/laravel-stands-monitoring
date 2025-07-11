@extends('layouts.app')
@section('title', 'Presentation')
@section('content')
@auth
@csrf
<div class="container col-xs-0 col-md-12" style="margin-top: 0px; margin-right: 200px; content-align: center">
  <svg data-bs-toggle="tooltip" data-bs-placement="bottom" title="Данная страница отображает историю работы метки на ТПА с возможностью выбора периода времени. Все изменения метки, её удаление или восстановление происходят с самой последней (свежей, актуальной) меткой." xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16"><path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0m1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627"/></svg>
</div>
<div class="container col-xs-12 col-md-0" style="margin-top:100px; font-size:19px; text-align: center">
  <h2 class="mb-5">Информация  о работе метки
  @if($allEntries[0]['Authenticity'] == "False")
    <svg x="10" y="10" class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="-2 -2 20 20"><g fill="#eb7a34"><rect class="rotate-rectangle-around-icon" x="4.8" y="-6.5" width="13" height="13" transform="rotate(45)"/></g><path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg><g  data-bs-toggle="tooltip" data-bs-placement="top" title="Неопознанная метка, обратитесь к администратору!">
    <b>{{$allEntries[0]['RFID']}}</b></g>
    <svg x="10" y="10" class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="-2 -2 20 20"><g fill="#eb7a34"><rect class="rotate-rectangle-around-icon" x="4.8" y="-6.5" width="13" height="13" transform="rotate(45)"/></g><path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg>
  @else <b>{{$allEntries[0]['RFID']}}</b>
  @endif
  </h2>

<!-- второе использование тегов php обусловлено необходимостью вставки даты в datepicker до дисплея таблицы -->
  <section class="container">
    <div class="row form-group">
      <div class="container mt-5">
        <h2>Выбор даты обновления метки</h2>
        <form method="get" action="{{route('monitoring.show', ['RFID' => $allEntries[0]['RFID'], 'ID' => $allEntries[0]['id'], 'DateFrom' => $requireDateFrom, 'DateTo' => $requireDateTo])}}">
        <div class="form-group">
          <label for="datepicker">Установленная дата (от и до):</label>
          <input type="datetime-local" id="extendedDateFrom" name="DateFrom" class="form-control" value="{{$requireDateFrom}}" required>
          <input type="datetime-local" id="extendedDateTo" name="DateTo" class="form-control" value="{{$requireDateTo}}" required>
        </div>
        @if(isset($allEntries[0]['RFID']))
          <input type="hidden" name="RFID" value="{{$allEntries[0]['RFID']}}">
          <input type="hidden" name="ID" value="{{$allEntries[0]['id']}}">
        @endif
          <button style="margin-top: 10px" type="submit" class="btn btn-primary">Выбрать</button>
          <button style="margin-top: 10px"  class="btn btn-dark" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" onclick="printReport()">
          Сделать отчёт</button>
       
        </form>
        @role('admin')
        <td>
          <a href="edit?RFID={{$allEntries[0]['RFID']}}&ID={{$allEntries[0]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top: 10px;">Изменить</button></a>
        </td>
        <td>
          <a href="delete?RFID={{$allEntries[0]['RFID']}}&id={{$allEntries[0]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top: 10px;">Удалить</button></a>
          @if ($allEntries[0]['deleted_at'] != null)
          <td>
            <a href="restore?RFID={{$allEntries[0]['RFID']}}&id={{$allEntries[0]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top: 10px;">Восстановить</button></a>
          </td>
          @endif
        </td>
        @endrole
      </div>   
    </div> 
  </section>
</div>
  
<table style="width: 75%" class="table table-striped table-hover align-items-center">
<thead>
  <tr style="text-align:center">
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

    $workTimeHrs = intdiv($allEntries[$index]['worktime'], 3600);
    $workTimeMns = intdiv($allEntries[$index]['worktime'] % 3600, 60);
    @endphp
      <tr style="vertical-align: middle; text-align: center">
        <td style="background-color: {{$color}}">{{$state}}</td>
        <td>{{$allEntries[$index]['RFID']}}</td>
        <td>{{$allEntries[$index]['ID_stanok']}}</td>
        <td>{{$allEntries[$index]['Count']}}</td>
        <td>{{$allEntries[$index]['Purpose']}}</td>
        <td>{{$allEntries[$index]['Condition']}}%</td>
        <td>{{$workTimeHrs}}ч.{{$workTimeMns}}мин.</td>
        <td>{{$createdDate}}</td>
        <td>{{$updatedDate}}</td>
        <td>{{$allEntries[$index]['deleted_at'] == null ? "-" : $deletedDate}}</td>
      </tr>
    @endfor
    </tbody>
  </table>

  
<script language="JavaScript">
  function printReport() {
    let newWindow = window.open("/monitoring/presentation/print?RFID={{$requireRFID}}&DateFrom={{$requireDateFrom}}&DateTo={{$requireDateTo}}", "_blank");
    
    newWindow.onload = function() {
            newWindow.print();
        };
  }
</script>

<div class="header">
  <div class="dropdown position-fixed bottom-0 end-0 mb-0 me-2 bd-mode-toggle">
    <div class="container">
      <p class="float-end mb-1">
      <div class="dropdown">
        <a id="scrollButton" class="nav-link hidden" href="#" class="button" style="margin-left: 75px; margin-bottom: 30px">Наверх</a>
        
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