<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
       
  public function __construct()
  {        
    $this->middleware('auth');

    $categories = Category::orderBy('name', 'asc')->get(); ///SELECT * FROM categories
    View::share('categories', $categories);
  }
  
  public function profile(){
    $user = Auth::user();
    if(!$user->is_admin){
      $posts = $user->posts()->get();
      $favourites = $user->favouritePosts()->get();
      return view('user.profile', compact('user','posts','favourites'));
    }
    else  
      abort(404);
  }

  public function favouriteStore($post_id){
    $user = Auth::user();
    $user->favouritePosts()->attach($post_id);
    return redirect()->back()->with('message', 'Annuncio aggiunto ai favoriti');
  }

  public function favouriteRemove($post_id){
    $user = Auth::user();
    $user->favouriteposts()->detach($post_id);
    return redirect()->back()->with('message', 'Annuncio rimosso dai favoriti');
  }

}
