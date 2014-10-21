<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>The Man List | Welcome</title>
        <link rel="stylesheet" href="{{ asset('css/foundation.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/accessibility_foundicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/general_enclosed_foundicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/manlist.css') }}" />
        <script src="{{ asset('js/vendor/jquery.js') }}"></script>
        <script src="{{ asset('js/vendor/modernizr.js') }}"></script>
    </head>
    <body>

    <div class="row">
        <div class="columns small-5">
            <h1>The Man List</h1>
        </div>
        @if (Auth::check())
            @include('nameAdd')
        @endif
    </div>

    @if (Auth::check())
        @include('navigation')
    @endif

    <div class="row">
        <div class="columns small-12">
            @yield('content')
        </div>
    </div>

    <i id="back-to-top" class="foundicon-up-arrow" title="Back to the top of the page" />

    <script src="{{ asset('js/foundation.min.js') }}"></script>
    <script>
        $(document).foundation();
    </script>
    <script src="{{ asset('js/manlist.js') }}"></script>

    @if (Session::get('err'))
    <script>
        AlertMessagesWidget.message('{{ Session::get('err') }}');
    </script>
    @endif

    @if (Session::get('notice'))
    <script>
        AlertMessagesWidget.notice('{{ Session::get('notice') }}');
    </script>
    @endif
    </body>
</html>
