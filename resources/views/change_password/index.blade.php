
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Ganti Password</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Password anda masih default silahkan jika ingin mengganti password jika tidak bisa tekan tombol lain kali.</p>

      @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
  
      <form action="{{ route('change_password') }}" method="post">
      @csrf
        <div class="input-group mb-3">
          <input type="password" name="oldPassword" class="form-control" placeholder="Password Lama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('oldPassword')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="newPassword" class="form-control" placeholder="Password Baru">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('newPassword')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="input-group mb-3">@if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
          <input type="password" name="confirmPassword" class="form-control" placeholder="Konfirmasi Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('confirmPassword')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="row">
          <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
          <div class="col-12 mt-3">
            <a href="{{ route('dashboard.index') }}" class="btn btn-info btn-block">Lain Kali</a>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE') }}/dist/js/adminlte.min.js"></script>
</body>
</html>
