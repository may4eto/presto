<x-layout>
    <x-slot name="title">Presto</x-slot>

    <div class="container-fluid category-header mb-4 mb-md-5">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-12 text-center mb-1 mb-md-5">
            <h2>Categoria {{$category->name}}</h2>
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
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex justify-content-center mb-5">
                {{$posts->links()}}
            </div>
        </div>
    </div>
</x-layout>