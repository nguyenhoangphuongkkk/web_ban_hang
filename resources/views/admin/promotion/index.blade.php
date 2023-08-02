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
                <h4 class="card-title">Promotion</h4>
                <div class="table-responsive">
                    <table class="table user-table">
                        <thead>
                            <tr>
                                <th class="border-top-0">Id</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Discount Percent</th>
                                <th class="border-top-0">Start Date<th>   
                                <th class="border-top-0">End Date<th>   
                                <th class="border-top-0"><a href="{{ route('create_promotion') }}" class="btn btn-success">Create</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ( $promotion as $promotion )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promotion->title }}</td>
                                <td>{{ $promotion->discount_percent }}</td>
                                <td>{{ $promotion->start_date }}</td>
                                <td>{{ $promotion->end_date }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('edit_promotion',$promotion->id) }}">Update</a>
                                    <a class="btn btn-danger" href="{{ route('delete_promotion',$promotion->id) }}" onclick=" return confirm('Bạn chắc muốn xóa chứ')">Delete</a>
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
