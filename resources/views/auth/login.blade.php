@extends('layouts.store')
@section('title', 'Sign in — Atelier')
@section('content')
<section class="auth-wrap"><p class="eyebrow">WELCOME BACK</p><h1>Sign in</h1><p class="muted">Good to have you here.</p>
<form method="POST" action="{{ route('login.store') }}" class="auth-form">@csrf
<label>Email address<input type="email" name="email" value="{{ old('email') }}" required autofocus></label>
<label>Password<input type="password" name="password" required></label>
<label class="check-label"><input type="checkbox" name="remember"> Remember me</label>
<button class="button button-dark button-full">Sign in</button>
</form><p class="auth-switch">New to Atelier? <a href="{{ route('register') }}">Create an account</a></p></section>
@endsection
