@extends('admin.templates.layout')
@section('content')
<div class="row">
    <!-- column -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Products</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Id</th>
                                <th class="border-top-0">Product-Name</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Price</th>
                                <th class="border-top-0">Image</th>
                                <th class="border-top-0">tock_quantity</th>
                                <th class="border-top-0"><a href="{{ route('create_product') }}" class="btn btn-success">Create</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $pro)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pro->product_name }}</td>
                                <td>{{ $pro->description }}</td>
                                <td>{{ $pro->price }}</td>
                                <td> <img src="{{ asset('storage/'.$pro->image) }}" style="width: 100px" alt=""></td>
                                <td>{{ $pro->stock_quantity }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('edit_product', ['id'=> $pro->id]) }}">Update</a>
                                    <a class="btn btn-danger" href="{{ route('delete_product', ['id'=> $pro->id]) }}" onclick=" return confirm('Bạn chắc muốn xóa chứ')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
