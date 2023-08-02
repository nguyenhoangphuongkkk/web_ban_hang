<!DOCTYPE html>
<html>
<head>
  <title>Đăng nhập</title>
  <!-- Thêm các thẻ meta để điều chỉnh hiển thị trên các thiết bị di động -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Liên kết Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Đăng nhập</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('auth.login') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="inputEmail">Email:</label>
              <input type="email" class="form-control" name="email"  placeholder="Nhập email của bạn">
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword">Mật khẩu:</label>
              <input type="password" class="form-control" name="password"  placeholder="Nhập mật khẩu của bạn">
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            @if (session()->has('error'))
            <div class="text-danger">
                {{ session('error') }}
            </div>
            @endif
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </form>
          <table>
          <a href="{{ route('register') }}">Bạn chưa có tài khoản</a>
          <a style="margin-left: 270px" href="{{ route('home') }}">Quay lại</a>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Liên kết thư viện jQuery và Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>