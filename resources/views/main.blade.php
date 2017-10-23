<!DOCTYPE html>
<html lang="en">
    <body>
<!-- hello there -->
        <head>
        @include('partials._head')
        </head>

        @include('partials._nav')
        <div class="container">
            @include('partials.messages')
            @yield('content')
            @include('partials._footer')
        </div>

        @include('partials._javascripts')
        @yield('scripts')
    </body>
</html>