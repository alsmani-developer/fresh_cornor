<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user= User::all();
        return view('pages.users.show_users',compact('user'));
    }

    public function user_order($user_id)
    {
        $user_order= Order::where('user_id', $user_id)->get();

        return view('pages.users.user_order',compact('user_order','user_id'));
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        
        return back();
    }

}
