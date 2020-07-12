<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Service;
use App\Setting;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $settings = Setting::find(1);
        $pageTitle = 'Home';

        return view('welcome', compact([
            'menus',
            'settings',
            'pageTitle'
        ]));
    }

    public function service($menu, $service)
    {
        $allServices = Service::all();
        $menus = Menu::all();
        $menu = $menus->where('main_menu_slug', $menu)->first();

        // return $menu;
        if(!$menu){
            abort(404);
        }

        $pageTitle = $menu->main_menu;

        $services = $menu->services;

        if(!$services){
            abort(404);
        }

        $service = $services->where('sub_menu_slug', $service)->first();

        if(!$service){
            abort(404);
        }

        $products = $service->products;

        if(!$products){
            abort(404);
        }

        return view('service', compact([
            'menus',
            'service',
            'menu',
            'products',
            'pageTitle',
            'allServices'
        ]));
    }
}