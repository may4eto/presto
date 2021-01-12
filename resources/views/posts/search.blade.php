<x-layout>
    <x-slot name="title">Presto - Risultati della ricerca</x-slot>

    <div class="container-fluid category-header mb-5">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-12 text-center">
            @if($search_empty)
                <h2>{{ __('ui.no_result', ['q' => $q])}}</h2>
            @else
                <h2>{{ __('ui.with_result', ['q' => $q])}}</h2>
            @endif
            </div>
                @foreach ($posts as $post)
                <div class="col-12 my-3">
                    <x-category_card 
                        title="{!! $post->title !!}"
                        description="{!! $post->description !!}"
                        img="{{$post->img}}"
                        price="{{$post->price}}"
                        createdat="{{$post->created_at}}"
                        username="{{$post->user->name}}"
                        authorid="{{$post->user_id}}"
                        category="{{$post->category->name}}"
                        id="{{$post->id}}"
                    />
                </div>
                @endforeach      
        </div>

       {{-- <div class="row">
            <div class="col-md-8">
                {{$posts->links()}}
            </div>
        </div>--}}
    </div>
</x-layout>