<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisorRequestController extends Controller
{
    public function store () {
        $user=Auth::user();
        $user->revisorRequest()->create(['user_id'=>$user->id, 'is_accepted'=>null]);
        return redirect()->back()->with("message", "Hai inviato la richiesta.");
    }
}
