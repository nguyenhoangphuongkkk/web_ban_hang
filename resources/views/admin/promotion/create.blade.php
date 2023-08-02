@extends('admin.templates.layout')
@section('content')
<form action="{{ route('store_promotion') }}" method="POST">
    @csrf
    <div class="mb-3">
        <h2 class="btn btn-info">Create-Promotion</h2> <br>
        <label for="inputName" class="form-label">Name</label>
        <input type="text" name="title" class="form-control" id="inputName" placeholder="Enter your name"  value="{{ isset($promotion) ? $promotion->title : old('title') }}">
        @error('title')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="discount_percent">Discount Percent</label>
        <input type="number" name="discount_percent" class="form-control" step="0.01" value="{{ isset($promotion) ? $promotion->discount_percent : old('discount_percent') }}">
        @error('discount_percent')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" class="form-control" value="{{ isset($promotion) ? $promotion->start_date : old('start_date') }}">
        @error('start_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" name="end_date" class="form-control" value="{{ isset($promotion) ? $promotion->end_date : old('end_date') }}">
        @error('end_date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection