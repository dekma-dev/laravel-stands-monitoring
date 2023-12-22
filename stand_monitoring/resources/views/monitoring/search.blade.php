@extends('layouts.app')
@section('title', 'Searching')
@section('content')
@auth
@if (count($result))
<div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      @for ($index =  0; $index < count($result); $index++)
        <div class="col">
          <div class="card shadow-sm">
          @if ($result[$index]->deleted_at != null)
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Метка</title><rect width="100%" height="100%" fill="#212529"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$result[$index]->RFID}}</text><rect x="75%" y="0%" transform="rotate(30, 290, -12)" width="120" height="30" fill="none" stroke="red" stroke-width="5" rx="5" /><text x="88%" y="10%" fill="#ff0303" dy=".5em"font-weight="bold" font-size="25px" transform="rotate(30, 309, 5)">Удалена</text>
              </svg>
            @else 
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Метка</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$result[$index]->RFID}}</text>
              </svg>
            @endif
              <div class="card-body">
                <p class="card-text">Установленная метка: {{$result[$index]->RFID}}</p>
                <p class="card-text">Установлена на станок: {{$result[$index]->ID_stanok}}</p>
                <p class="card-text">Количество смыканий: {{$result[$index]->Count}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <a href="/monitoring/presentation?RFID={{$result[$index]->RFID}}&ID={{$result[$index]->id}}&DateFrom={{$result[$index]->updated_at}}&DateTo={{$result[$index]->updated_at}}" class="navbar-brand d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Подробнее</button>
                  </a>
                  @if ($result[$index]->State == 1)
                    <small class="text-body-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16"><path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/></svg>{{$result[$index]->updated_at}}</small>
                  @else
                    <small class="text-body-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16"><path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z"/></svg>{{$result[$index]->updated_at}}</small>
                  @endif
                </div>
              </div>
            </div>
          </div>
       @endfor
      </div>
    </div>
  </div>
@else
    <h1><center>Записи не найдены</center></h1>
@endif

<footer class="text-muted" style="display: grid;place-items: center;justify-content: center;align-items: center;align-content: center;">
      <div><p class="float-right"></div>
          {{$result->appends(['RFID' => request()->RFID])->links()}}
        </p>
</footer>

@else @php abort(401); @endphp

@endauth
@endsection