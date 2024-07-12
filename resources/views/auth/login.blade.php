
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.css')}}">
  <link rel="stylesheet" href="{{ asset('/AdminLTE/dist/css/login.css') }}">
  <link href="data:image/jpeg/jpg/png/webp;base64,{{ $logoBase64 }}" rel="icon">
  <title>Masuk & Registrasi | {{ $sites->sitename }}</title>
</head>

<body>

  <div class="container">
    <div class="signup-section">
      <header>Signup</header>

      <div class="separator">
        <div class="line"></div>
        <p>Or</p>
        <div class="line"></div>
      </div>

      <form action="{{ route('register-proses') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="nama" name="nama" class="form-control" placeholder="Full name">
        @error('nama')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <input type="email" name="email" class="form-control" placeholder="Email">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <input type="password" name="password" class="form-control" placeholder="Password">
        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
        <button type="submit" class="btn">Signup</button>
      </form>

    </div>

    <div class="login-section">
      <header>Login</header>

      <div class="social-buttons">
        <a href="{{ route('login.google') }}" class="icon-google"><i class="fa-brands fa-google-plus-g"></i> Login Google</a>
        <a href="{{ route('login.facebook') }}" class="icon-facebook"><i class="fa-brands fa-facebook-f"></i> Login Facebook</a>
      </div>

      <div class="separator">
        <div class="line"></div>
        <p>Or</p>
        <div class="line"></div>
      </div>

      <form action="{{ route('login-proses') }}" method="post">
        @csrf
        <input type="email" name="email" class="form-control" placeholder="Email">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <input type="password" name="password" class="form-control" placeholder="Password">
        @error('password')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <a href="{{ route('forgot-password') }}">Lupa Password?</a>
        <button type="submit" class="btn">Login</button>
      </form>

    </div>

  </div>


  <script src="../AdminLTE/dist/js/login.js"></script>
</body>

</html>