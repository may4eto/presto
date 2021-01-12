<x-layout>
    <x-slot name="title">{{ __('ui.welcome')}}</x-slot>
    
    <div class="container-fluid header mb-5">
        <div class="container">
            <div class="row align-items-start align-items-md-center min-vh-100">
                <div class="title col-12 col-md-8 pl-md-5 ml-md-5 content">
                    <h1 class="text-center text-md-left h1">PRESTO</h1>
                    <h1 class="text-center text-md-left h1">PRESTO</h1>
                    <h2 class="text-center text-md-left mt-5 pt-5">{{ __('ui.welcome_subtitle')}} </h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mb-5">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h2 class="h1">{{ __('ui.latest_announcements')}}</h2>
            </div>
            
            @if(session('message'))
            <div class="col-12">
                <div class="alert-success alert"> {{session('message')}}</div>
            </div>
            @endif
            @if (session('access.denied.revisor.only')) 
            <div class="col-12">
                <div class="alert alert-danger"> 
                    {{ __('ui.revisor_access')}} 
                </div>
            </div> 
            
            @endif
            
        </div>
        <div class="row">
            @foreach ($posts as $post)
            <div class="col-12 my-3">
                <x-category_card 
                title="{!! $post->title !!}"
                description="{!! $post->description !!}"
                price="{{$post->price}}"
                createdat="{{$post->created_at->format('d/m/Y')}}"
                username="{{$post->user->name}}"
                authorid="{{$post->user_id}}"
                category="{{$post->category->name}}"
                id="{{$post->id}}"
                />
            </div>
            @endforeach 

            {{-- @if(count(explode(',', $post->price)) == 2)
                    priceelem1="{{Arr::first(explode(',', $post->price))}}"
                    priceelem2="{{Arr::last(explode(',', $post->price))}}"
                @else
                    priceelem1="{{$post->price}}"
                @endif --}}
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex justify-content-center mb-5">
                {{$posts->links()}}
            </div>
        </div>
    </div>
    
</x-layout>