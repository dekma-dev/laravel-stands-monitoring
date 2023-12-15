@extends('layouts.app')
@section('title', 'Editing')
@section('content')
@auth
<form class="container" action="{{route('monitoring.update', ['id' => $neededEntry[0]['id']])}}" method="post">
  @csrf
  {{ method_field('PATCH') }}
  <div class="form-group">
    <label for="RFIDInput">Метка</label>
    <input type="text" name="RFID" class="form-control" id="RFIDInput" value="{{$neededEntry[0]['RFID']}}" placeholder="Введите метку" required>
  </div>
  <div class="form-group">
    <label for="MachineInput">Номер станка</label>
    <input type="text" name="ID_stanok" class="form-control" id="MachineInput" value="{{$neededEntry[0]['ID_stanok']}}" placeholder="Введите номер станка, на который будет установлена метка" required>
  </div>
  <div class="form-group">
    <label for="StateInput">Состояние</label>
    <input type="text" title="Введите 1 или 0" name="State" class="form-control" id="StateInput" value="{{$neededEntry[0]['State']}}" placeholder="Введите состояние в виде 1 (активного) или 0 (не активного)"  onfocus="this.value='1'" required>
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