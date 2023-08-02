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
                <h4 class="card-title">Category</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Id</th>
                                <th class="border-top-0">Category-Name</th>
                                <th class="border-top-0">tescription</th>
                                <th class="border-top-0"><a href="{{ route('create_category') }}" class="btn btn-success">Create</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ( $all_category as $cate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cate->category_name }}</td>
                                <td>{{ $cate->tescription }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('edit_category',$cate->id) }}">Update</a>
                                    <a class="btn btn-danger" href="{{ route('delete_category',$cate->id) }}" onclick=" return confirm('Bạn chắc muốn xóa chứ')">Delete</a>
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
