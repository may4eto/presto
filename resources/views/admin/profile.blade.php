<x-layout>
    <x-slot name="title">Presto</x-slot>
    <div class="container-fluid category-header mb-5">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    
    <div class="container">
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
        </div>
        
        <div class="row">
            <div class="col-12">
                <h2 class="h1 text-center">Gestisci revisori</h2>
            </div>
            <div class="col-12 my-3">
                @if(isset($revisor_requests) && count($revisor_requests) > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Inviata il</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($revisor_requests as $revisor_request)
                        <tr>
                            <th>{{$revisor_request->id}}</th>
                            <td>{{$revisor_request->user->name}}</td>
                            <td>{{$revisor_request->user->email}}</td>
                            <td>{{$revisor_request->created_at->format('d/m/Y')}}</td>
                            <td>
                                @if(!$revisor_request->is_accepted)
                                <form action="{{route('admin.accept', $revisor_request->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" id="accept" class="btn rounded-pill btn-success">Accetta</button>
                                </form>
                                @endif
                            </td>
                            <td>
                                @if($revisor_request->is_accepted)
                                <form action="{{route('admin.reject', $revisor_request->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" id="refuse" class="btn rounded-pill btn-danger">Rifiuta</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 class="text-center">Al momento non ci sono richieste</h3> 
                @endif
            </div>
        </div>
        
        
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h2 class="h1">I tuoi annunci</h2>
            </div>  
        </div>
        <div class="row">
            @if(isset($posts) && count($posts) > 0)
            @foreach ($posts as $post)
            <div class="col-12 my-3">
                <x-category_card 
                title="{{$post->title}}"
                description="{!! $post->description !!}"
                img="{{$post->img}}"
                price="{{$post->price}}"
                createdat="{{$post->created_at->format('d/m/Y')}}"
                username="{{$post->user->name}}"
                category="{{$post->category->name}}"
                id="{{$post->id}}"
                />
            </div>
            @endforeach 
            @else
            <div class="col-12 my-3">
                <h3 class="text-center">Non hai creato nessun annuncio</h3> 
            </div>
            @endif
        </div>
    </div>
    
</x-layout>