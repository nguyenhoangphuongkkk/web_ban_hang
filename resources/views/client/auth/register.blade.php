<!DOCTYPE html>
<html>
<head>
  <title>Đăng kí</title>
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
          <h3 class="text-center">Form Đăng kí</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('create_user') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="inputName">Tên:</label>
              <input type="text" class="form-control" value="{{ old('name') }}"  name="name"  placeholder="Nhập tên của bạn">
            </div>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
              <label for="inputEmail">Email:</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Nhập email của bạn">
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
              <label for="inputPassword">Mật khẩu:</label>
              <input type="password" class="form-control" value="{{ old('password') }}" name="password"  placeholder="Nhập mật khẩu của bạn">
              @error('password')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Đăng kí</button>
          </form>
          <table>
            <a href="{{ route('login_show') }}">Đăng nhập</a>
            <a style="margin-left: 350px" href="{{ route('home') }}">Quay lại</a>
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