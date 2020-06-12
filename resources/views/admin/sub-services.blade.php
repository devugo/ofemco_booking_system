@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div style="display: flex; justify-content: flex-end;">
            <a class="btn btn-success" href="{{ route('admin.add_sub_service') }}">
                Add +
            </a>
        </div><br />
        <div class="tab-summary">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.sub_services') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $servicesCount }}</p>
                            </div>
                            <div>
                                <p>Active Sub Services</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.sub_services', 'inactive') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $inactiveServicesCount }}</p>
                            </div>
                            <div>
                                <p>Inactive Sub Services</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <h2>Sub Services</h2>
            <table class="table table-bordered" id="tab-table">
                <thead>
                    <tr class="text-center">
                        <th>Sub Menu</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Sub Menu Slug</th>
                        <th>Button Text</th>
                        <th>Button Link</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($services) > 0)
                        @foreach($services as $service)
                            <tr class="text-center">
                                <td>{{ $service->sub_menu }}</td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->content }}</td>
                                <td>{{ $service->image }}</td>
                                <td>{{ $service->sub_menu_slug }}</td>
                                <td>{{ $service->button_text }}</td>
                                <td>{{ $service->button_link }}</td>
                                <td><span class="badge badge-pill badge-primary">{{ $service->createdAtAgo() }}</span></td>
                                <td>
                                    @if($service->deleted_at === NULL)
                                        <a style="font-size: 8px;" href="{{ route('admin.edit_sub_service', $service->id) }}" class="btn btn-default">
                                            Edit
                                        </a>
                                        <button style="font-size: 8px;" onclick="openModal({{ $service->id }}, 'delete')" class="btn btn-danger">
                                            Remove
                                        </button>
                                    @else
                                        <button style="font-size: 8px;" onclick="openModal({{ $service->id }}, 'restore')" class="btn btn-success">
                                            Restore
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="7">No Sub Services added!</td>
                        </tr>
                    @endif
                
                </tbody>
            </table>
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
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/service/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    childTitle = 'Are you sure you want to restore?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/service/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
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
