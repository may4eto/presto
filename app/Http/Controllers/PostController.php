<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use App\Jobs\ResizeImage;
use Illuminate\Http\Request;
use App\Http\Requests\PostStore;
use App\Jobs\ApplyWatermarkImage;
use Illuminate\Support\Facades\Log;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionRemoveFaces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Jobs\GoogleVisionSafeSearchImage;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('show','search');
        
        $categories = Category::orderBy('name', 'asc')->get(); ///SELECT * FROM categories
        View::share('categories', $categories);
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {}
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $uniqueSecret = $request->old(
            'uniqueSecret', 
            base_convert(sha1(uniqid(mt_rand())), 16, 36)
        );
        return view('posts.create', compact('uniqueSecret'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PostStore $request)
    {
        $user = Auth::user();
        $post = $user->posts()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('category_id'),
            'user_id' => $user->id,
            ]);
            
            $uniqueSecret = $request->input('uniqueSecret');
            
            $images = session()->get("images.{$uniqueSecret}", []);
            $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
            
            $images = array_diff($images, $removedImages);
            
            foreach($images as $image){
                $an_image = new Image();
                $fileName = basename($image);
                $newFileName = "public/posts/{$post->id}/{$fileName}";
                Storage::move($image, $newFileName);

                $an_image->file = $newFileName;
                $an_image->post_id = $post->id;
                
                $an_image->save();

                GoogleVisionSafeSearchImage::withChain([
                    new GoogleVisionLabelImage($an_image->id),
                    new GoogleVisionRemoveFaces($an_image->id),
                    new ApplyWatermarkImage($newFileName),
                    new ResizeImage($an_image->file, 300, 200),
                    new ResizeImage($an_image->file, 400, 300)

                ])->dispatch($an_image->id);

            }
            
            File::deleteDirectory("/storage/temp/{$uniqueSecret}");
            
            $id = $post->id;
            $msg = 'Il tuo post è stato salvato! <a href="' . route('posts.show',compact('id')) . '"> Visualizza il tuo post.</a>';
            return redirect()->back()->withSuccess($msg);
        }
        
        public function getImages(Request $request){
            $uniqueSecret = $request->input('uniqueSecret');
            
            $images = session()->get("images.{$uniqueSecret}", []);
            $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
            
            $images = array_diff($images, $removedImages);
            $data = [];
            

            foreach($images as $image){
                $data[] = [
                    'id' => $image,
                    'src' => Image::getUrlByFilePath($image, 120, 120)
                ];
            }
            
            return response()->json($data);
        }
        
        public function uploadImage(Request $request){
            $uniqueSecret = $request->input('uniqueSecret');
            $fileName = $request->file('file')->store("/public/temp/{$uniqueSecret}");

            dispatch(new ResizeImage(
                $fileName,
                120,
                120
            ));

            session()->push("images.{$uniqueSecret}", $fileName);
            return response()->json(
                [ 'id' => $fileName ]
            );
        }
        
        public function removeImage(Request $request){
            $uniqueSecret = $request->input('uniqueSecret');
            $fileName = $request->input('id');
            session()->push("removedimages.{$uniqueSecret}", $fileName);
            Storage::delete($fileName);
            return response()->json('ok');
        }
        
        public function destroyImage(Request $request, Image $image){
            
            Storage::delete($image->file);
            $image->delete();
            $msg = 'Hai rimosso correttamente l\'immagine';
            return redirect()->back()->withSuccess($msg);
        }
        
        /**
        * Display the specified resource.
        *
        * @param  \App\Models\Post  $post
        * @return \Illuminate\Http\Response
        */
        public function show($post_id)
        {
            $post = Post::find($post_id);
            $price_elem = explode(',', $post->price);
            $images = $post->images()->get();
            if(is_array($post->price)){
                if(count($post->price) < 2)
                $price_elem = $post->price;
            }
            return view('posts.show', compact('post', 'price_elem', 'images'));
        }
        
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\Post  $post
        * @return \Illuminate\Http\Response
        */
        public function edit(Post $post, Request $request)
        {
            if(Auth::id() == $post->user->id){
                $uniqueSecret = $request->old(
                    'uniqueSecret', 
                    base_convert(sha1(uniqid(mt_rand())), 16, 36)
                );
                $images = $post->images()->get();
                return view('posts.edit', compact('post', 'uniqueSecret', 'images'));
            }
            else    
            abort(404);
        }
        
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Models\Post  $post
        * @return \Illuminate\Http\Response
        */
        public function update(PostStore $request, Post $post)
        {
            if(Auth::id() == $post->user->id){
                $post->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('category_id'),
                ]);
                
                $uniqueSecret = $request->input('uniqueSecret');
                
                $images = session()->get("images.{$uniqueSecret}", []);
                $removedImages = session()->get("removedimages.{$uniqueSecret}", []);
                
                $images = array_diff($images, $removedImages);
                
                foreach($images as $image){
                    $an_image = new Image();
                    $fileName = basename($image);
                    $newFileName = "public/posts/{$post->id}/{$fileName}";
                    
                    Storage::move($image, $newFileName);
                    
                    $an_image->file = $newFileName;
                    $an_image->post_id = $post->id;
                    
                    $an_image->save();

                    GoogleVisionSafeSearchImage::withChain([
                        new GoogleVisionLabelImage($an_image->id),
                        new GoogleVisionRemoveFaces($an_image->id),
                        new ApplyWatermarkImage($newFileName),
                        new ResizeImage($an_image->file, 300, 200),
                        new ResizeImage($an_image->file, 400, 300)
    
                    ])->dispatch($an_image->id);

                }
                
                File::deleteDirectory("/storage/temp/{$uniqueSecret}");
                
                $id=$post->id;
                $msg = 'Il tuo post è stato modificato! <a href="' . route('posts.show',compact('id')) . '"> Visualizza il tuo post.</a>';
                return redirect()->back()->withSuccess($msg);
            }
            else 
                abort(404);
        }
            
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Post  $post
        * @return \Illuminate\Http\Response
        */
        public function destroy(Post $post)
        {
            if(Auth::id() == $post->user->id){
                File::deleteDirectory("storage/posts/{$post->id}");
                Image::where('post_id', $post->id)->delete();
                $post->delete();
                return redirect()->route('home')->with('message', 'L\'annuncio è stato eliminato');
            }
            else
            abort(404);
        }
        
        public function search(Request $request){
            $search_empty = false;
            $q = $request->input('q');
            $posts = Post::search($q)->where('is_accepted', true)->orderBy('created_at', 'desc')->get();
            if(count($posts) == 0){
                $posts = Post::all()->random(3);
                $search_empty = true;
            }
            return view('posts.search', compact('posts','q', 'search_empty'));
        }
    }
        