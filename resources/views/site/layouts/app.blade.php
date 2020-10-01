@include('site.inc.head')
<title>@yield('page-title')</title>
</head>
<body>
    @include('site.inc.header')
    @include('site.inc.nav')
    <div class="container">
    <div id="app">
        <main class="py-4">
        	{{-- @include('layouts.messages') --}}
            @yield('content')
        </main>
    </div>
    </div>
    @include('site.inc.footer')
</body>
</html>
