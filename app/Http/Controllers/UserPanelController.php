<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Order;
use Illuminate\Http\Request;

class UserPanelController extends Controller
{
    public function index()
    {
        $pageTitle = 'User Dashboard';
        $menus = Menu::all();

        return view('user/index', compact([
            'menus',
            'pageTitle'
        ]));
    }

    public function profile()
    {
        $menus = Menu::all();

        return view('user/profile', compact([
            'menus',
            'pageTitle'
        ]));
    }

    public function orders()
    {
        $pageTitle = 'User Orders';
         // $users = User::latest()->get();
        // if(is_null($users)){
        //     return response()->json('Record not found!', 404);
        // }
        // return response()->json($users, 200);
        // $users  = User::latest()->get();
        // $userPag = User::paginate($length);

        // // return $userPag->getOptions();
        // // return $userPag->count();


        $menus = Menu::all();
        // $orders = auth()->user()->orders;
        $orders = Order::latest()->paginate(3);
        $uncompletedOrders = Order::where('confirmed_at', NULL)->get();

        // dd($completedOrders->count());



        return view('user/orders', compact([
            'menus',
            'orders',
            'uncompletedOrders',
            'pageTitle'
        ]));
    }

    public function notifications()
    {
        $pageTitle = 'User Notifications';
        $menus = Menu::all();

        return view('user/notifications', compact([
            'menus',
            'pageTitle'
        ]));
    }
}
