@extends('admin.templates.layout')
@section('content')
<form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-3">
        <h2 class="btn btn-info">Create-Product</h2> <br>
        <label for="inputName" class="form-label">Name</label>
        <input type="text" name="product_name" class="form-control" id="inputName" placeholder="Enter your name" value="{{ old('product_name') }}">
        @error('product_name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="inputName" class="form-label">Catgory_id</label> <br>
        <select class="form-select"  name="category_id" id="inputGroupSelect02">
                <option selected>Choose...</option>
            @foreach ($category as $cat)
                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="inputContent" class="form-label">Price</label>
        <input type="munber" name="price" class="form-control" id="inputName" placeholder="Enter your name" value="{{ old('price') }}">
        @error('price')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="col-md-3 col-sm-4 control-label">Image</label>
        <div class="col-md-9 col-sm-8">
            <div class="row">
                <div class="col-xs-6">
                    <img id="imgage_product" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" alt="your image"
                         style="max-width: 200px; height:100px; margin-bottom: 10px;" class="img-fluid"/>
                    <input type="file" name="image" accept="image/*"
                           class="form-control-file  " id="image">
                           @error('image')
                           <span class="text-danger">{{ $message }}</span>
                       @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="inputContent" class="form-label">Description</label> <br>
        <textarea class="form-control" name="description" rows="4" placeholder="Enter your tescription"></textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="inputContent" class="form-label">Stock_quantity</label>
        <input type="munber" name="stock_quantity" class="form-control" id="inputName" placeholder="Enter your name" value="{{ old('stock_quantity') }}">
        @error('stock_quantity')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@section('script')
    <script>
        $(function(){
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function (e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function () {
                readURL(this, '#imgage_product');
            });

        });
    </script>
@endsection