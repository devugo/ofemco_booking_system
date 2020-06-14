@extends('admin.layouts.structure', ['sidebar_title' => 'Users'])

@section('dashboard_content')
    <div class="container">
        <div style="display: flex; justify-content: space-between;">
            <h3 class="short-underline">Users</h3>
            <a style="align-self: flex-start;" class="btn btn-success" href="{{ route('admin.add_user') }}">
                Add +
            </a>
        </div><br /><br />
        <div class="orders-summary">
            <div class="row">
                <div class="col-md-4">
                    <a class="dashboard-pill__wrapper" href="{{ route('admin.users') }}">
                        <div class="devugo-card dashboard-pill">
                            <div class="icon-well">
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                            <div class="count">
                                <p>All Users</p>
                                <p>{{ $usersCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="dashboard-pill__wrapper" href="{{ route('admin.users', 'unverified') }}">
                        <div class="devugo-card dashboard-pill">
                            <div class="icon-well">
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                            <div class="count">
                                <p>Unverified Users</p>
                                <p>{{ $unverifiedUsersCount }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a class="dashboard-pill__wrapper" href="{{ route('admin.users', 'deleted') }}">
                        <div class="devugo-card dashboard-pill">
                            <div class="icon-well">
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                            <div class="count">
                                <p>Deleted Users</p>
                                <p>{{ $deletedUsersCount }}</p>
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
                            <th>Photo</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Othernames</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Verified At</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <tr class="text-center">
                                    <td><img src="/storage/images/photos/{{ $user->photo }}" style="width: 30px; height: 30px; border-radius: 50%;" /></td>
                                    <td>{{ $user->firstname }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->othernames }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge badge-pill badge-success">{{ $user->verifiedAtAgo() }}</span></td>
                                    <td><span class="badge badge-pill badge-primary">{{ $user->createdAtAgo() }}</span></td>
                                    <td>
                                        <a class="btn btn-default" href="{{ route('admin.edit_user', $user->id) }}">Edit</a>
                                        
                                        @if($user->deleted_at === NULL)
                                            <button style="font-size: 8px;" onclick="openModal({{ $user->id }}, 'delete')" class="btn btn-danger">
                                                Delete
                                            </button>
                                            
                                            @if(!$user->verifiedAtAgo())
                                                <button style="font-size: 8px;" class="btn btn-info" onclick="openModal({{ $user->id }}, 'resend-verify-email')" class="fa fa-book">Send verify Email</button>
                                                <button style="font-size: 8px;" class="btn btn-info" onclick="openModal({{ $user->id }}, 'verify-now')" class="fa fa-book">Verify Now</button>
                                            @endif
                                        @else
                                            <button style="font-size: 8px;" onclick="openModal({{ $user->id }}, 'restore')" class="btn btn-success">
                                                Restore
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="7">No users found</td>
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
                    <h4 class="modal-title">Are you sure you want to continue?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="text-center" id="devugo-modal-body">
                    </div>
                </div>
                
            </div>
            </div>
        </div>
        
        <script>
            function openModal(id, type){
                var modalBody;
                var child;

                if(type === 'delete'){
                    modalBody = document.getElementById("devugo-modal-body");
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/user/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    modalBody = document.getElementById("devugo-modal-body");
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/user/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'verify-now'){
                    modalBody = document.getElementById("devugo-modal-body");
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/user/verify-now/${id}" class="btn btn-info">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'resend-verify-email'){
                    modalBody = document.getElementById("devugo-modal-body");
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/user/resend-verify-email/${id}" class="btn btn-info">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }
                if(modalBody){
                    modalBody.innerHTML = child;
                }
                document.getElementById("modal-button").click();
                
            }
        </script>
    </div>
@endsection
