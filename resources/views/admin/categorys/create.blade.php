@extends('admin.templates.layout')
@section('content')
<form action="{{ route('store_category') }}" method="POST">
    @csrf
    <div class="mb-3">
        <h2 class="btn btn-info">Create-category</h2> <br>
        <label for="inputName" class="form-label">Name</label>
        <input type="text" name="category_name" class="form-control" id="inputName" placeholder="Enter your name" value="{{ old('category_name') }}">
        @error('category_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="inputContent" class="form-label">tescription</label>
        <textarea class="form-control" name="tescription" rows="4" placeholder="Enter your tescription"></textarea>
        @error('tescription')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection