<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Login</h1>
        <form action="{{ route('login') }}" method="POST" class="border p-3 rounded shadow-sm" style="max-width: 350px; margin: auto;">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Login</button>
        </form>
    </div>
@endsection
