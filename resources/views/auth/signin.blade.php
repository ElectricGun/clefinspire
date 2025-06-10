@extends('layouts.auth')

@section('content')
    <style>
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;

            max-width: 100vw;
        }

        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(92, 91, 91, 0.1);
            max-width: 600px;
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

        .policy,
        .links {
            font-size: 12px;
            margin-top: 10px;
            display: inline-block;
            /* Make the links inline */
            /* Prevent the text from wrapping */
        }

        .policy a,
        .links a {
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
            text-align: center;
            font-size: 12px;
            color: #fff;
            left: 50vw;
            transform: translateX(-50%);
        }

        /* Custom Grey Button */
        .btn-grey {
            background-color: #ccc;
            /* Grey color */
            border-color: #ccc;
            /* Grey border */
            color: #333;
            /* Dark text color */
        }

        .btn-grey:hover {
            background-color: #bbb;
            /* Darker grey when hovering */
            border-color: #bbb;
            /* Darker border on hover */
        }
    </style>

    <body class="bg-gradient-pal-red px-3 d-flex">

        <form class="container" method="POST" action="/signin/post">
            @csrf
            <h2>Sign In</h2>

            <div class="mb-3">
                <label for="email" class="form-label">Enter your email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <span>
                        <label for="password" class="form-label">Your password</label>
                    </span>

                    <span>
                        <span onclick="togglePassword()" style="cursor:pointer;">
                            <i id="eye-hide" class="bi bi-eye-slash"></i>
                            <i id="eye-show" class="bi bi-eye"></i>
                            <span id="show-hide"> Show </span>
                        </span>
                    </span>
                </div>
                <input type="password" class="form-control" id="password" name="password" required>

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
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

            <div>
                <a href="/register" class="create-account">Create an account</a>
            </div>
        </form>

        <div class="footer">
            Help&nbsp;Center&nbsp;&nbsp;Terms&nbsp;of&nbsp;Service&nbsp;&nbsp;Privacy&nbsp;Policy &nbsp;&nbsp;@2025Clefinspire
        </div>

        <script>
            document.getElementById("eye-hide").style.display = "none"

            function togglePassword() {
                const password = document.getElementById("password");
                const showHide = document.getElementById("show-hide");

                if (password.type === "password") {
                    password.type = "text";
                    showHide.textContent = "Hide";
                    document.getElementById("eye-hide").style.display = "inline"
                    document.getElementById("eye-show").style.display = "none"
                } else {
                    password.type = "password";
                    showHide.textContent = "Show";
                    document.getElementById("eye-hide").style.display = "none"
                    document.getElementById("eye-show").style.display = "inline"
                }
            }
        </script>
    </body>
@endsection
