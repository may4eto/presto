
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  
  {{-- Stile da spostare --}}
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet"> 
  
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  
  {{$styles ?? ''}}
  <title>{{$title ?? 'Presto'}}</title>
</head>
<body>
  <x-navbar />
  {{$slot}}
  <x-footer />
  {{$scripts ?? ''}}
  
  <!--MODALE SEARCH -->
  <div id="search" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Cerca</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-inline my-2 my-lg-0" method='GET' action="{{route('posts.search')}}">
            <div class="d-flex justify-content-center" style="width: 100%;">
              <input class="form-control rounded-pill" name="q" type="search" placeholder="Cerca" aria-label="Search">
              <button class="btn rounded-pill btn-orange float-right" type="submit"><i class="fas fa-search text-center"></i></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> 
  
</body>
</html>