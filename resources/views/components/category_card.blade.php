<div class="row rounded bg-white shadow border-card">
    <div class="col-md-4 p-5">
        <div class="text-uppercase category-tag rounded-right">{{$category}}</div>
        <a href="{{route('posts.show', compact('id'))}}" title="{{$title}}">
            @if($image=App\Models\Image::where('post_id', $id)->first()) 
            <img src="{{$image->getUrl(300, 200)}}" class="img-fluid" alt="{{$title}}" />
            @else 
            <img src="https://via.placeholder.com/300x200.png" alt="">
            @endif
        </a>
    </div>
    <div class="col-md-8">
        <div class="row p-3 flex-columns justify-content-between h-100">
            
            <div class="col-12 m-0 p-0">
                <p class="float-right">
                    {{-- <a href="#" title="{{ __('ui.share')}}">
                        <i class="fa fa-share-alt mr-3"></i>
                    </a> --}}
                    
                    @guest
                        <form method="POST" action="{{route('user.add.favourite', compact('id'))}}">
                            @csrf
                            <button type="submit" class="btn btn-locale" >
                                <i class="far fa-heart"></i> {{ __('ui.add_favourite')}}
                            </button>
                        </form>
                    @else
                    @if(isset($authorid) && Auth::id() != $authorid)
                        @if(Auth::user()->favouritePosts()->find($id))
                        <form method="POST" action="{{route('user.remove.favourite', compact('id'))}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-locale" >
                                <i class="fa fa-heart"></i> {{ __('ui.rem_favourite')}}
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{route('user.add.favourite', compact('id'))}}">
                            @csrf
                            <button type="submit" class="btn btn-locale" >
                                <i class="far fa-heart"></i> {{ __('ui.add_favourite')}}
                            </button>
                        </form>
                        @endif
                    @endif

                    @endguest

                </p>
                <h4 class="h2 text-uppercase"><a href="{{route('posts.show', compact('id'))}}" title="{{$title}}">{{Str::words($title,10)}}</a></h4>
                <div class="text-justify d-none d-lg-block">{!! Str::words($description,50) !!} </div>
            </div>
            
            <div class="infos col-12 m-0 p-0 d-md-flex align-items-md-center justify-content-md-between">
                <p class="text-uppercase font-weight-bold mt-3 mt-md-0"><i class="fas fa-user-edit"></i> {{ __('ui.published')}} {{$username}} {{ __('ui.the')}} {{$createdat}}</p>
                <p class="product-price mt-3 mt-md-0">{{$price}}
                    {{-- <span class="small">
                        @if(isset($priceelem2))
                        ,{{$priceelem2}}
                        @else
                        ,00
                        @endif
                    </span> --}}
                    &euro;</p>
                </div>                 
                
            </div>
        </div>
    </div>