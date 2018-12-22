<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;//find logged user id
        $user = User::find($user_id);//find this user in database and return his info
        //pass the method we created 'posts' that will refer to posts 
        //of this user according to his user_id in posts which belong to this user
        return view('dashboard')->with('posts',$user->posts);  
    }
}
