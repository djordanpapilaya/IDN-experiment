<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,shrink-to-fit=no"/>
    <title>Vue Skeleton</title>
    <script>// enable to override webpacks publicPath
      // var webpackPublicPath = '/';</script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/version/1618583287422/css/vendors.css" rel="stylesheet">
    <link href="/version/1618583287422/css/app.css" rel="stylesheet">
</head>
<body>
<div class="min-h-screen bg-gray-100">@include('layouts.navigation')
    <main>{{ $slot }}</main>
</div>
<script src="/version/1618583287422/js/vendors.js"></script>
<script src="/version/1618583287422/js/app.js"></script>
</body>
</html>