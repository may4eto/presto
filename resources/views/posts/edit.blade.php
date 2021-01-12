<x-layout>
    <x-slot name="title">Presto - {{ __('ui.edit_announcement')}}</x-slot>
    
    
    <section class="min-vh-100 header2">
        <div class="container pb-5">
            <div class="row p-3">
                
                <div class="col-12 col-md-8 offset-md-2 pt-5">
                    <h1 class="text-center py-5">{{ __('ui.edit_announcement')}}</h1>
                </div>
                
                
                @if (session()->has('success'))
                <div class="col-12">
                    <div class="alert alert-success text-center">
                        {!! session()->get('success')!!}        
                    </div>
                </div>
                @endif
                
                <div class="col-12 col-md-8 offset-md-2 py-5 bg-light rounded shadow-xl">
                    
                    <form action="{{route('posts.update', compact('post'))}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="text">{{ __('ui.title')}}*</label>
                            <input type="text" class="form-control" id="text" name="title" value="{{$post->title}}">
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="img">{{ __('ui.your_images')}}</label>
                            <div class="row align-items-end">
                                @foreach ($images as $image)
                                <div class="col-4">
                                    <img src="{{Storage::url($image->file)}}" class="img-fluid" alt="{{$post->title}}">
                                    <button type="button" class="btn btn-outline-primary btn-block rounded-pill mt-2" data-toggle="modal" data-target="#image{{$image->id}}">
                                        {{ __('ui.remove_image')}}
                                    </button>
                                </div>  
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img">{{ __('ui.upload_other_images')}}</label>
                            
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
                            <input type="text" class="form-control" id="price" name="price" value="{{$post->price}}">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="categoria">{{ __('ui.category')}}*</label>
                            <select class="form-control" id="categoria" name="category_id">
                                <option disabled>{{ __('ui.select_category')}}</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if ($post->category_id == $category->id)
                                    selected
                                    @endif    
                                    >
                                    {{$category->name}}
                                </option>                                
                                @endforeach
                            </select>
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <div class="form-group">
                            <label for="categoria">{{ __('ui.description')}}*</label>
                            <textarea class="form-control" name="description" id="description" rows="10" name="description">{{$post->description}}</textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        <button class="float-right btn btn-outline-primary rounded-pill"> {{ __('ui.edit')}}</button>
                    </form>
                    
                </div>
            </div>
        </div>

        
        {{-- modale --}}
        @foreach ($images as $image)
        <div class="modal fade" id="image{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('ui.remove_image_message')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{Storage::url($image->file)}}" class="img-fluid d-block mx-auto" alt="{{$post->title}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-dismiss="modal">{{ __('ui.cancel')}}</button>
                        <form action="{{route('posts.image.delete', compact('image'))}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-pill">{{ __('ui.delete')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
        
        <!-- EDITOR -->
        <script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
        
    </section>
    
</x-layout>