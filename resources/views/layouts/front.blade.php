<!DOCTYPE html>
<html lang="" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title or config('app.name')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ elixir('front/style.css') }}">
</head>
<body class="page-container">
<main class="main">
    @yield('content')
</main>
<script src="{{ elixir('front/script.js') }}"></script>
</body>
</html>