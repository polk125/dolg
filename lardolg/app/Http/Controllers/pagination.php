<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class pagination extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function usersWhere(){
        $users = User::table('users')
            ->whereIn('id', function($query)
            {
                $query->select(User::raw(1))
                    ->from('orders')
                    ->whereRaw('orders.user_id = users.id');
            })
            ->get();

    }

    public function users(){
        $users = User::simplePaginate(1);
        return view('pagination', compact('users'));
    }
}
