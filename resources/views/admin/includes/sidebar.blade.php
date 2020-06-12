<div class="admin-sidebar">
    <div class="admin-sidebar__menu">
        <ul>
            <li class="@if($activeSideMenu === 'dashboard')active @endif"><a class="@if($activeSideMenu === 'dashboard')active @endif" href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="@if($activeSideMenu === 'profile')active @endif"><a class="@if($activeSideMenu === 'profile')active @endif" href="{{ route('admin.profile') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <li class="@if($activeSideMenu === 'users')active @endif"><a class="@if($activeSideMenu === 'users')active @endif" href="{{ route('admin.users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>
            <li class="@if($activeSideMenu === 'orders')active @endif"><a class="@if($activeSideMenu === 'orders')active @endif" href="{{ route('admin.orders') }}"><i class="fa fa-sort-alpha-up"></i> <span>Orders</span></a></li>
            <li class="@if($activeSideMenu === 'subscribers')active @endif"><a class="@if($activeSideMenu === 'subscribers')active @endif" href="{{ route('admin.subscribers') }}"><i class="fa fa-superpowers"></i> <span>Subscribers</span></a></li>
            <li class="@if($activeSideMenu === 'services')active @endif"><a class="@if($activeSideMenu === 'services')active @endif" href="{{ route('admin.services') }}"><i class="fa fa-bars"></i> <span>Services</span></a></li>
            <li class="@if($activeSideMenu === 'sub_services')active @endif"><a class="@if($activeSideMenu === 'sub_services')active @endif" href="{{ route('admin.sub_services') }}"><i class="fa fa-poll-h"></i> <span>Sub Services</span></a></li>
            <li class="@if($activeSideMenu === 'products')active @endif"><a class="@if($activeSideMenu === 'products')active @endif" href="{{ route('admin.products') }}"><i class="fa fa-product-hunt"></i> <span>Products</span></a></li>
            {{-- <li><a href="{{ route('admin.notifications') }}">Notifications</a></li> --}}
            <li class="@if($activeSideMenu === 'settings')active @endif"><a class="@if($activeSideMenu === 'settings')active @endif" href="{{ route('admin.settings') }}"><i class="fa fa-tools"></i> <span>Settings</span></a></li>
        </ul>
    </div>
</div>