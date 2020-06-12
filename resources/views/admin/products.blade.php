@extends('admin.layouts.structure')

@section('dashboard_content')
    <div class="container">
        <div style="display: flex; justify-content: flex-end;">
            <a class="btn btn-success" href="{{ route('admin.add_product') }}">
                Add +
            </a>
        </div><br />
        <div class="tab-summary">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('admin.products') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $productsCount }}</p>
                            </div>
                            <div>
                                <p>Active Products</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.products', 'inactive') }}">
                        <div class="devugo-card">
                            <div>
                                <i class="fa fa-book"></i>
                                <p>{{ $inactiveProductsCount }}</p>
                            </div>
                            <div>
                                <p>Inactive Products</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <h2>Products</h2>
            <table class="table table-bordered" id="tab-table">
                <thead>
                    <tr class="text-center">
                        <th>Service</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Features</th>
                        <th>Slashed Cost (NGN)</th>
                        <th>Actual Cost (NGN)</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <tr class="text-center">
                                <td>{{ $product->service->title }}</td>
                                <td>{{ $product->icon }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->sub_title }}</td>
                                <td>{{ $product->features }}</td>
                                <td>{{ currencyFormatter($product->slashed_cost, false) }}</td>
                                <td>{{ currencyFormatter($product->actual_cost, false) }}</td>
                                <td><span class="badge badge-pill badge-primary">{{ $product->createdAtAgo() }}</span></td>
                                <td>
                                    @if($product->deleted_at === NULL)
                                        <a style="font-size: 8px;" href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-default">
                                            Edit
                                        </a>
                                        <button style="font-size: 8px;" onclick="openModal({{ $product->id }}, 'delete')" class="btn btn-danger">
                                            Remove
                                        </button>
                                    @else
                                        <button style="font-size: 8px;" onclick="openModal({{ $product->id }}, 'restore')" class="btn btn-success">
                                            Restore
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="7">No Products added!</td>
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
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/product/destroy/${id}" class="btn btn-danger">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
                }else if(type === 'restore'){
                    childTitle = 'Are you sure you want to restore?';
                    child = `<div style="display: flex; justify-content: space-around;"><a href="/product/restore/${id}" class="btn btn-success">Yes</a><button data-dismiss="modal" class="btn btn-default">No</button></div>`;
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
