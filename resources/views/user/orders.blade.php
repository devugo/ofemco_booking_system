@extends('user.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div class="orders-summary">
            <div class="row">
                <div class="col-md-4">
                    <div class="devugo-card">
                        <div>
                            <i class="fa fa-book"></i>
                            <p>{{ $orders->total() }}</p>
                        </div>
                        <div>
                            <p>Orders Count</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="devugo-card">
                        <div>
                            <i class="fa fa-book"></i>
                            <p>{{ $orders->total() - $uncompletedOrders->count() }}</p>
                        </div>
                        <div>
                            <p>Completed Orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="devugo-card">
                        <div>
                            <i class="fa fa-book"></i>
                            <p>{{ $uncompletedOrders->count() }}</p>
                        </div>
                        <div>
                            <p>Pending Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <h2>Orders</h2>
            <table class="table table-bordered" id="devugo-table">
                <thead>
                    <tr class="text-center">
                        <th>SN</th>
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
                                <td>1</td>
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
                                    {{-- {!! $order->declined_at === NULL ? '<span class="badge badge-pill badge-warning">Warning</span>' : 'Paid' !!} --}}
                                </td>
                                <td><span class="badge badge-pill badge-primary">{{ $order->createdAtAgo() }}</span></td>
                                <td>
                                    @if($order->paid_at === NULL)
                                        <button class="btn btn-success" onclick="payWithPaystack({{$order->product->actual_cost}}, {{$order->id}})">
                                            PAY
                                        </button>
                                    @endif
                                    <button onclick="openModal({{ $order->id }})" class="btn btn-warning">
                                        REMOVE
                                    </button>
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
            {{ $orders->links() }}
        </div>
        <button style="display: none;" id="modal-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>
        
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to delete?</h4>
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
            function openModal(id){
                var modalBody = document.getElementById("devugo-modal-body");
                var child = `<a href="/order/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-warning">No</button>`;
                modalBody.innerHTML = child;
                document.getElementById("modal-button").click();
            }
        </script>
        <script src="https://js.paystack.co/v1/inline.js"></script>
        <script>
            function payWithPaystack(amount, orderId){
              var handler = PaystackPop.setup({
                key: 'pk_test_1bae26dbe6185780ae49ff975228b3bd060b8a09',
                email: '<?=auth()->user()->email?>',
                amount: amount * 100,
                currency: "NGN",
                metadata: {
                   custom_fields: [
                      {
                          display_name: "Mobile Number",
                          variable_name: "mobile_number",
                          value: "+2348133491134"
                      }
                   ]
                },
                callback: function(response){
                    console.log(response);
                    window.location.href = `http://127.0.0.1:8000/order/verify-payment/${response.reference}/${orderId}/${amount}`;
                },
                onClose: function(){
                    alert('window closed');
                }
              });
              handler.openIframe();
            }
        </script>
  </div>
@endsection
