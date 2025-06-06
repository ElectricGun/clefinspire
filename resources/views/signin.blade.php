<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #f8a5c2, #e17055);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      font-weight: bold;
      color: #333;
    }

    .mb-3 {
      text-align: left;
    }

    .password-toggle {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      margin-top: 5px;
    }

    .policy, .links {
      font-size: 12px;
      margin-top: 10px;
      display: inline-block; /* Make the links inline */
      white-space: nowrap; /* Prevent the text from wrapping */
    }

    .policy a, .links a {
      color: #000;
      text-decoration: underline;
    }

    .create-account {
      margin-top: 20px;
      display: inline-block;
      padding: 10px 40px;
      border-radius: 20px;
      background: #fff;
      font-weight: bold;
      text-decoration: none;
      color: #000;
      border: 1px solid #000;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      width: 100%;
      text-align: center;
      font-size: 12px;
      color: #fff;
    }

    .error {
      font-size: 12px;
      color: red;
      margin-top: 4px;
    }

    /* Custom Grey Button */
    .btn-grey {
      background-color: #ccc;  /* Grey color */
      border-color: #ccc;      /* Grey border */
      color: #333;             /* Dark text color */
    }

    .btn-grey:hover {
      background-color: #bbb;  /* Darker grey when hovering */
      border-color: #bbb;      /* Darker border on hover */
    }
  </style>
</head>
<body>

  <form class="container" method="POST" action="{{ route('signin.submit') }}">
    @csrf
    <h2>Sign In</h2>

    <div class="mb-3">
      <label for="email" class="form-label">Enter your email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Your password</label>
      <input type="password" class="form-control" id="password" name="password" required>
      <div class="password-toggle">
        <span></span>
        <span onclick="togglePassword()" style="cursor:pointer;">👁️ Show</span>
      </div>
      @error('password')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-grey w-100">Log in</button>

    <div class="policy">
      By continuing, you agree to the <a href="#">Terms of use</a> and <a href="#">Privacy Policy</a>.
    </div>

    <div class="links">
      <a href="#">Other issue with sign in</a> |
      <a href="#">Forget your password</a>
    </div>

    <a href="#" class="create-account">Create an account</a>
  </form>

  <div class="footer">
    Help Center &nbsp;&nbsp; Terms of Service &nbsp;&nbsp; Privacy Policy &nbsp;&nbsp; @2025Clefinspire
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("password");
      const toggle = event.target;
      if (password.type === "password") {
        password.type = "text";
        toggle.textContent = "🙈 Hide";
      } else {
        password.type = "password";
        toggle.textContent = "👁️ Show";
      }
    }
  </script>

  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
