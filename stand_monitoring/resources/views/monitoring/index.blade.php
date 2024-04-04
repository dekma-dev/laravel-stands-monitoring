@extends('layouts.app')
@section('title', 'Monitoring')
@section('content')
@auth
@csrf

<div class="header">
  <div class="dropdown position-fixed bottom-0 end-0 mb-0 me-3 bd-mode-toggle">
    <div class="container">
      <p class="float-end mb-1">
        <ul class="navbar-nav me-auto">
          <a id="scrollButton" class="nav-link hidden" href="#" class="button">Наверх</a>
          @role('admin')
          <center><a class="nav-link" href="{{route('monitoring.create')}}" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"/>
          </svg></a></center>
          @endrole
        </ul>  
      </p>
    </div>
  </div>
</div>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      @for ($index =  0; $index < count($sorted); $index++)
        <div class="col">
          <div class="card shadow-sm">
            @if ($sorted[$index]->deleted_at != null)
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Метка</title><rect width="100%" height="100%" fill="#212529"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$sorted[$index]->RFID}}</text><rect x="75%" y="0%" transform="rotate(30, 290, -12)" width="120" height="30" fill="none" stroke="red" stroke-width="5" rx="5" /><text x="88%" y="10%" fill="#ff0303" dy=".5em"font-weight="bold" font-size="25px" transform="rotate(30, 309, 5)">Удалена</text>
              </svg>
            @elseif ($sorted[$index]->Authenticity == "False")
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Метка</title><rect width="100%" height="100%" fill="#212529"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$sorted[$index]->RFID}}</text><svg x="10" y="10" class="alert-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16"><g fill="#eb7a34"><rect class="rotate-rectangle-around-icon" x="5.5" y="-6.2" width="11.5" height="11.5" transform="rotate(45)"/></g><path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/></svg><rect x="72%" y="0%" transform="rotate(30, 292, -29)" width="150" height="30" fill="none" stroke="#eb7a34" stroke-width="5" rx="5" /><text x="86.5%" y="10%" fill="#eb7a34" dy=".5em"font-weight="bold" font-size="23px" transform="rotate(30, 309, 5)">Не опознана</text>
              </svg>
            @else 
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Метка</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$sorted[$index]->RFID}}</text>
              </svg>
            @endif
              <div class="card-body">
                <p class="card-text">Установленная метка: {{$sorted[$index]->RFID}}</p>
                <p class="card-text">Установлена на станок: {{$sorted[$index]->ID_stanok}}</p>
                <p class="card-text">Количество смыканий: {{$sorted[$index]->Count}}</p>
                <p class="card-text">Состояние работоспособности: {{$sorted[$index]->Condition}}%</p>
                <div class="d-flex justify-content-between align-items-center">
                  <a href="monitoring/presentation?RFID={{$sorted[$index]->RFID}}&ID={{$sorted[$index]->id}}&DateFrom={{$sorted[$index]->updated_at}}&DateTo={{$sorted[$index]->updated_at}}" class="navbar-brand d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Подробнее</button>
                  </a>
                  @if ($sorted[$index]->State == 1)
                    <small class="text-body-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb-fill" viewBox="0 0 16 16"><path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm3 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1-.5-.5z"/></svg>{{$sorted[$index]->updated_at}}</small>
                  @else
                    <small class="text-body-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lightbulb" viewBox="0 0 16 16"><path d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a1.964 1.964 0 0 0-.453-.618A5.984 5.984 0 0 1 2 6zm6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1z"/></svg>{{$sorted[$index]->updated_at}}</small>
                  @endif
                </div>
              </div>
            </div>
          </div>
       @endfor
      </div>
    </div>
  </div>

  <footer class="text-muted" style="display: grid;place-items: center;justify-content: center;align-items: center;align-content: center;">
    <div class="container">
    <div><p class="float-right">
        {{$sorted->links()}}
      </p>
    </div>
  </footer>
    
  @else @php abort(401); @endphp
  @endauth
@endsection
<!-- <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->


