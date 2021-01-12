<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'locale');

        $categories = Category::orderBy('name', 'asc')->get();
        View::share('categories', $categories);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Paginator::useBootstrap();
        $posts = Post::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('welcome', compact('posts'));
    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
