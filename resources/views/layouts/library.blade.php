<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Readwise' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="library-shell">
    <nav class="site-nav">
        <div class="site-nav__inner">
            <a class="brand" href="/books" aria-label="Readwise home">
                <span class="brand__mark">R</span>
                <span class="brand__text">Readwise</span>
            </a>

            <div class="site-nav__links">
                <a class="nav-link {{ request()->is('/') ? 'is-active' : '' }}" href="/">Home</a>
                <a class="nav-link {{ request()->is('books') || request()->is('books/*') ? 'is-active' : '' }}" href="/books">Library</a>
                <a class="button button--primary button--sm" href="/books/create">Add Book</a>
            </div>
        </div>
    </nav>

    <main class="page-wrap">
        @yield('content')
    </main>
</body>
</html>
