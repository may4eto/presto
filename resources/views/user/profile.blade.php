<x-layout>
    <x-slot name="title">Presto</x-slot>
    <div class="container-fluid category-header mb-5">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <h1>{{$user->name}}</h1>
            </div>
        </div>
        
        <div class="row">
            @if(session('message'))
            <div class="col-12">
                <div class="alert-success alert"> {{session('message')}}</div>
            </div>
            @endif 
            
            <div class="col-8">
                <form action="{{route('requests.store')}}" method="POST">
                    @csrf
                    <div class="d-flex mt-3">
                    <h3>{{ __('ui.revisor_request')}}</h3>
                    <button class="btn btn-orange rounded-pill ml-3" type="submit">{{ __('ui.send_request')}}</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row my-3">
            <div class="col-12 text-center">
                <h2 class="h1">{{ __('ui.your_announcements')}}</h2>
            </div>  
        </div>
        
        @if(isset($posts) && count($posts) > 0)
        <div class="row mb-5">
            @foreach ($posts as $post)
            <div class="col-12 my-3">
                <x-category_card 
                    title="{!!$post->title!!}"
                    description="{!! $post->description !!}"
                    img="{{$post->img}}"
                    price="{{$post->price}}"
                    createdat="{{$post->created_at->format('d/m/Y')}}"
                    username="{{$post->user->name}}"
                    authorid="{{$post->user_id}}"
                    category="{{$post->category->name}}"
                    id="{{$post->id}}"
                />
            </div>
            @endforeach 
        </div>
        @else
        <div class="row">
            <div class="col-12 my-5 text-center">
                <h3 class="text-center">{{ __('ui.announcement_message')}}</h3>
                <a class="btn btn-orange btn-lg" href="{{route('posts.create')}}">{{ __('ui.start_sell')}}</a>
            </div>
        </div>
        @endif

        @if(count($favourites) > 0)
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="h1">{{ __('ui.favourites_announcements')}}</h2>
            </div> 
        </div>
        <div class="row mb-5">
            @foreach ($favourites as $favourite)
            <div class="col-12 my-3">
                <x-category_card 
                    title="{!!$favourite->title!!}"
                    description="{!! $favourite->description !!}"
                    img="{{$favourite->img}}"
                    price="{{$favourite->price}}"
                    createdat="{{$favourite->created_at->format('d/m/Y')}}"
                    username="{{$favourite->user->name}}"
                    authorid="{{$favourite->user_id}}"
                    category="{{$favourite->category->name}}"
                    id="{{$favourite->id}}"
                />
            </div>
            @endforeach 
        </div>
        @endif
    </div>
    
</x-layout>