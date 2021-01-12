<x-layout>
    <x-slot name="title">{{ __('ui.add_announcement')}}</x-slot>
    
    
    <section class="min-vh-100 header2">
        <div class="container pb-5">
            <div class="row p-0 p-md-5">
                
                <div class="col-12 col-md-8 offset-md-2 my-5 pt-5">
                    <h1 class="text-center">{{ __('ui.add_here_announcement')}}</h1>
                </div>
                
                @if (session()->has('success'))
                <div class="col-12">
                    <div class="alert alert-success text-center">
                        {!! session()->get('success')!!}        
                    </div>
                </div>
                @endif
                
                <div class="col-12 col-md-8 offset-md-2 py-5 bg-light rounded shadow-xl">
                    
                    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="text">{{ __('ui.title')}}*</label>
                            <input type="text" class="form-control" id="text" name="title" value="{{old('title')}}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="img">{{ __('ui.image_upload')}}</label>
                            
                            <div class="dropzone" id="drophere"></div>
                            <input type="hidden" name="uniqueSecret" value="{{$uniqueSecret}}" />
                            @error('images')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('ui.price')}}*</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="categoria">{{ __('ui.category')}}*</label>
                            <select class="form-control" id="categoria" name="category_id">
                                <option selected disabled>{{ __('ui.select_category')}}</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">
                                    {{$category->name}}
                                </option>                                
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="categoria">{{ __('ui.description')}}*</label>
                            <textarea class="form-control" name="description" id="description" rows="10" name="description">{{old('description')}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <button class="float-right btn btn-outline-primary rounded-pill">{{ __('ui.save')}}</button>
                    </form>
                    
                </div>
            </div>
        </div>
        
        <!-- EDITOR -->
        <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
        
    </section>
    
</x-layout>