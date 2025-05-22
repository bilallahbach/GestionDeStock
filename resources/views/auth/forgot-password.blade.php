@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
<br><br>
<div class="container">
    <div>
        <h2 class="text-center mb-4">Forgot Password</h2>
        <p class="text-center">Enter your email address to receive a password reset link.</p>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow rounded-4 col-md-5 mx-auto">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
                </form>
            
        </div>
        
    </div>
    
</div>
@endsection