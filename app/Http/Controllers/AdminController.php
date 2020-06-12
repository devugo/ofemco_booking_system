<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use App\Order;
use App\Product;
use App\Service;
use App\Subscriber;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $pageTitle = 'Admin Dashboard';
        $activeSideMenu = 'dashboard';

        return view('admin/index', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }
    public function profile()
    {
        $menus = Menu::all();
        $pageTitle = 'Admin Profile';
        $activeSideMenu = 'profile';

        return view('admin/profile', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }
    public function orders($type = 'all')
    {
        $pageTitle = 'Admin Orders';
        $activeSideMenu = 'orders';
        $menus = Menu::all();
        $orders = Order::latest()->get();
        $ordersCount = $orders->count();

        if($type === 'completed'){
            $orders = Order::latest()->where('confirmed_at', '!=', NULL)->get();
        }else if($type === 'pending'){
            $orders = Order::latest()->where('confirmed_at', NULL)->get();
        }else if($type === 'deleted'){
            $orders = Order::onlyTrashed()->get();
        }
        // return $orders;
        $uncompletedOrders = Order::where('confirmed_at', NULL)->get();
        $uncompletedOrdersCount = $uncompletedOrders->count();
        $completedOrders = Order::latest()->where('confirmed_at', '!=', NULL)->get();
        $completedOrdersCount = $completedOrders->count();
        $deletedOrders = Order::onlyTrashed()->get();
        $deletedOrdersCount = $deletedOrders->count();

        return view('admin/orders', compact([
            'menus',
            'orders',
            'ordersCount',
            'uncompletedOrders',
            'uncompletedOrdersCount',
            'completedOrders',
            'completedOrdersCount',
            'deletedOrders',
            'deletedOrdersCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function users($type = 'all')
    {
        $pageTitle = 'Admin Users';
        $activeSideMenu = 'users';
        $menus = Menu::all();

        $users = User::latest()->where('role_id', 2)->get();
        $usersCount = $users->count();

        if($type === 'deleted'){
            $users = User::onlyTrashed()->get();
        }else if($type === 'unverified'){
            $users = User::where('role_id', 2)->where('email_verified_at', NULL)->get();
        }
        // return $users;
        $unverifiedUsers = User::where('role_id', 2)->where('email_verified_at', NULL)->get();
        $unverifiedUsersCount = $unverifiedUsers->count();
        $deletedUsers = User::onlyTrashed()->get();
        $deletedUsersCount = $deletedUsers->count();

        return view('admin/users', compact([
            'menus',
            'users',
            'usersCount',
            'unverifiedUsers',
            'unverifiedUsersCount',
            'deletedUsers',
            'deletedUsersCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function add_user()
    {
        $pageTitle = 'Add user';
        $activeSideMenu = 'users';
        $menus = Menu::all();

        return view('admin/add-user', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function edit_user($id)
    {
        $pageTitle = 'Edit User';
        $activeSideMenu = 'users';
        $menus = Menu::all();
        $user = User::findOrFail($id);

        return view('admin/edit-user', compact([
            'menus',
            'user',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function subscribers($type = 'active')
    {
        $pageTitle = 'Subscribers';
        $activeSideMenu = 'subscribers';
        $menus = Menu::all();
        $subscribers = Subscriber::latest()->get();
        $subscribersCount = $subscribers->count();

        $inactiveSubscribers = Subscriber::onlyTrashed()->get();
        $inactiveSubscribersCount = $inactiveSubscribers->count();

        if($type === 'inactive'){
            $subscribers = Subscriber::onlyTrashed()->get();
        }

        return view('admin/subscribers', compact([
            'menus',
            'subscribers',
            'subscribersCount',
            'inactiveSubscribers',
            'inactiveSubscribersCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function services($type = 'active')
    {
        $pageTitle = 'Services';
        $activeSideMenu = 'services';
        $menus = Menu::all();
        $menusCount = $menus->count();
        $services = Service::latest()->get();
        $servicesCount = $services->count();

        $inactiveMenus = Menu::onlyTrashed()->get();
        $inactiveMenusCount = $inactiveMenus->count();

        if($type === 'inactive'){
            $menus = Menu::onlyTrashed()->get();
        }
        
        return view('admin/services', compact([
            'menus',
            'menusCount',
            'services',
            'servicesCount',
            'inactiveMenus',
            'inactiveMenusCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }
    
    public function add_service()
    {
        $pageTitle = 'Add Service';
        $activeSideMenu = 'services';
        $menus = Menu::all();

        return view('admin/add-service', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function edit_service($id)
    {
        $pageTitle = 'Edit Service';
        $activeSideMenu = 'services';
        $menus = Menu::all();
        $menu = Menu::findOrFail($id);

        return view('admin/edit-service', compact([
            'menus',
            'menu',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function sub_services($type = 'active')
    {
        $pageTitle = 'Sub Services';
        $activeSideMenu = 'sub_services';
        $menus = Menu::all();
        $services = Service::latest()->get();
        $servicesCount = $services->count();

        $inactiveServices = Service::onlyTrashed()->get();
        $inactiveServicesCount = $inactiveServices->count();

        if($type === 'inactive'){
            $services = Service::onlyTrashed()->get();
        }
        
        return view('admin/sub-services', compact([
            'menus',
            'services',
            'servicesCount',
            'inactiveServices',
            'inactiveServicesCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function add_sub_service()
    {
        $pageTitle = 'Add Sub Service';
        $activeSideMenu = 'sub_services';
        $menus = Menu::all();

        return view('admin/add-sub-service', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function edit_sub_service($id)
    {
        $pageTitle = 'Edit Sub Service';
        $activeSideMenu = 'sub_services';
        $menus = Menu::all();
        $service = Service::findOrFail($id);

        return view('admin/edit-sub-service', compact([
            'menus',
            'service',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function products($type = 'active')
    {
        $pageTitle = 'Products';
        $activeSideMenu = 'products';
        $menus = Menu::all();
        $products = Product::latest()->get();
        $productsCount = $products->count();

        $inactiveProducts = Product::onlyTrashed()->get();
        $inactiveProductsCount = $inactiveProducts->count();

        if($type === 'inactive'){
            $products = Product::onlyTrashed()->get();
        }
        
        return view('admin/products', compact([
            'menus',
            'products',
            'productsCount',
            'inactiveProducts',
            'inactiveProductsCount',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function add_product()
    {
        $pageTitle = 'Add Product';
        $activeSideMenu = 'products';
        $menus = Menu::all();
        $services = Service::all();

        return view('admin/add-product', compact([
            'menus',
            'services',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function edit_product($id)
    {
        $pageTitle = 'Edit Product';
        $activeSideMenu = 'products';
        $menus = Menu::all();
        $services = Service::all();
        $product = Product::findOrFail($id);

        return view('admin/edit-product', compact([
            'menus',
            'product',
            'services',
            'pageTitle',
            'activeSideMenu'
        ]));
    }


    public function settings()
    {
        $pageTitle = 'Admin Settings';
        $activeSideMenu = 'settings';
        $menus = Menu::all();

        return view('admin/settings', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }

    public function notifications()
    {
        $pageTitle = 'Admin Notifications';
        $activeSideMenu = 'notifications';
        $menus = Menu::all();

        return view('admin/notifications', compact([
            'menus',
            'pageTitle',
            'activeSideMenu'
        ]));
    }
}
