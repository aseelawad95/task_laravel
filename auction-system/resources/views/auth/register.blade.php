<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container mt-5 style="max-width: 500px;>
        <h1 class="text-center mb-4">Register</h1>
        <form action="{{ route('register') }}" method="POST" class="border p-3 rounded shadow-sm" style="max-width: 350px; margin: auto;">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <label for="type">User Type</label>
                <select name="type" class="form-control" id="type" required>
                    <option value="seller">Seller</option>
                    <option value="buyer">Buyer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required minlength="8">
            </div>
            <button type="submit" class="btn btn-success btn-block">Register</button>
        </form>
    </div>
@endsection
