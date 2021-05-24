<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        .small-text {
            font-size: .8333rem;
        }
        body {
            background-color: darkgray;
        }
    </style>
</head>
<body class="pt-1 pt-md-2 pt-lg-5">

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-lg-2">

                @if($errors->has('issue'))
                    <div class="alert alert-danger mb-2">
                        <span>{{ $errors->first('issue') }}</span>
                        @if($errors->first('alternative'))
                            <span>Did you mean <a href="{{ route('pokemon', [$errors->first('alternative')]) }}">
                                <em>{{ ucwords(str_replace('-', ' ', $errors->first('alternative'))) }}?</em>
                            </a></span>
                        @endif
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    @hasSection('footer-scripts')
        @yield('footer-scripts')
    @endif
</body>
</html>

