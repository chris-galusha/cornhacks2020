<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Cornhacks')</title>
  <script src="https://kit.fontawesome.com/a00fcd0e30.js"></script>
  <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
  <script src="/js/app.js" type="text/javascript"></script>
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div class="container box">
    @yield('content')
    @include('snippets/notifications')
  </div>
</body>
</html>
