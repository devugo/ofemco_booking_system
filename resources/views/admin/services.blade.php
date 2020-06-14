@extends('admin.layouts.structure', ['sidebar_title' => 'Services'])

@section('dashboard_content')
    <div class="container">
        <div style="display: flex; justify-content: space-between;">
            <h3 class="short-underline">Services</h3>
            <a style="align-self: flex-start;" class="btn btn-success" href="{{ route('admin.add_service') }}">
                Add +
            </a>
        </div><br /><br />
        <div class="tab-summary">
            <div class="row">
                <div class="col-md-6">
                    <a class="dashboard-pill__wrapper" href="{{ route('admin.services') }}">
                        <div class="devugo-card dashboard-pill">
                            <div class="icon-well">
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                            <div class="count">
                                <p>All Services</p>
                                <p>{{ $menusCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a class="dashboard-pill__wrapper" href="{{ route('admin.services', 'inactive') }}">
                        <div class="devugo-card dashboard-pill">
                            <div class="icon-well">
                                <div class="icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                            <div class="count">
                                <p>Inactive Services</p>
                                <p>{{ $inactiveMenusCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div><br /><br />
        <div class="devugo-card">
            <div class="table-responsive">
                <table class="table table-bordered" id="devugo-table">
                    <thead>
                        <tr class="text-center">
                            <th>Main Menu</th>
                            <th>Main Menun Slug</th>
                            <th>Content</th>
                            <th>Icon</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($menus) > 0)
                            @foreach($menus as $menu)
                                <tr class="text-center">
                                    <td>{{ $menu->main_menu }}</td>
                                    <td>{{ $menu->main_menu_slug }}</td>
                                    <td>{{ $menu->content }}</td>
                                    <td>{{ $menu->icon }}</td>
                                    <td><span class="badge badge-pill badge-primary">{{ $menu->createdAtAgo() }}</span></td>
                                    <td>
                                        @if($menu->deleted_at === NULL)
                                            <a style="font-size: 8px;" href="{{ route('admin.edit_service', $menu->id) }}" class="btn btn-default">
                                                Edit
                                            </a>
                                            <button style="font-size: 8px;" onclick="openModal({{ $menu->id }}, 'delete')" class="btn btn-danger">
                                                Remove
                                            </button>
                                        @else
                                            <button style="font-size: 8px;" onclick="openModal({{ $menu->id }}, 'restore')" class="btn btn-success">
                                                Restore
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="7">No Services added!</td>
                            </tr>
                        @endif
                    
                    </tbody>
                </table>
            </div>
        </div>
        <button style="display: none;" id="modal-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>
        
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Continue with action</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="text-center" id="devugo-modal-body">
                        {{-- <a href="{{ route('order.destroy', orderId) }}" class="btn btn-danger">Yes</a>
                        <button data-dismiss="modal" class="btn btn-warning">No</button> --}}
                    </div>
                </div>
                
            </div>
            </div>
        </div>

        <script>
            function openModal(id, type){
                var modalBody = document.getElementById("devugo-modal-body");
                var modalTitle = document.getElementById("modal-title");
                var child;
                var childTitle;

                if(type === 'delete'){
                    childTitle = 'Are you sure you want to delete?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/menu/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    childTitle = 'Are you sure you want to restore?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/menu/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }

                if(modalTitle){
                    modalTitle.innerHTML = childTitle;
                }
                if(child && modalBody){
                    modalBody.innerHTML = child;
                }                
                document.getElementById("modal-button").click();
            }
        </script>
  </div>
@endsection
