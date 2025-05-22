@extends('layouts.app')
@section('title', 'Register')
@section('content')
<br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Creer un compte</h2>

                        <form method="POST" action="{{ route('register') }} " onsubmit="return validateRegisterForm()">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" required onblur="validateName(this)">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" required onblur="validateEmail(this)">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required onblur="validatePassword(this)">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" onblur="validateConfirmPassword(this)" >
                            </div>

                            <!-- Hidden field for role -->
                            <input type="hidden" name="role" value="guest">

                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
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
                            <a href="{{ route('auth.login') }}">Already have an account? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>

function validateRegisterForm() {
    const nameInput = document.querySelector('input[name="name"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
    
    // Re-validate everything when submit
    validateName(nameInput);
    validateEmail(emailInput);
    validatePassword(passwordInput);
    validateConfirmPassword(confirmPasswordInput);

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

function validateName(input) {
    const pattern = /^[A-Za-z]{3,}\s[A-Za-z]{3,}$/;
    if (!pattern.test(input.value.trim())) {
        showError(input, 'Full name must be two words, 3+ letters each.');
    } else {
        clearError(input);
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
    const pattern = /^(?=.*[a-z])(?=.*\d)(?=.*[!@#\$%\^\&*\)\(+=._-]).{8,}$/;
    if (!pattern.test(input.value.trim())) {
        showError(input, 'Password must be 8+ chars, 1 lowercase, 1 number, 1 special.');
    } else {
        clearError(input);
    }
}

function validateConfirmPassword(input) {
    const passwordInput = document.querySelector('input[name="password"]');
    if (input.value.trim() !== passwordInput.value.trim()) {
        showError(input, 'Passwords do not match.');
    } else {
        clearError(input);
    }
}
</script>

    
@endpush
@endsection