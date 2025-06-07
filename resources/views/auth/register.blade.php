@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom, #FCD3D3, #A92C2C);
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card p-4 shadow-lg" style="max-width: 450px; width: 100%; border-radius: 20px;">
            <h3 class="text-center mb-2 fw-bold">Create an account</h3>
            <p class="text-center mb-4">
                Already have an account?
                <a href="{{ route('signin') }}">Log in</a>
            </p>

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">What should we call you?</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                        placeholder="Enter your profile name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">What's your email?</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="Enter your email address" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Create a password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control border-0 border-bottom border-start border-top" name="password"
                            placeholder="Enter your password" required>
                        <div class="d-flex align-items-center input-group-append justify-content-end">
                            <span class="form-control rounded-0 rounded-end-2">
                                <i class="bi bi-eye-slash toggle-password" id="togglePassword" style="cursor: pointer;">
                                   
                                </i>    
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Use 8 or more characters</div>
                </div>

                <p class="text-sm text-center mt-2 mb-3">
                    By creating an account, you agree to the <br>
                    <a href="#" class="text-decoration-underline">Terms of use</a> and
                    <a href="#" class="text-decoration-underline">Privacy Policy</a>.
                </p>

                <button type="submit" class="btn btn-secondary w-100 mb-3 rounded-pill">Create an account</button>

            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            this.classList.toggle("bi-eye");
            this.classList.toggle("bi-eye-slash");
        });
    });
</script>
