@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div class="orders-summary">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('admin.orders', 'all') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $ordersCount }}</p>
                            </div>
                            <div>
                                <p>All Orders</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.orders', 'completed') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $completedOrdersCount }}</p>
                            </div>
                            <div>
                                <p>Completed Orders</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.orders', 'pending') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $uncompletedOrdersCount }}</p>
                            </div>
                            <div>
                                <p>Pending Orders</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.orders', 'deleted') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $deletedOrdersCount }}</p>
                            </div>
                            <div>
                                <p>Deleted Orders</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <h2>Orders</h2>
            <table class="table table-bordered" id="userorders">
                <thead>
                    <tr class="text-center">
                        <th>Email</th>
                        <th>Order ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Cost (NGN)</th>
                        <th>Amount Paid (NGN)</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->reference_id }}</td>
                                <td>{{ $order->product->title }}</td>
                                <td>{{ $order->product->service->sub_menu }}</td>
                                <td>{{ currencyFormatter($order->product->actual_cost, false) }}</td>
                                <td>{{ currencyFormatter($order->amount_paid, false) }}</td>
                                <td>
                                    @if($order->confirmed_at != NULL)
                                    <span class="badge badge-pill badge-success">Confirmed</span>
                                    @elseif($order->declined_at !== NULL)
                                        <span class="badge badge-pill badge-danger">Declined</span>
                                    @elseif($order->paid_at !== NULL && $order->verified_at === NULL)
                                        <a data-toggle="tooltip" title="Contact support!"><span class="badge badge-pill badge-danger">Failed verification</span></a>
                                    @elseif($order->paid_at !== NULL && $order->confirmed_at === NULL)
                                        <span class="badge badge-pill badge-info">Awaiting Approval</span>
                                    @elseif($order->paid_at === NULL)
                                        <span class="badge badge-pill badge-warning">Not paid</span>
                                    @elseif($order->paid_at !== NULL && $order->confirmed_at !== NULL)
                                        <span class="badge badge-pill badge-success">Payment Received</span>
                                    @endif
                                </td>
                                <td><span class="badge badge-pill badge-primary">{{ $order->createdAtAgo() }}</span></td>
                                <td>
                                    @if($order->deleted_at === NULL)
                                        <button style="font-size: 8px;" onclick="openModal({{ $order->id }}, 'delete')" class="btn btn-danger">
                                            Delete
                                        </button>
                                        @if($order->confirmed_at === NULL)
                                            <button style="font-size: 8px;" onclick="openModal({{ $order->id }}, 'confirm')" class="btn btn-primary">
                                                Confirm
                                            </button>
                                        @endif
                                    @else
                                        <button style="font-size: 8px;" onclick="openModal({{ $order->id }}, 'restore')" class="btn btn-success">
                                            Restore
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="7">No orders placed</td>
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
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/order/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    childTitle = 'Are you sure you want to restore?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/order/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'confirm'){
                    childTitle = 'Are you sure you want to confirm?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/order/confirm/${id}" class="btn btn-primary">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
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
