@extends('layouts.app')
@section('title', 'Editing')
@section('content')
@auth
<form class="container" action="{{route('monitoring.update', ['id' => $neededEntry[0]['id']])}}" method="post">
  @csrf
  {{ method_field('PATCH') }}
  <h4>Основная информация</h4>
  <div class="form-group">
    <label for="RFIDInput">Метка</label>
    <input type="text" name="RFID" class="form-control" id="RFIDInput" value="{{$neededEntry[0]['RFID']}}" placeholder="Введите метку" required>
  </div>
  <div class="form-group">
    <label for="MachineInput">Номер станка</label>
    <input type="text" name="ID_stanok" class="form-control" id="MachineInput" value="{{$neededEntry[0]['ID_stanok']}}" placeholder="Введите номер станка, на который будет установлена метка" required>
  </div>
  <div class="form-group">
    <label for="StateInput">Активность</label>
    <input type="text" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Введите 1 или 0, где 1 - Установлена, а 0 - Не установлена" name="State" class="form-control" id="StateInput" value="{{$neededEntry[0]['State']}}" placeholder="Введите состояние в виде 1 (активного) или 0 (не активного)"  onfocus="this.value='1'" required>
  </div>
  <div class="form-group">
    <label for="ConditionInput">Состояние</label>
    <input data-bs-toggle="tooltip" data-bs-placement="bottom" title="Введите состояние работоспособности метки в %" type="text" name="Condition" class="form-control" id="ConditionInput" value="{{$neededEntry[0]['Condition']}}" placeholder="Введите состояние работоспособности метки в %" required>
  </div>
  <hr/>
  <h4>Дополнительная информация</h4>
  <div class="form-group">
    <label for="PurposeInput">Предназначение</label>
    <input type="text" name="Purpose" class="form-control" id="PurposeInput" value="{{$neededEntry[0]['Purpose']}}" placeholder="Введите цель работы метки" required>
  </div>
  <div class="form-group">
    <label for="PerformerInput">Производитель</label>
    <input type="text" name="Country" class="form-control" id="PerformerInput" value="{{$neededEntry[0]['Country']}}" placeholder="Введите страну производитель метки" required>
  </div>
  <div class="form-group">
    <label for="authInput">Официальная метка?</label>         <svg data-bs-toggle="tooltip" data-bs-placement="right" title="Введите False - если метка не зарегистрирована официально, и True - если она официальная." xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16"><path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0m1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627"/></svg>
    <input type="text" data-bs-toggle="tooltip" data-bs-placement="top" title="Введите False - если метка не зарегистрирована официально, и True - если она официальная." name="Authenticity" class="form-control" id="authInput" value="{{$neededEntry[0]['Authenticity']}}" placeholder="Введите False - если метка не зарегистрирована официально, и True - если она официальная." required>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
    <label class="form-check-label" for="checkbox">Подтвердить</label>
  </div>
  <button type="submit" class="btn btn-primary" style="margin-top:20px">Изменить</button>  
</form>

@else 
  @php
    abort(401);
  @endphp

@endauth
@endsection