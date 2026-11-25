<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Atelier — Modern Essentials')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>
    <div class="announcement">Complimentary shipping on orders over RM150</div>
    <header class="site-header">
        <a class="brand" href="{{ route('home') }}">ATELIER<span>.</span></a>
        <nav class="main-nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('shop') }}">Shop</a>
            @auth <a href="{{ route('account.orders') }}">My orders</a> @endauth
        </nav>
        <div class="header-actions">
            @auth
                <a href="{{ route('cart') }}">Bag</a>
                @if(auth()->user()->role === 'admin') <a href="{{ route('admin.dashboard') }}">Admin</a> @endif
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-button">Logout</button></form>
            @else
                <a href="{{ route('login') }}">Sign in</a>
                <a class="bag-link" href="{{ route('login') }}">Bag</a>
            @endauth
        </div>
    </header>

    @if(session('success')) <div class="flash success">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="flash error">{{ session('error') }}</div> @endif
    @if($errors->any())
        <div class="flash error"><strong>Please check the form:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <main>@yield('content')</main>

    <footer class="footer">
        <div><a class="brand brand-light" href="{{ route('home') }}">ATELIER<span>.</span></a><p>Considered pieces. Everyday confidence.</p></div>
        <div class="footer-links"><a href="{{ route('shop') }}">Shop all</a><a href="{{ route('account.orders') }}">Orders</a><a href="mailto:hello@example.com">Contact</a></div>
        <small>© {{ date('Y') }} Atelier. Demo storefront.</small>
    </footer>
</body>
</html>
