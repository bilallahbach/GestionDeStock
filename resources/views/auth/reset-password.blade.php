@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

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
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                        <input type="hidden" name="email" value="{{ request()->email }}">

                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" required placeholder="New password">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>

                </div>

            </div>

        </div>



@endsection