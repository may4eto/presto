<x-layout>
    <div class="container-fluid category-header">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
    </div>
    
    @if(isset($post))
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center my-5">Post da revisionare</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 mb-3 d-md-flex justify-content-between align-items-center">
                        <p class="h3 text-secondary">Pubblicato da: <strong>{{$post->user->name}}</strong> il {{$post->created_at->format('d/m/Y')}}</p>
                        <p class="product-price font-weight-bold font-italic">
                            {{$post->price}}&euro;
                        </p>
                    </div>
                    <div class="col-12">
                        <h2>{{$post->title}}</h2>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-6">
                        
                    </div>
                    @if (Auth::id() == $post->user->id)
                    <div class="col-6 d-md-flex justify-content-end">
                        <a href="{{route('posts.edit', compact('post'))}}" class="mr-3"><i class="far fa-edit fa-2x"></i></a>
                        <form action="{{route('posts.destroy', compact('post'))}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-btn" onclick="return confirm('Sei sicuro di voler eliminare l\'annuncio?');"><i class="far fa-trash-alt fa-2x"></i></button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        @if(isset($images)&&count($images)>0)
        <div class="row mb-2">
            <div class="col-12">
                <h2>Immagini caricate</h2>
            </div>
        </div>

        @foreach ($images as $image)
        <div class="row mb-3 align-items-center">
            <div class="col-md-4">
                <img src="{{Storage::url($image->file)}}" class="img-fluid rounded shadow-lg" alt="{{$post->title}}">
            </div>
            <div class="col-md-8">
                <div class="row align-items-center pt-5 pt-md-0">
                    <div class="col-2">
                        <p class="m-0 text-right font-weight-bold">Adult</p>
                    </div>
                    <div class="col-10">
                        <span class="shadow-lg progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: {{$image->adult * 20}}%" aria-valuenow="{{$image->adult * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </div>

                    <div class="col-2 mt-2">
                        <p class="m-0 text-right font-weight-bold">Medical</p>
                    </div>
                    <div class="col-10 mt-2">
                        <span class="shadow-lg progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: {{$image->medical * 20}}%" aria-valuenow="{{$image->medical * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </div>

                    <div class="col-2 mt-2">
                        <p class="m-0 text-right font-weight-bold">Spoof</p>
                    </div>
                    <div class="col-10 mt-2">
                        <span class="shadow-lg progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: {{$image->spoof * 20}}%" aria-valuenow="{{$image->spoof * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </div>

                    <div class="col-2 mt-2">
                        <p class="m-0 text-right font-weight-bold">Violence</p>
                    </div>
                    <div class="col-10 mt-2">
                        <span class="shadow-lg progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: {{$image->violence * 20}}%" aria-valuenow="{{$image->violence * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </div>

                    <div class="col-2 mt-2">
                        <p class="m-0 text-right font-weight-bold">Racy</p>
                    </div>
                    <div class="col-10 mt-2">
                        <span class="shadow-lg progress mb-1">
                            <div class="progress-bar" role="progressbar" style="width: {{$image->racy * 20}}%" aria-valuenow="{{$image->racy * 20}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </span>
                    </div>
                </div>
                @if(!is_null($image->labels))
                    <p class="mt-5"><strong>Google keys:</strong> {{implode(', ', json_decode($image->labels))}}</p>
                @endif
            </div>
        </div>
        @endforeach
        @else
        <div class="row mb-2">
            <div class="col-12">
                <h2>Nessuna Immagine Caricata</h2>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-12 p-3 text-justify">
                <h2>Descrizione</h2>
            </div>
            <div class="col-12 p-3 text-justify">
                {!! $post->description !!}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 d-flex justify-content-between mb-5">
                <form action="{{route('revisor.accept', $post->id)}}" method="POST">
                    @csrf
                    <button type="submit" id="accept" class="btn rounded-pill shadow-lg btn-outline-success">Approva</button>
                </form>
                <form action="{{route('revisor.reject', $post->id)}}" method="POST">
                    @csrf
                    <button type="submit" id="refuse" class="btn rounded-pill shadow-lg btn-outline-danger">Rifiuta</button>
                </form>
            </div>
        </div>
    </div>
    
    @else
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center my-5">Attualmente non hai post da revisionare</h2>
            </div>
        </div>
    </div>
    @endif


</x-layout>