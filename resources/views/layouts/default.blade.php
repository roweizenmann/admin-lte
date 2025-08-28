<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AdminLTE v4 | Dashboard</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    />
    @vite('resources/scss/app.scss')
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">
    @include('parts.header')

    @include('parts.sidebar')
    <main class="app-main">
        @include('parts.content-header')
        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </main>
    @include('parts.footer')
</div>
@vite('resources/js/app.js')
</body>
</html>
