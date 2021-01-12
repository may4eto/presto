<x-layout>
  <x-slot name="title">Presto - Pagina Annuncio</x-slot>
  
  <div class="container-fluid category-header mb-5">
    <div class="row">
      <div class="col-12"></div>
    </div>
  </div>
  
  @if($post->is_accepted != true)
  <div class="container">
    <div class="row justify-content-center">
       @if(is_null($post->is_accepted))
       <div class="col-md-8 text-center alert alert-dark p-3">
        <h3><i class="far fa-clock"></i> {{ __('ui.to_revision')}}</h3>
       </div>
       @elseif($post->is_accepted == false)
       <div class="col-md-8 text-center alert alert-danger p-3">
        <h3><i class="fas fa-exclamation-circle"></i> {{ __('ui.announcement_denied')}}</h3>
       </div>
       @endif
      </div>
    </div>
  </div>
  @endif

  <div class="container p-3 p-md-5 bg-white my-3 my-md-5 border rounded">
    <div class="row mb-3">
      <div class="col-md-4">

       
        
          @if(count($images)==0)
          <div>
            <img src="https://via.placeholder.com/300x200.png" alt="">
          </div>
          @else  
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @for($i=0; $i<count($images); $i++)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"
            @if($i == 0)
              class="active" 
            @endif
            ></li>
            @endfor
          </ol>
          <div class="carousel-inner">
              @foreach ($images as $image)
              <div class="carousel-item 
              @if($image == $images->first())
                active
              @endif
              ">
                <img src="{{Storage::url($image->file)}}" class="img-fluid" alt="{{$post->title}}">
              </div>
              @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        @endif
      </div>
      <div class="col-md-8 d-flex flex-column justify-content-between">
        <div class="row m-0 p-0 ml-md-4">
          <div class="col-12 mt-4 m-md-0 p-0">
            <h2 class="h1">{{$post->title}}</h2>
            <p class="product-price font-weight-bold font-italic">
              @if (is_array($price_elem)) 
                @if(count($price_elem) == 2)
                  {{$price_elem[0]}},<span class="small">{{$price_elem[1]}}</span> 
                @else
                  {{$price_elem[0]}},<span class="small">00</span> 
                @endif
              @endif
              &euro;
            </p>
          </div>
        </div>
        <div class="row align-items-center justify-content-between">
          <div class="col-md-6">
            <p class="text-secondary m-0 ml-md-4">{{ __('ui.published')}} {{$post->user->name}} {{ __('ui.the')}} {{$post->created_at->format('d/m/Y')}}</p>
          </div>
          @if (Auth::id() == $post->user->id)
          <div class="ml-3 ml-md-0 mt-3 mt-md-0 d-flex justify-content-end">
            <a href="{{route('posts.edit', compact('post'))}}" class="mr-3"><i class="far fa-edit fa-2x"></i></a>
            <form action="{{route('posts.destroy', compact('post'))}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="delete-btn" onclick="return confirm('{{ __('ui.delete_message')}}');"><i class="far fa-trash-alt fa-2x "></i></button>
            </form>
          </div>
          @endif
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12 p-3 text-justify">
        {!! $post->description !!}
      </div>
    </div>
  </div>

  
  
</x-layout>
