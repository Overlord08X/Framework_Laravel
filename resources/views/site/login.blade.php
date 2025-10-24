@extends('site.layouts.app')

@section('title', 'login')

@section('content')
<div class="login-box">
    <h2>Login</h2>
    <form action="{{ route('login.process') }}" method="post">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</div>
@endsection