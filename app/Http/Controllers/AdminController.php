<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RevisorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $categories = Category::orderBy('name', 'asc')->get(); ///SELECT * FROM categories
        View::share('categories', $categories);
    }
    
    public function index(){
        $user = Auth::user();
        if($user->is_admin){
            $posts = $user->posts()->get();
            $revisor_requests = RevisorRequest::orderBy('created_at','asc')->get();
            return view('admin.profile', compact('user','posts', 'revisor_requests'));
        }
        else 
        abort(404);
    }
    
    private function setAccepted($request_id, $value) {
        $revisor_request = RevisorRequest::find($request_id);
        $revisor_request->is_accepted = $value;
        $revisor_request->save();
        return $revisor_request; 
    }
    
    public function accept($request_id){
        $revisor_request = $this->setAccepted($request_id, true);
        $revisor_request->user()->update(['is_revisor' => true]);
        return redirect(route('admin.profile'));
    }
    
    public function reject($request_id){
        $revisor_request = $this->setAccepted($request_id, false);
        $revisor_request->user()->update(['is_revisor' => false]);
        return redirect(route('admin.profile'));
    }
}
