<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RevisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.revisor');
        $categories = Category::orderBy('name', 'asc')->get(); ///SELECT * FROM categories
        View::share('categories', $categories);
    }

    public function index() {
        if(Post::toBeRevisionedCount() > 0){
            $post = Post::where('is_accepted', null)->orderBy('created_at', 'asc')->first();
            $images = $post->images()->get();
            return view('revisor.index', compact('post', 'images'));
        }
        return view('revisor.index');
    }

    private function setAccepted($post_id, $value) {
        $post = Post::find($post_id);
        $post->is_accepted = $value;
        $post->save();
        return redirect(route('revisor.index'));
    }

    public function accept($post_id) {
        return $this->setAccepted($post_id, true);
    }

    public function reject($post_id) {
        return $this->setAccepted($post_id, false);
    }

}
