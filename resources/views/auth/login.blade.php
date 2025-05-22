@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow rounded-4">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Authentification Login</h2>

                        <form method="POST" action="{{ route('login') }}" onsubmit="return validateRegisterForm()">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" required autofocus
                                    value="{{ old('email') }}" onblur="validateEmail(this)">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required onblur="validatePassword(this)">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>

                            <div class="form-check mb-3">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('auth.register') }}">Don't have an account? Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>

            function validateRegisterForm() {
                const emailInput = document.querySelector('input[name="email"]');
                const passwordInput = document.querySelector('input[name="password"]');

                // Re-validate everything when submit
                validateEmail(emailInput);
                validatePassword(passwordInput);

                // Check if any errors exist
                const errors = document.querySelectorAll('.error-text');
                for (let error of errors) {
                    if (error.innerText !== '') {
                        return false; // prevent form submit if any error message
                    }
                }
                return true; // allow form submit if no errors
            }
            function showError(input, message) {
                let errorDiv = input.nextElementSibling;
                if (!errorDiv || !errorDiv.classList.contains('error-text')) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'error-text';
                    errorDiv.style.color = 'red';
                    errorDiv.style.fontSize = '13px';
                    input.parentNode.appendChild(errorDiv);
                }
                errorDiv.innerText = message;
            }

            function clearError(input) {
                const errorDiv = input.parentNode.querySelector('.error-text');
                if (errorDiv) {
                    errorDiv.innerText = '';
                }
            }

            function validateEmail(input) {
                const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!pattern.test(input.value.trim())) {
                    showError(input, 'Invalid email format.');
                } else {
                    clearError(input);
                }
            }

            function validatePassword(input) {
                if (input.value.length < 6) {
                    showError(input, 'Password must be at least 6 characters long.');
                } else {
                    clearError(input);
                }
            }
        </script>

    @endpush
@endsection