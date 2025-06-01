<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #f8a5c2, #e17055);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      padding: 40px;
      border-radius: 20px;
      width: 360px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      text-align: center;
      position: relative;
    }

    h2 {
      margin-bottom: 20px;
    }

    .input-group {
      text-align: left;
      margin-bottom: 15px;
    }

    .input-group label {
      font-size: 14px;
      margin-bottom: 5px;
      display: block;
    }

    .input-group input {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .input-group .password-toggle {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 12px;
      margin-top: 5px;
    }

    .button {
      width: 100%;
      padding: 12px;
      border: none;
      background: #ccc;
      border-radius: 20px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }

    .button:hover {
      background: #aaa;
    }

    .policy, .links {
      font-size: 12px;
      margin-top: 10px;
    }

    .policy a, .links a {
      color: #000;
      text-decoration: underline;
    }

    .create-account {
      margin-top: 20px;
      display: inline-block;
      border: 1px solid #000;
      padding: 10px 40px;
      border-radius: 20px;
      background: #fff;
      font-weight: bold;
      text-decoration: none;
      color: black;
    }

    .footer {
      position: absolute;
      bottom: -60px;
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
  </style>
</head>
<body>
  <form class="container" method="POST" action="{{ route('signin.submit') }}">
    @csrf
    <h2>Sign in</h2>

    <div class="input-group">
      <label for="email">Enter your email</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" required>
      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <div class="input-group">
      <label for="password">Your password</label>
      <input type="password" name="password" id="password" required>
      <div class="password-toggle">
        <span></span>
        <span onclick="togglePassword()" style="cursor:pointer;">👁️ Hide</span>
      </div>
      @error('password')
        <div class="error">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="button">Log in</button>

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
    Help Center &nbsp;&nbsp; Terms of Service &nbsp;&nbsp; Privacy Policy &nbsp;&nbsp; @2022yanliudesign
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
</body>
</html>
