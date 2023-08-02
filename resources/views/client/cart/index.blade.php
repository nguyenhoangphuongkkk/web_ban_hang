@extends('client.templates.layout')
@section('content')

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cart</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Cart  -->
@if (session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr class="cart-id" data-cart-id="{{ $item->id }}">
                                <td class="thumbnail-img">
                                    <a href="#">
                                <img class="img-fluid" src="{{ asset('storage/'.$item->product->image) }}" alt="" />
                            </a>
                                </td>
                                <td class="name-pr">
                                    <a href="#">
                                {{ $item->product->product_name }}
                            </a>
                                </td>
                                <td class="price-pr">
                                    <p>${{ $item->product->price }}</p>
                                </td>
                                <td data-th="Quantity">
                                    <input type="number" class="quantity-input" data-product-id="{{ $item->product_id }}" value="{{ $item->quantity }}" min="1">
                                </td>
                                <td class="total-pr">
                                    <p>${{ $item->product->price *  $item->quantity }}</p>
                                </td>
                                <td class="remove-pr">
                                    <a href="{{ route('cart.remove', ['id' => $item->id]) }}">
                                <i class="fas fa-times"></i>
                            </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
                <div class="coupon-box">
                    <form action="/apply-discount" method="POST">
                    <div class="input-group input-group-sm">

                        
                        <input class="form-control" name="discount_code" required type="text">
                        <div class="input-group-append">
                            <button class="btn btn-theme" type="submit">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> $ 130 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 40 </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Coupon Discount</h4>
                        <div class="ml-auto font-weight-bold"> $ 10 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto font-weight-bold"> $ 2 </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold"> Free </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> $ 388 </div>
                    </div>
                    <hr> </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>

    </div>
</div>
<!-- End Cart -->

<!-- Start Instagram Feed  -->
<div class="instagram-box">
    <div class="main-instagram owl-carousel owl-theme">
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-01.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-02.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-03.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-04.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-05.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-06.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-07.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-08.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-09.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ins-inner-box">
                <img src="{{ asset('client/images/instagram-img-05.jpg') }}" alt="" />
                <div class="hov-in">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Instagram Feed  -->
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  // Đoạn JavaScript (sử dụng jQuery)
$(document).ready(function () {
  // Lắng nghe sự kiện thay đổi của phần tử có class .quantity-input
  $('.quantity-input').on('change', function () {
    var productId = $(this).data('product-id');
    var id = $(".cart-id").data("cart-id");

    var newQuantity = $(this).val();

    console.log(id);

    // Gửi request Ajax để cập nhật dữ liệu lên server thông qua route cart.update
    $.ajax({
      url: '{{ route('cart.update') }}',
      method: 'POST',
      data: {
        _token: '{{ csrf_token() }}', // Nếu bạn sử dụng Laravel Blade template engine, bạn có thể sử dụng cách này để lấy token
        id: id,
        quantity: newQuantity,
        product_id: productId,
      },
      success: function (data) {
        console.log(data);
        
        $('.total-pr').html('<p>$' + data.itemTotal + '</p>');
      },
      error: function (xhr, status, error) {
        console.error('Lỗi khi gửi request Ajax:', error);
      }
    });
  });
});

</script>















