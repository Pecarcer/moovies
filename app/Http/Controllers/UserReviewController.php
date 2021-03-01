<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Movie;

class UserReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){   
        
        
        return view('likes.admin');
    }
}
