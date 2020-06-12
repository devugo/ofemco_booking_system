@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div class="tab-summary">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.subscribers') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $subscribersCount }}</p>
                            </div>
                            <div>
                                <p>Active Subscribers</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.subscribers', 'inactive') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $inactiveSubscribersCount }}</p>
                            </div>
                            <div>
                                <p>Inactive Subscribers</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <h2>Subscribers</h2>
            <table class="table table-bordered" id="tab-table">
                <thead>
                    <tr class="text-center">
                        <th>Email</th>
                        {{-- <th>No Of Messages</th> --}}
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($subscribers) > 0)
                        @foreach($subscribers as $subscriber)
                            <tr class="text-center">
                                <td>{{ $subscriber->email }}</td>
                                {{-- <td>{{ 5 }}</td> --}}
                                <td><span class="badge badge-pill badge-primary">{{ $subscriber->createdAtAgo() }}</span></td>
                                <td>
                                    @if($subscriber->deleted_at === NULL)
                                        <button style="font-size: 8px;" onclick="openModal({{ $subscriber->id }}, 'delete')" class="btn btn-danger">
                                            Remove
                                        </button>
                                    @else
                                        <button style="font-size: 8px;" onclick="openModal({{ $subscriber->id }}, 'restore')" class="btn btn-success">
                                            Restore
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="7">No Subscribers yet!</td>
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
                    childTitle = 'Are you sure you want to remove from mailing list?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/subscriber/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    childTitle = 'Are you sure you want to restore to mailing list?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/subscriber/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
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
