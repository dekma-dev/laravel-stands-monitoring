@extends('layouts.app')

<title>Creating</title>

@section('content')
@auth
  <form class="container" action="{{route('monitoring.store')}}" method="post">
    @csrf
    <h4>Основная информация</h4>
    <div class="form-group">
      <label for="RFIDInput">Метка</label>
      <input type="text" name="RFID" class="form-control" id="RFIDInput" placeholder="Введите метку" required>
    </div>
    <div class="form-group">
      <label for="MachineInput">Номер станка</label>
      <input type="text" name="ID_stanok" class="form-control" id="MachineInput" placeholder="Введите номер станка, на который будет установлена метка (?)" required>
    </div>
    <div class="form-group">
      <label for="StateInput">Состояние</label>
      <select id="StateInput" data-bs-toggle="tooltip"        data-bs-placement="bottom" name="State" class="form-control" title="Выберите из списка установлена метка или нет на данный момент." required>
        <option>Установлена</option>
        <option>Не установлена</option>
      </select>
    </div>
    <hr/>
    <h4>Дополнительная информация</h4>
    <div class="form-group">
      <label for="PurposeInput">Предназначение</label>
      <input type="text" name="Purpose" class="form-control" id="PurposeInput" placeholder="Введите цель работы метки" required>
    </div>
    <div class="form-group">
      <label for="PerformerInput">Производитель</label>
      <input type="text" name="Country" class="form-control" id="PerformerInput" placeholder="Введите страну производитель метки" required>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
      <label class="form-check-label" for="checkbox">Подтвердить</label>
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top:20px">Создать</button>  
  </form>

  @else <div class="main" style="display: grid;place-items: center;justify-content: center;align-items: center;align-content: center; vertical-align: middle;">
  @php abort(401); @endphp
  </div>

@endauth
@endsection