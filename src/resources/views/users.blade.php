<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー一覧ページ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />

  <style>
   *{
    margin: 0;
    padding: 0;
    }
  
  
  </style>
</head>
<body>
  <div class="header">
    <h1 class="app_header">Atte</h1>
  <div>

  <p>{{$diff}}</p>
  <p>{{$time}}</p>
  
  <div class="end">
    <h3 class="end_content">Atte,inc.</h3>
  </div>

</body>

</html>