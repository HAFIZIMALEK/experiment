@extends('layouts.store')
@section('title', 'Create account — Atelier')
@section('content')
<section class="auth-wrap"><p class="eyebrow">JOIN THE ATELIER COMMUNITY</p><h1>Create account</h1><p class="muted">A few details and you're in.</p>
<form method="POST" action="{{ route('register.store') }}" class="auth-form">@csrf
<label>Full name<input name="name" value="{{ old('name') }}" required></label>
<label>Email address<input type="email" name="email" value="{{ old('email') }}" required></label>
<label>Password<input type="password" name="password" required></label>
<label>Confirm password<input type="password" name="password_confirmation" required></label>
<button class="button button-dark button-full">Create account</button>
</form><p class="auth-switch">Already registered? <a href="{{ route('login') }}">Sign in</a></p></section>
@endsection
