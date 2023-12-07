@extends('layouts.app')
@section('title', 'Presentation')
@section('content')
@auth
</table>
  <div class="container col-xs-12 col-md-0" style="margin-top:100px; font-size:19px; text-align: center">
    <table class="table table-striped table-hover align-items-center">
  <h2 class="mb-5">Дополнительная информация о метке <b>{{$allEntries[0]['RFID']}}</b></h2>

    <section class="container">
      <div class="row form-group">
        <div class="container mt-5">
          <h2>Выбор даты обновления метки</h2>
          <form method="get" action="{{route('monitoring.show', $allEntries[0]['RFID'])}}">
        <div class="form-group">
            <label for="datepicker">Установленная дата:</label>
            <input type="date" id="datepicker" name="Date" class="form-control" placeholder="{{$allEntries[0]['updated_at']}}">
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
    <th scope="col">Состояние</th>
    <th scope="col">Метка</th>
    <th scope="col">Номер станка</th>
    <th scope="col">Смыкания</th>
    <th scope="col">Предназначение</th>
    <th scope="col">Производитель</th>
    <th scope="col">Добавлена</th>
    <th scope="col">Обновлена</th>
    <th scope="col">Удалена</th>
    </tr>
  </thead>
    <tbody>
      @for ($index = 0; $index < count($allEntries); $index++)
      
      @php
      $state = $allEntries[$index]['State'];

      if ($state == 1) {
        $state = "Установлена";
        $color = "#beface";
      }
      else {
        $state = "Не установлена";
        $color = "#fc2d2d";
      }
      $createdDate = substr($allEntries[$index]['created_at'], 0, 10)." ".substr($allEntries[$index]['created_at'], 11, 8);
      $updatedDate = substr($allEntries[$index]['updated_at'], 0, 10)." ".substr($allEntries[$index]['updated_at'], 11, 8);
      @endphp

        <tr>
        <td style="background-color: {{$color}}">{{$state}}</td>
        <td>{{$allEntries[$index]['RFID']}}</td>
        <td>{{$allEntries[$index]['ID_stanok']}}</td>
        <td>{{$allEntries[$index]['Count']}}</td>
        <td>{{$allEntries[$index]['Purpose']}}</td>
        <td>{{$allEntries[$index]['Country']}}</td>
        <td>{{$createdDate}}</td>
        <td>{{$updatedDate}}</td>
        <td>{{$allEntries[$index]['deleted_at'] == null ? "-" : $allEntries[$index]['deleted_at']}}</td>
        @role('admin')
        <td>
          <a href="edit?RFID={{$allEntries[$index]['RFID']}}&ID={{$allEntries[$index]['id']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Изменить</button></a>
        </td>
        <td>
          <a href="delete?RFID={{$allEntries[$index]['RFID']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Удалить</button></a>
          @if ($allEntries[$index]['deleted_at'] != null)
          <td>
            <a href="restore?RFID={{$allEntries[$index]['RFID']}}"><button type="submit" class="btn btn-dark" style="margin-top:20px;">Восстановить</button></a>
          </td>
          @endif
        </td>
        @endrole
        </tr>
      @endfor
    </tbody>
    </table>
    </div>
 
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

@else @php abort(401); @endphp

@endauth
@endsection