<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
      test
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="http://{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
</body>
</html>