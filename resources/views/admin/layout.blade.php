<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Atelier Admin</title><link rel="stylesheet" href="{{ asset('css/store.css') }}"></head><body class="admin-body">
<header class="admin-top"><a class="brand" href="{{ route('admin.dashboard') }}">ATELIER<span>.</span> <small>ADMIN</small></a><div><a href="{{ route('home') }}">View store ↗</a> <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-button">Logout</button></form></div></header>
<div class="admin-shell"><aside class="admin-sidebar"><a href="{{ route('admin.dashboard') }}">Overview</a><a href="{{ route('admin.products.index') }}">Products</a><a href="{{ route('admin.categories.index') }}">Categories</a><a href="{{ route('admin.orders.index') }}">Orders</a></aside><main class="admin-main">
@if(session('success'))<div class="flash success">{{ session('success') }}</div>@endif @if(session('error'))<div class="flash error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="flash error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
@yield('admin-content')
</main></div></body></html>
