@include('site.inc.head')
<title>@yield('page-title') | {{ config('app.name') }}</title>
</head>
<body>
    @include('site.inc.header')
    @include('site.inc.nav')
    @yield('slider')
    <div class="container">
    <div id="app">
        <main class="py-4">
            {{-- @include('layouts.messages') --}}
            @if(session()->has('error'))
                <div class="row">
                    <div class="col-md-12 text-center alert alert-danger h4 font-weight-bold">
                        {{ session()->get('error') }}
                    </div>
                </div>
            @endif
            @if(session()->has('success'))
                <div class="row">
                    <div class="col-md-12 text-center alert alert-success h4 font-weight-bold">
                        {{ session()->get('success') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    </div>
    @include('site.inc.footer')
</body>
</html>
